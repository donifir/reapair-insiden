<?php

namespace App\Http\Controllers;

use App\Http\Resources\userToDropdownResource;
use App\Models\FormInsident;
use App\Models\Jabatan;
use App\Models\StatusForminsiden;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::guard('sanctum')->user();
        $laporan_terkirim = FormInsident::where('user_id',$user->id)->get();
        $datalaporanunit = User::where('unit_id',$user->unit_id)->pluck('id');

        $jumlahlaporanunit = FormInsident::whereIn('user_id',$datalaporanunit)->get();
        $jumlah_external=StatusForminsiden::where('user_id',$user->id)->get();

        $response = [
            'success' => true,
            'message' => 'data list kejadian',
            'laporan_terkirim' => $laporan_terkirim->count(),
            'laporan_unit' => $jumlahlaporanunit->count(),
            'grading_sudah' => $jumlahlaporanunit->whereNotNull('grading_resiko_kejadian')->count(),
            'jumlah_external'=>$jumlah_external->count()
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
