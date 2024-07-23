<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    //
    public function listuser()
    {
        $datauser = User::all();
        $response = [
            'suceess' => false,
            'message' => 'data user',
            'data' =>  $datauser
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function register(Request $request)
    {
        //
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:60|min:4',
            'email' => 'required|max:60|min:3|unique:users|email',
            'password' => 'required|max:60|min:8',
            'confirm_password' => 'required|max:60|min:8|same:password',
        ]);
        if ($validation->fails()) {
            $response = [
                'suceess' => false,
                'message' => $validation->errors(),
                'data' => ''
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken($user->email)->plainTextToken;

            $response = [
                'suceess' => true,
                'messages' => 'Register Succesfully',
                'role' => 'admin',
                'name' => $user->name,
                'token' => $token,
                'nomer_rekam_medis' => $user->no_rkm_medis,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function login(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($validator->fails()) {
            $response = [
                'suceess' => false,
                'messages' => $validator->errors(),
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else if (!$user || !Hash::check($request->password, $user->password)) {
            $response = [
                'suceess' => false,
                'messages' => ['password' => 'invalid credensial'],
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $token = $user->createToken($user->email)->plainTextToken;
            $response = [
                'suceess' => true,
                'messages' => 'Login Succesfully',
                'name' => $user->name,
                'level' => Jabatan::find($user->jabatan_id)->level,
                'role' => 'admin',
                'email' => $user->email,
                'token' => $token,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }
    public function logout()
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();

        $response = [
            'suceess' => true,
            'messages' => 'Logot Succesfully',
            'data' => ''
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function cekLogin()
    {
        $data = Auth::guard('sanctum')->user();
        if ($data) {
            $response = [
                'suceess' => true,
                'messages' => 'auth',
                'data' => $data,
            ];
        } else {
            $response = [
                'suceess' => true,
                'messages' => 'guest',
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }
}
