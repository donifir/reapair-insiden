<?php

namespace App\Http\Controllers;

use App\Http\Resources\JabatanUntukCresteUSerResource;
use App\Http\Resources\UnitUntukCresteUSerResource;
use App\Http\Resources\UserResource;
use App\Models\Jabatan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\NullableType;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = User::all();
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'data' => UserResource::collection($data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function jabatanDanUnit()
    {
        //
        $datajabatan = Jabatan::all();
        $dataunit = Unit::all();
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'dataunit' => UnitUntukCresteUSerResource::collection($dataunit),
            'datajabatan' => JabatanUntukCresteUSerResource::collection($datajabatan),
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
            'nama' => 'required|max:50',
            'email' => 'required|max:60|min:3|unique:users|email',
            'password' => 'required',
            'jabatan' => 'required|max:50',
            'unit' => 'required|max:1000',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => 'false',
                'message' => $validator->errors(),
                'data' => '',
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $databaru = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => $request->password,
                'jabatan_id' => $request->jabatan,
                'unit_id' => $request->unit,
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
        $data = User::find($id);
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'data' => new UserResource($data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function detail()
    {
        //
        $data = User::find(Auth::guard('sanctum')->user()->id);
        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            // 'data' =>  UserResource::collection($data),
            'data' => new UserResource($data),
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function ubahPassword(Request $request)
    {
        //
        $userid = Auth::guard('sanctum')->user()->id;
        $user = User::find($userid);

        $validator = Validator::make($request->all(), [
            'password'=>'required|max:60|min:8',
            'new_password' => 'required|max:60|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => 'false',
                'message' => $validator->errors(),
                'data' => '',
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else if (!$user || !Hash::check($request->password, $user->password)) {
            $response = [
                'suceess' => false,
                'message' => ['password' => 'password tidak sama'],
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }else{
            $user->update([
                'password' =>Hash::make($request->new_password),
            ]);
            $response = [
                'success' => 'true',
                'message' => 'data created',
                'data' => $user,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = User::find($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:50',
            'email' => 'required|max:60|min:3|unique:users,email->ignore($user->id)',
            'password' => 'nullable|max:60|min:8',
            'jabatan' => 'required|max:50',
            'unit' => 'required|max:1000',
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
                'name' => $request->nama,
                'email' => $request->email,
                'password' => $request->password==""?$data->password:Hash::make($request->password),
                'jabatan_id' => $request->jabatan,
                'unit_id' => $request->unit,
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
        User::find($id)->delete();
        $response = [
            'success' => 'true',
            'message' => 'data deleted',
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
