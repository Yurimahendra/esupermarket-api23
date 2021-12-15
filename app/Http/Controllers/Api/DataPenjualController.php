<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataPenjualResource;
use App\Models\DataPenjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataPenjualResource::collection(DataPenjual::all());
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
            'nama_toko' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           
        ]);


        $gambar = $request->file('gambar');
        $filename = $gambar->getClientOriginalName();
        $filename = $filename;
        $path = $gambar->storeAs('public/gambar', $filename);

       

        $dataPenjual = DataPenjual::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_ponsel' => $request->no_ponsel,
            'nama_toko' => $request->nama_toko,
            'gambar' => $filename
        ]);

        return new DataPenjualResource($dataPenjual);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPenjual  $dataPenjual
     * @return \Illuminate\Http\Response
     */
    public function show($dataPenjual)
    {
        return new DataPenjualResource(DataPenjual::find($dataPenjual));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPenjual  $dataPenjual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataPenjual)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_ponsel' => 'required',
            'nama_toko' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        

       
        $apdetDataPenjual = DataPenjual::find($dataPenjual);
        $foto = $request->file('gambar');
        if ($foto) {
            # code...
            
            Storage::delete('public/gambar/'.$apdetDataPenjual->gambar);
            $gambar = $request->file('gambar')->getClientOriginalName();
            $foto = $request->file('gambar')->storeAs('public/gambar', $gambar);
            $apdetDataPenjual->gambar = $gambar;
            
        }

        if($foto == null){
             $apdetDataPenjual->gambar;
        }

        $apdetDataPenjual->nik           = $request->nik;
        $apdetDataPenjual->nama          = $request->nama;
        $apdetDataPenjual->jenis_kelamin = $request->jenis_kelamin;
        $apdetDataPenjual->alamat        = $request->alamat;
        $apdetDataPenjual->tempat_lahir  = $request->tempat_lahir;
        $apdetDataPenjual->tanggal_lahir = $request->tanggal_lahir;
        $apdetDataPenjual->no_ponsel     = $request->no_ponsel;
        $apdetDataPenjual->nama_toko     = $request->nama_toko;
        $apdetDataPenjual->update();

        return response([
            'message' => 'data berhasil diupdate',
            'data' => $apdetDataPenjual
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPenjual  $dataPenjual
     * @return \Illuminate\Http\Response
     */
    public function destroy($dataPenjual)
    {
        $hapusDataPenjual = DataPenjual::find($dataPenjual);
        if ($hapusDataPenjual->gambar) {
            Storage::delete('public/gambar/'.$hapusDataPenjual->gambar);
        }
        $hapusDataPenjual->delete();
        return response([
            'message' => 'berhasil dihapus',
            'data' => $hapusDataPenjual
        ], 200);
    }
}
