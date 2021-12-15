<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataPembeliResource;
use App\Models\DataPembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataPembeliResource::collection(DataPembeli::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_ponsel' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           
        ]);


        $gambar = $request->file('gambar');
        $filename = $gambar->getClientOriginalName();
        $filename = $filename;
        $path = $gambar->storeAs('public/gambar', $filename);

       

        $dataPembeli = DataPembeli::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_ponsel' => $request->no_ponsel,
            'gambar' => $filename
        ]);

        return new DataPembeliResource($dataPembeli);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPembeli  $dataPembeli
     * @return \Illuminate\Http\Response
     */
    public function show($dataPembeli)
    {
        return new DataPembeliResource(DataPembeli::find($dataPembeli));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPembeli  $dataPembeli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataPembeli)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_ponsel' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           
        ]);


        
       
        $apdetDataPembeli = DataPembeli::find($dataPembeli);
        $foto = $request->file('gambar');
        if ($foto) {
            # code...
            
            Storage::delete('public/gambar/'.$apdetDataPembeli->gambar);
            $gambar = $request->file('gambar')->getClientOriginalName();
            $foto = $request->file('gambar')->storeAs('public/gambar', $gambar);
            $apdetDataPembeli->gambar = $gambar;
            
        }

        if($foto == null){
             $apdetDataPembeli->gambar;
        }

        $apdetDataPembeli->nik           = $request->nik;
        $apdetDataPembeli->nama          = $request->nama;
        $apdetDataPembeli->jenis_kelamin = $request->jenis_kelamin;
        $apdetDataPembeli->alamat        = $request->alamat;
        $apdetDataPembeli->tempat_lahir  = $request->tempat_lahir;
        $apdetDataPembeli->tanggal_lahir = $request->tanggal_lahir;
        $apdetDataPembeli->no_ponsel     = $request->no_ponsel;
        $apdetDataPembeli->update();

        return response([
            'message' => 'data berhasil diupdate',
            'data' => $apdetDataPembeli
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPembeli  $dataPembeli
     * @return \Illuminate\Http\Response
     */
    public function destroy($dataPembeli)
    {
        $hapusDataPembeli = DataPembeli::find($dataPembeli);
        if ($hapusDataPembeli->gambar) {
            Storage::delete('public/gambar/'.$hapusDataPembeli->gambar);
        }
        $hapusDataPembeli->delete();
        return response([
            'message' => 'berhasil dihapus',
            'data' => $hapusDataPembeli
        ], 200);
    }
}
