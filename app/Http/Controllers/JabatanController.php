<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Jabatan::all();
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
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'level' => 'required|max:5|numeric',
            'nama_jabatan' => 'required|max:60',
            'keterangan_jabatan' => 'required|max:249',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => 'false',
                'message' => $validator->errors(),
                'data' => '',
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $databaru = Jabatan::create([
                'level' => $request->level,
                'nama_jabatan' => $request->nama_jabatan,
                'keterangan_jabatan' => $request->keterangan_jabatan,
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
        $data = Jabatan::find($id);
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'data' => $data,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data=Jabatan::find($id);
        $validator = Validator::make($request->all(), [
            'level' => 'required|max:5|numeric',
            'nama_jabatan' => 'required|max:60',
            'keterangan_jabatan' => 'required|max:249',
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
                'level' => $request->level,
                'nama_jabatan' => $request->nama_jabatan,
                'keterangan_jabatan' => $request->keterangan_jabatan,
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
        Jabatan::find($id)->delete();
        $response = [
            'success' => 'true',
            'message' => 'data deleted',
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
