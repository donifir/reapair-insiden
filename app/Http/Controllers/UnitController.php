<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitResource;
use App\Http\Resources\userToDropdownResource;
use App\Models\Jabatan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Unit::all();
        $response = [
            'success' => true,
            'message' => 'data list unit',
            'data' => UnitResource::collection($data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function dropdwondata()
    {
        $jabatanlevel4 = Jabatan::where('level', '4')->pluck('id');
        $jabatanlevel3 = Jabatan::where('level', '3')->pluck('id');
        $jabatanlevel2 = Jabatan::whereIn('level', ['2','1'])->pluck('id');
        $jabatanlevel1 = Jabatan::where('level', '1')->pluck('id');
        
        $userlevel4=User::WhereIn('jabatan_id',$jabatanlevel4)->get();
        $userlevel3=User::WhereIn('jabatan_id',$jabatanlevel3)->get();
        $userlevel2=User::WhereIn('jabatan_id',$jabatanlevel2)->get();
        $userlevel1=User::WhereIn('jabatan_id',$jabatanlevel1)->get();

        $response = [
            'success' => 'true',
            'message' => 'data deleted',
            'userlevel4'=>userToDropdownResource::collection($userlevel4) ,
            'userlevel3'=>userToDropdownResource::collection($userlevel3) ,
            'userlevel2'=>userToDropdownResource::collection($userlevel2) ,
            'userlevel1'=>userToDropdownResource::collection($userlevel1) ,
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
            'nama_unit' => 'required|max:50',
            'keterangan' => 'required|max:250',
            'pjo' => 'nullable|max:50',
            'karu' => 'nullable|max:50',
            'kabit' => 'nullable|max:50',
            'waka' => 'nullable|max:50',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => 'false',
                'message' => $validator->errors(),
                'data' => '',
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $databaru = Unit::create([
                'nama_unit' => $request->nama_unit??null,
                'keterangan' => $request->keterangan??null,
                'pjo' => $request->pjo==='null'?null: $request->pjo,
                'karu' => $request->karu==='null'?null:$request->karu,
                'kabit' => $request->kabit==='null'?null:$request->kabit,
                'waka' => $request->waka==='null'?null:$request->waka,
            ]);
            $response = [
                'success' => 'true',
                'message' => 'data created',
                'data' => $databaru,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Unit::find($id);
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'data' => new UnitResource($data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Unit::find($id);
        $validator = Validator::make($request->all(), [
            'nama_unit' => 'required|max:50',
            'keterangan' => 'required|max:250',
            'pjo' => 'nullable|max:50',
            'karu' => 'nullable|max:50',
            'kabit' => 'nullable|max:50',
            'waka' => 'nullable|max:50',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => 'false',
                'message' => $validator->errors(),
                'data' => '',
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $data->update([
                'nama_unit' => $request->nama_unit??null,
                'keterangan' => $request->keterangan??null,
                'pjo' => $request->pjo==='null'?null: $request->pjo,
                'karu' => $request->karu==='null'?null:$request->karu,
                'kabit' => $request->kabit==='null'?null:$request->kabit,
                'waka' => $request->waka==='null'?null:$request->waka,
            ]);
            $response = [
                'success' => 'true',
                'message' => 'data created',
                'data' => $data,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Unit::find($id)->delete();
        $response = [
            'success' => 'true',
            'message' => 'data deleted',
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
