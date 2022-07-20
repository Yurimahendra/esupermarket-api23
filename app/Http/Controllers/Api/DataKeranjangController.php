<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataKeranjangResource;
use App\Models\DataKeranjang;
use Illuminate\Http\Request;

class DataKeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getDataProduk = DataKeranjangResource::collection(DataKeranjang::all());
        return $getDataProduk;
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
            'nama_barang' => 'required',
            'merk' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
            'min_belanja' => 'required|integer',
            'ongkir' => 'required',
            'gambar' => 'nullable',
            'deskripsi' => 'nullable'
        ]);


    
        

       

        $dataProduk = DataKeranjang::create([
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'min_belanja' => $request->min_belanja,
            'ongkir' => $request->ongkir,
            'gambar' => $request->gambar,
            'deskripsi' => $request->deskripsi
        ]);

        /*return response(
            ['kode' => 200,
            'pesan' => 'data berhasil ditambahkan',
            'data' => new DataProdukResource($dataProduk)
        ]);*/
        return $dataProduk;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataKeranjang  $dataKeranjang
     * @return \Illuminate\Http\Response
     */
    public function show($dataKeranjang)
    {
        $showProduk = new DataKeranjangResource(DataKeranjang::find($dataKeranjang));
        return  $showProduk;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataKeranjang  $dataKeranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataKeranjang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'merk' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
            'min_belanja' => 'required|integer',
            'ongkir' => 'required',
            'gambar' => 'nullable',
            'deskripsi' => 'nullable'
        ]);

        
        $apdet = DataKeranjang::find($dataKeranjang);
        $apdet->nama_barang   = $request->nama_barang;
        $apdet->merk          = $request->merk;
        $apdet->harga         = $request->harga;
        $apdet->satuan        = $request->satuan;
        $apdet->min_belanja   = $request->min_belanja;
        $apdet->ongkir        = $request->ongkir;
        $apdet->gambar        = $request->gambar;
        $apdet->deskripsi     = $request->deskripsi;
        
        $apdet->update();

        
        /*return response([
            'pesan' => 'data berhasil diupdate',
            'data' => $apdet
        ], 200);*/
        return $apdet;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataKeranjang  $dataKeranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy($dataKeranjang)
    {
        $hapusDataproduk = DataKeranjang::find($dataKeranjang);
        $hapusDataproduk->delete();
        return $hapusDataproduk;
    }
}
