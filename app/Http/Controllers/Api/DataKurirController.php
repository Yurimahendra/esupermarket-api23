<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataKurirResource;
use App\Models\DataKurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataKurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $GetdataPenjual = DataKurirResource::collection(DataKurir::all());
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
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_ponsel' => 'required',
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

       /***  $gambar = $request->file('gambar');
        $filename = $gambar->getClientOriginalName();
        $filename = $filename;
        $path = $gambar->storeAs('public/gambar', $filename);*/

       

        $dataKurir = DataKurir::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_ponsel' => $request->no_ponsel,
            'gambar' => $filename
    
        ]);

        /*return response([
            'kode' => 200,
            'message' => 'data berhasil dibuat',
            'data' => $dataKurir
        ]);*/
        return $dataKurir;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataKurir  $dataKurir
     * @return \Illuminate\Http\Response
     */
    public function show($dataKurir)
    {
        $showDataKurir = new DataKurirResource(DataKurir::find($dataKurir));
        return $showDataKurir;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataKurir  $dataKurir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataKurir)
    {
        $request->validate([
            'nik' => '',
            'nama' => '',
            'jenis_kelamin' => '',
            'alamat' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'no_ponsel' => '',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
           
        ]);

       
        $apdetDataKurir = DataKurir::find($dataKurir) ;

        $foto = $request->file('gambar');
        if ($foto) {
            # code...
            
            Storage::delete('public/gambar/'.$apdetDataKurir->gambar);
            $gambar = $request->file('gambar')->getClientOriginalName();
            $foto = $request->file('gambar')->storeAs('public/gambar', $gambar);
            $apdetDataKurir->gambar = $gambar;
            
        }

        if($foto == null){
             $apdetDataKurir->gambar;
        }

        $apdetDataKurir->nik           = $request->nik;
        $apdetDataKurir->nama          = $request->nama;
        $apdetDataKurir->jenis_kelamin = $request->jenis_kelamin;
        $apdetDataKurir->alamat        = $request->alamat;
        $apdetDataKurir->tempat_lahir  = $request->tempat_lahir;
        $apdetDataKurir->tanggal_lahir = $request->tanggal_lahir;
        $apdetDataKurir->no_ponsel     = $request->no_ponsel;
        
        
        $apdetDataKurir->update();
       

        /*return response([
            'kode' => 200,
            'message' => 'data berhasil diupdate',
            'data' => $apdetDataKurir
        ]);*/
        return $apdetDataKurir;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataKurir  $dataKurir
     * @return \Illuminate\Http\Response
     */
    public function destroy($dataKurir)
    {
        $hapusDataKurir = DataKurir::find($dataKurir);
        if ($hapusDataKurir->gambar) {
            Storage::delete('public/gambar/'.$hapusDataKurir->gambar);
        }
        $hapusDataKurir->delete();
        return $hapusDataKurir;
    }
}
