<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataOrderanResource;
use App\Models\DataOrderan;
use Illuminate\Http\Request;

class DataOrderanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataOrderanResource::collection(DataOrderan::all());
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
            'order_id' => 'required',
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'nama_barang' => 'required',
            'jumlah_pesanan' => 'required|integer',
            'ongkir' => 'required|integer',
            'total_harga' => 'required|integer',
            'metode_pembayaran' => 'required',
            'status' => 'required'
        ]);


        $dataOrderan = DataOrderan::create([
            'order_id' => $request->order_id,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'nama_barang' => $request->nama_barang,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'ongkir' => $request->ongkir,
            'total_harga' => $request->total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => $request->status,
        ]);

        return new DataOrderanResource($dataOrderan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataOrderan  $dataOrderan
     * @return \Illuminate\Http\Response
     */
    public function show($dataOrderan)
    {
        return new DataOrderanResource(DataOrderan::find($dataOrderan));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataOrderan  $dataOrderan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataOrderan)
    {
        $request->validate([
            'order_id'          => 'required',
            'nama'              => 'required',
            'no_hp'             => 'required',
            'alamat'            => 'required',
            'nama_barang'       => 'required',
            'jumlah_pesanan'    => 'required|integer',
            'ongkir'            => 'required|integer',
            'total_harga'       => 'required|integer',
            'metode_pembayaran' => 'required',
            'status'            => 'required'
        ]);

        $apdetDataOrderan = DataOrderan::find($dataOrderan);
        $apdetDataOrderan->order_id           = $request->order_id;
        $apdetDataOrderan->nama          = $request->nama;
        $apdetDataOrderan->no_hp         = $request->no_hp;
        $apdetDataOrderan->alamat = $request->alamat;
        $apdetDataOrderan->nama_barang        = $request->nama_barang;
        $apdetDataOrderan->jumlah_pesanan  = $request->jumlah_pesanan;
        $apdetDataOrderan->ongkir = $request->ongkir;
        $apdetDataOrderan->total_harga     = $request->total_harga;
        $apdetDataOrderan->metode_pembayaran    = $request->metode_pembayaran;
        $apdetDataOrderan->status     = $request->status;
        
        $apdetDataOrderan->update();

        return response([
            'message' => 'data berhasil diupdate',
            'data' => $apdetDataOrderan
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataOrderan  $dataOrderan
     * @return \Illuminate\Http\Response
     */
    public function destroy($dataOrderan)
    {
        $hapusDataOrderan = DataOrderan::find($dataOrderan);
        $hapusDataOrderan->delete();
        return response([
            'message' => 'berhasil dihapus',
            'data' => $hapusDataOrderan
        ], 200);
    }
}
