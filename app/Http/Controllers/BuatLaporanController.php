<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataInsidenResource;
use App\Models\FormInsident;
use App\Models\Jabatan;
use App\Models\PasienModel;
use App\Models\StatusForminsiden;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BuatLaporanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
    $data = FormInsident::all();
    $response = [
      'success' => true,
      'message' => 'data list kejadian',
      'data' => $data,
    ];
    return response()->json($response, Response::HTTP_OK);
  }


  public function getDataInsidenTerkirim()
  {
    //
    $data = FormInsident::where('user_id', Auth::guard('sanctum')->user()->id)->get();
    $response = [
      'success' => true,
      'message' => 'data list kejadian',
      'data' => DataInsidenResource::collection($data),
    ];
    return response()->json($response, Response::HTTP_OK);
  }

  public function getDetail(string $id)
  {
    //
    $data = FormInsident::find($id);
    $response = [
      'success' => true,
      'message' => 'data list kejadian',
      'data' => new DataInsidenResource($data),
    ];
    return response()->json($response, Response::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
    $validator = Validator::make($request->all(), [
      'nama' => 'required|max:250',
      'norm' => 'required|max:250',
      'waktu_insiden' => 'required|max:250',
      'insident' => 'required|max:250',
      'kronologi_insiden' => 'required|max:250',
      'jenis_insiden' => 'required|max:250',
      'pelapor_insiden' => 'required|max:250',
      // 'penjelasn_pelapor_insiden' => 'required|max:250',
      'korban_insiden' => 'required|max:250',
      // 'penjelasan_korban_insiden' => 'required|max:250',
      'pasien_di' => 'required|max:250',
      // 'penjelasan_pasien_di' => 'required|max:250',
      'tempat_insiden' => 'required|max:250',
      'spesialis_korban' => 'required|max:250',
      // 'penjelasan_spesialis_korban' => 'required|max:250',
      'unit_penyebab_insiden' => 'required|max:250',
      'akibat_insiden_kepasien' => 'required|max:250',
      'penanganan_insiden' => 'required|max:250',
      'pelaku_penanganan' => 'required|max:250',
      // 'penjelasan_pelalku_penanganan' => 'required|max:250',
      'insident_pernah_terjadi' => 'required|max:250',
      // 'penjelasan_insident_pernah_terjadi' => 'required|max:250',
      'grading_resiko_kejadian' => 'required|max:250',
    ]);
    $cekpasien = PasienModel::where('no_rkm_medis', $request->norm)->count();
    if ($cekpasien == 0) {
      $response = [
        'success' => 'false',
        'message' => ['norm' => 'norm not valid'],
        'data' => '',
      ];
      return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
    } elseif ($validator->fails()) {
      $response = [
        'success' => 'false',
        'message' => $validator->errors(),
        'data' => '',
      ];
      return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
    } else {
      $databaru = FormInsident::create([
        'nama' => $request->nama,
        'norm' => $request->norm,
        'waktu_insiden' => $request->waktu_insiden,
        'insident' => $request->insident,
        'kronologi_insiden' => $request->kronologi_insiden,
        'jenis_insiden' => $request->jenis_insiden,
        'pelapor_insiden' => $request->pelapor_insiden,
        'penjelasn_pelapor_insiden' => $request->penjelasn_pelapor_insiden,
        'korban_insiden' => $request->korban_insiden,
        'penjelasan_korban_insiden' => $request->penjelasan_korban_insiden,
        'pasien_di' => $request->pasien_di,
        'penjelasan_pasien_di' => $request->penjelasan_pasien_di,
        'tempat_insiden' => $request->tempat_insiden,
        'spesialis_korban' => $request->spesialis_korban,
        'penjelasan_spesialis_korban' => $request->penjelasan_spesialis_korban,
        'unit_penyebab_insiden' => $request->unit_penyebab_insiden,
        'akibat_insiden_kepasien' => $request->akibat_insiden_kepasien,
        'penanganan_insiden' => $request->penanganan_insiden,
        'pelaku_penanganan' => $request->pelaku_penanganan,
        'penjelasan_pelaku_penanganan' => $request->penjelasan_pelaku_penanganan,
        'insident_pernah_terjadi' => $request->insident_pernah_terjadi,
        'penjelasan_insident_pernah_terjadi' => $request->penjelasan_insident_pernah_terjadi,
        // 'grading_resiko_kejadian' => $request->grading_resiko_kejadian,
        'user_id' => Auth::guard('sanctum')->user()->id
      ]);

      $user = Auth::guard('sanctum')->user();
      $unit = Unit::where('id', $user->unit_id)->first();
      $level = Jabatan::find($user->jabatan_id);

      if ($unit->pjo !== null && $level->level >= 4) {
        StatusForminsiden::create([
          'user_id' => $unit->pjo,
          'formindisiden_id' => FormInsident::orderBy('id', 'desc')->first()->id,
          'status_laporan' => 'internal'
        ]);
      };
      if ($unit->karu !== null && $level->level >= 3) {
        StatusForminsiden::create([
          'user_id' => $unit->karu,
          'formindisiden_id' => FormInsident::orderBy('id', 'desc')->first()->id,
          'status_laporan' => 'internal'
        ]);
      };
      if ($unit->kabit !== null && $level->level >= 2) {
        StatusForminsiden::create([
          'user_id' => $unit->kabit,
          'formindisiden_id' => FormInsident::orderBy('id', 'desc')->first()->id,
          'status_laporan' => 'internal'
        ]);
      };

      $penerimalevel1 = Jabatan::where('level', 0)->pluck('id');
      $listuserpenerima = User::whereIn('jabatan_id', $penerimalevel1)->get();


      foreach ($listuserpenerima as $key) {
        StatusForminsiden::create([
          'user_id' => $key->id,
          'formindisiden_id' => FormInsident::orderBy('id', 'desc')->first()->id,
          'status_laporan' => 'internal'
        ]);
      }

      $response = [
        'success' => 'true',
        'formindisiden_id' => FormInsident::first()->id,
        'message' =>  $level,
        'data' => $databaru,
      ];
      return response()->json($response, Response::HTTP_OK);
    }
  }

  public function setGradingReskio(Request $request, string $id)
  {
    //
    $level = Jabatan::find(Auth::guard('sanctum')->user()->jabatan_id);
    $gradingResiko = FormInsident::find($id);
    $validator = Validator::make($request->all(), [
      'grading_resiko' => 'required|max:50',
    ]);
    if ($validator->fails()) {
      $response = [
        'success' => 'false',
        'message' => $validator->errors(),
        'data' => '',
      ];
      return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
    } else if ($level->level !==3 ) {
      $response = [
          'success' => false,
          'message' => ['grading_resiko' => 'maaf grading harus dilakukan oleh Kepala Ruangan'],
          'data' => '',
      ];
      return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
  }
  else {
      $gradingResiko->update([
        'grading_resiko_kejadian' => $request->grading_resiko,
      ]);
      $response = [
        'success' => true,
        'message' => 'data list kejadian',
        'data' => $gradingResiko,
      ];
      return response()->json($response, Response::HTTP_OK);
    }
  }

  /**
   * Display the specified resource.
   */
  public function pasien()
  {
    //
    $data = FormInsident::first();
    $response = [
      'success' => true,
      'message' => 'data list kejadian',
      'data' => $data,
    ];
    return response()->json($response, Response::HTTP_OK);
  }

  /**
   * Display the specified resource.
   */
  public function listInsidenUntukAtasan()
  {
    //
    $user = Auth::guard('sanctum')->user();
    $insidentid = StatusForminsiden::where('user_id', $user->id)->where('status_laporan', 'internal')->pluck('formindisiden_id');
    $data = FormInsident::whereIn('id', $insidentid)->get();

    $response = [
      'success' => true,
      'message' => 'data list kejadian',
      'data' =>  DataInsidenResource::collection($data),
    ];
    return response()->json($response, Response::HTTP_OK);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
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
