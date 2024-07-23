<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataInsidenResource;
use App\Http\Resources\DropdownFormInsidenResource;
use App\Http\Resources\FormInsidenToUserResource;
use App\Http\Resources\UnitPenyebabToDropdownnResource;
use App\Http\Resources\userToDropdownResource;
use App\Models\AkibatInsidenTerhadapPasien;
use App\Models\FormInsident;
use App\Models\InsidenMenyangkutPasien;
use App\Models\InsidenTerjadiPadaPasien;
use App\Models\InsidentPernahTerjadi;
use App\Models\Jabatan;
use App\Models\JenisInsiden;
use App\Models\KorbanInsiden;
use App\Models\PelaporInsiden;
use App\Models\StatusForminsiden;
use App\Models\TindakanDilakukanOleh;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class InsidenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jenis_insiden = JenisInsiden::all();
        $pelapor_insiden = PelaporInsiden::all();
        $korban_insiden = KorbanInsiden::all();
        $insiden_menyangkut_pasien = InsidenMenyangkutPasien::all();
        $insiden_terjadi_pada_pasein = InsidenTerjadiPadaPasien::all();
        $tindakan_dilakukan_oleh = TindakanDilakukanOleh::all();
        $insident_pernah_terjadi = InsidentPernahTerjadi::all();
        $akibat_insident = AkibatInsidenTerhadapPasien::all();
        $unit_penyebab_insiden=Unit::where('karu','<>',null)->get();

        $response = [
            'success' => true,
            'message' => 'get berhasil',
            'jenis_insiden' => DropdownFormInsidenResource::collection($jenis_insiden),
            'pelapor_insiden' => DropdownFormInsidenResource::collection($pelapor_insiden),
            'korban_insiden' => DropdownFormInsidenResource::collection($korban_insiden),
            'insiden_menyangkut_pasien' => DropdownFormInsidenResource::collection($insiden_menyangkut_pasien),
            'insiden_terjadi_pada_pasein' => DropdownFormInsidenResource::collection($insiden_terjadi_pada_pasein),
            'tindakan_dilakukan_oleh' => DropdownFormInsidenResource::collection($tindakan_dilakukan_oleh),
            'insident_pernah_terjadi' => DropdownFormInsidenResource::collection($insident_pernah_terjadi),
            'akibat_insident' => DropdownFormInsidenResource::collection($akibat_insident),
            'unit_penyebab_insiden' => UnitPenyebabToDropdownnResource::collection($unit_penyebab_insiden),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listAtasan()
    {
        //

        $user = Auth::guard('sanctum')->user();
        $jabatan = Jabatan::find($user->jabatan_id);
        $collection1 = [];
        $collection2 = [];
        $collection3 = [];
        if ($jabatan->level === 4) {
            $collection1 = Unit::all()->pluck('pjo');
            $collection2 = Unit::all()->pluck('karu');
            $collection3 = [];
        } else if ($jabatan->level === 3) {
            $collection1 = Unit::all()->pluck('pjo');
            $collection2 = Unit::all()->pluck('karu');
            $collection3 = Unit::where('karu', $user->id)->pluck('kabit');
        } else if ($jabatan->level === 2) {
            $collection1 = Unit::where('kabit', $user->id)->pluck('waka');
            $collection2 = [];
            $collection3 = [];
        }

        $mergedData = $collection1->merge($collection2);
        $mergedData2 = $mergedData->merge($collection3);

        $data = User::whereIn('id', $mergedData2->unique())->get();
        $response = [
            'success' => true,
            'message' =>   $collection3,
            'data' => userToDropdownResource::collection($data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function jamlihat(string $id)
    {
        //
        $data = StatusForminsiden::where('formindisiden_id', $id)->where('user_id', Auth::guard('sanctum')->user()->id)->first();
        $data->update([
            'jam_lihat' => Carbon::now('Asia/Jakarta'),
        ]);
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'data' => $data,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function jamlihateksternal(string $id)
    {
        //
        $data = StatusForminsiden::where('formindisiden_id', $id)->where('status_laporan', 'eksternal')->where('user_id', Auth::guard('sanctum')->user()->id)->first();
        $data->update([
            'jam_lihat' => Carbon::now('Asia/Jakarta'),
        ]);
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'data' => $data,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createPenerimaLaporanInsident(Request $request)
    {
        //
        $dataforminsiden = FormInsident::where('id', $request->formindisiden_id)->first();

        $jabatan = Jabatan::find(User::find($request->user_id)->jabatan_id);

        $jabatanlogin = Jabatan::find(Auth::guard('sanctum')->user()->jabatan_id);



        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:50',
            'formindisiden_id' => 'required|max:50',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => 'false',
                'message' => $validator->errors(),
                'data' => '',
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else if ($jabatanlogin->level >= 4) {
            //yang meneruskan harus karu keatas
            $response = [
                'success' => false,
                'message' => 'maaf, meneruskan laporan insiden harus dilakukan oleh Kepala Ruangan atau diatasnya',
                'data' => '',
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else if ($jabatan->level <= 2 && $dataforminsiden->grading_resiko_kejadian === null) {
            $response = [
                'success' => false,
                'message' => 'maaf data harus melakukan grading dahulu',
                'data' => $jabatanlogin,
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $cekinternaleksternal = StatusForminsiden::where('formindisiden_id', $request->formindisiden_id)->get();
            $jumblahkaur = Unit::whereIn('karu', $cekinternaleksternal->pluck('user_id'))->pluck('karu')->unique()->count();
            $jumblahkabit = Unit::whereIn('kabit', $cekinternaleksternal->pluck('user_id'))->pluck('kabit')->unique()->count();
            $jumblahwaka = Unit::whereIn('waka', $cekinternaleksternal->pluck('user_id'))->pluck('waka')->unique()->count();
            $status = "internal";
            $adalahwaka = Unit::where('waka',$request->user_id)->count();

            if ($jumblahkaur == 1 && $jumblahkabit == 1 && $jumblahwaka==0 && $adalahwaka > 0) {
                $status = "internal";
            } else {
                $status = "eksternal";
            }

            $data = StatusForminsiden::create([
                'user_id' => $request->user_id,
                'formindisiden_id' => $request->formindisiden_id,
                'status_laporan' =>  $status 
            ]);
            $response = [
                'success' => true,
                'message' =>  $status,
                // 'waka' =>  $adalahwaka,
                // '$jumblahkabit' =>  $jumblahkabit,
                // '$jumblahkaru' =>  $jumblahkaur,
                'data' => $data,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     */
    public function listPenerimaLaporanInsiden(string $id)
    {
        //
        $listjabatanlevel1 = Jabatan::where('level', '0')->pluck('id');
        $listuserlevel1 = User::whereIn('jabatan_id', $listjabatanlevel1)->pluck('id');
        $listidatasan = StatusForminsiden::where('formindisiden_id', $id)->whereNotIn('user_id', $listuserlevel1)->orderBy('status_laporan', 'asc')->get();
        $listidatasanCustom = StatusForminsiden::where('formindisiden_id', $id)->whereNotIn('user_id', $listuserlevel1)->where('status_laporan', 'eksternal')->orderBy('status_laporan', 'asc')->get();
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'data' => FormInsidenToUserResource::collection($listidatasan),
            'penerima_custom' => FormInsidenToUserResource::collection($listidatasanCustom),

        ];
        return response()->json($response, Response::HTTP_OK);
    }

    // revisi berbenti disni memanggil data insident untuk eksternal
    public function listInsidenEksternal()
    {
        //
        $user = Auth::guard('sanctum')->user();
        $insidentid = StatusForminsiden::where('user_id', $user->id)->where('status_laporan', 'eksternal')->pluck('formindisiden_id');
        $data = FormInsident::whereIn('id', $insidentid)->get();

        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            // 'data' => $data,
            'data' =>  DataInsidenResource::collection($data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function listpenerimaall(string $id)
    {
        //
        $data = StatusForminsiden::where('formindisiden_id', $id)->get();
   
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'data' =>FormInsidenToUserResource::collection( $data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function deletepenerima(string $id)
    {
        //
        StatusForminsiden::find($id)->delete();
   
        $response = [
            'success' => true,
            'message' => 'data berhasil dihapus',
            // 'data' =>FormInsidenToUserResource::collection( $data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
