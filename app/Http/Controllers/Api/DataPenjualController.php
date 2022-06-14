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
    

        $GetdataPenjual = DataPenjualResource::collection(DataPenjual::all());
        
        return $GetdataPenjual;
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
            'nik' => 'required|integer',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'latitude' => '',
            'longitude' => '',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_ponsel' => 'required',
            'nama_toko' => 'required',
            'nama_bank' => 'required',
            'no_rekening' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
           
        ]);


        $gambar = $request->file('gambar');
        $filename = null;
        if($gambar){
            $filename = date('YmdHis').".".$gambar->getClientOriginalName();
            $filename = $filename;
            $path = $gambar->storeAs('public/gambar', $filename);
        }else{
            $filename = null;
        }

       

        $dataPenjual = DataPenjual::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_ponsel' => $request->no_ponsel,
            'nama_toko' => $request->nama_toko,
            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'gambar' => $filename
        ]);

        /*return response([
            'kode' => 200,
            'pesan' => 'data tersedia',
            'data' => $dataPenjual
        ]);*/
        return $dataPenjual;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPenjual  $dataPenjual
     * @return \Illuminate\Http\Response
     */
    public function show($dataPenjual)
    {
        $showDataPenjual = new DataPenjualResource(DataPenjual::find($dataPenjual));
        return  $showDataPenjual;
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
            'nik' => 'required|integer',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'latitude' => '',
            'longitude' => '',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_ponsel' => 'required',
            'nama_toko' => 'required',
            'nama_bank' => 'required',
            'no_rekening' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
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
        $apdetDataPenjual->latitude        = $request->latitude;
        $apdetDataPenjual->longitude        = $request->longitude;
        $apdetDataPenjual->tempat_lahir  = $request->tempat_lahir;
        $apdetDataPenjual->tanggal_lahir = $request->tanggal_lahir;
        $apdetDataPenjual->no_ponsel     = $request->no_ponsel;
        $apdetDataPenjual->nama_toko     = $request->nama_toko;
        $apdetDataPenjual->nama_bank     = $request->nama_bank;
        $apdetDataPenjual->no_rekening   = $request->no_rekening;
        $apdetDataPenjual->update();

       /* return response([
            'message' => 'data berhasil diupdate',
            'data' => $apdetDataPenjual
        ], 200);*/
        return $apdetDataPenjual;
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
        return $hapusDataPenjual;
    }
}
