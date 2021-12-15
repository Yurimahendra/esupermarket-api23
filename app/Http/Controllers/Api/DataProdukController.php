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
        return DataProdukResource::collection(DataProduk::all());
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
            'harga' => 'required|integer',
            'satuan' => 'required',
            'stok' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required'
        ]);


        $gambar = $request->file('gambar');
        $filename = $gambar->getClientOriginalName();
        $filename = $filename;
        $path = $gambar->storeAs('public/gambar', $filename);

       

        $dataProduk = DataProduk::create([
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'gambar' => $filename,
            'deskripsi' => $request->deskripsi
        ]);

        return new DataProdukResource($dataProduk);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function show($dataProduk)
    {
        return new DataProdukResource(DataProduk::find($dataProduk));
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
            'harga' => 'required|integer',
            'satuan' => 'required',
            'stok' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required'
        ]);

        
        $apdet = DataProduk::find($dataProduk);
        $foto = $request->file('gambar');
        if ($foto) {
            # code...
            
            Storage::delete('public/gambar/'.$apdet->gambar);
            $gambar = $request->file('gambar')->getClientOriginalName();
            $foto = $request->file('gambar')->storeAs('public/gambar', $gambar);
            $apdet->gambar = $gambar;
            
        }

        if($foto == null){
             $apdet->gambar;
        }

        $apdet->nama_barang           = $request->nama_barang;
        $apdet->merk          = $request->merk;
        $apdet->harga         = $request->harga;
        $apdet->satuan = $request->satuan;
        $apdet->stok        = $request->stok;
        $apdet->deskripsi  = $request->deskripsi;
        
        $apdet->update();

        
        return response([
            'message' => 'data berhasil diupdate',
            'data' => $apdet
        ], 200);
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
        return response([
            'message' => 'berhasil dihapus',
            'data' => $hapus
        ], 200);
    }
}
