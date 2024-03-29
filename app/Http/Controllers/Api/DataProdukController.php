<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataProdukResource;
use App\Models\DataProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getDataProduk = DataProdukResource::collection(DataProduk::all());
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'deskripsi' => 'nullable'
        ]);


        $gambar = $request->file('gambar');
        $filename = null;
        if ($gambar) {
            $filename = date('YmdHis').".".$gambar->getClientOriginalName();
            $filename = $filename;
            $path = $gambar->storeAs('public/gambar', $filename);
        }else{
            $filename = null;
        }
        

       

        $dataProduk = DataProduk::create([
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'min_belanja' => $request->min_belanja,
            'ongkir' => $request->ongkir,
            'gambar' => $filename,
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
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function show($dataProduk)
    {
        $showProduk = new DataProdukResource(DataProduk::find($dataProduk));
        return  $showProduk;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataProduk)
    {
        $request->validate([
            'nama_barang' => 'required',
            'merk' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
            'min_belanja' => 'required|integer',
            'ongkir' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'deskripsi' => 'nullable'
        ]);

        
        $apdet = DataProduk::find($dataProduk);
        $foto = $request->file('gambar');
        
    
//$foto == null || $foto == $apdet->gambar
        if($foto){
            Storage::delete('public/gambar/'.$apdet->gambar);
            $gambar = date('YmdHis').".".$request->file('gambar')->getClientOriginalName();
            $foto = $request->file('gambar')->storeAs('public/gambar', $gambar);
            $apdet->gambar = $gambar;

        }else{
            # code...
            $apdet->gambar;

        }

        $apdet->nama_barang   = $request->nama_barang;
        $apdet->merk          = $request->merk;
        $apdet->harga         = $request->harga;
        $apdet->satuan        = $request->satuan;
        $apdet->min_belanja   = $request->min_belanja;
        $apdet->ongkir        = $request->ongkir;
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
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($dataProduk)
    {
        $hapus = DataProduk::find($dataProduk);
        if ($hapus->gambar) {
            Storage::delete('public/gambar/'.$hapus->gambar);
        }
        $hapus->delete();
        return $hapus;
    }
}
