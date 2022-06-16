<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataOrderanResource;
use App\Models\DataOrderan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'id_pesanan' => 'required',
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'harga_barang' => 'required',
            'jumlah_pesanan' => 'required|integer',
            'satuan' => 'required',
            'gambar' => 'required',
            'tanggal_pengiriman' => 'required',
            'ongkir' => 'nullable',
            'total_harga' => 'required',
            'metode_pembayaran' => 'required',
            'status' => 'nullable',
            'status_pesanan' => 'nullable',
            'bukti_transfer' => 'nullable'
        ]);


        $dataOrderan = DataOrderan::create([
            'id_pesanan' => $request->id_pesanan,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'nama_barang' => $request->nama_barang,
            'merk_barang' => $request->merk_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'satuan' => $request->satuan,
            'gambar' => $request->gambar,
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'ongkir' => $request->ongkir,
            'total_harga' => $request->total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => $request->status,
            'status_pesanan' => $request->status_pesanan,
            'bukti_transfer' => $request->bukti_transfer,
        ]);

        return $dataOrderan;
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
            'id_pesanan' => 'required',
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'harga_barang' => 'required',
            'jumlah_pesanan' => 'required|integer',
            'satuan' => 'required',
            'gambar' => 'required',
            'tanggal_pengiriman' => 'required',
            'ongkir' => 'nullable',
            'total_harga' => 'required',
            'metode_pembayaran' => 'required',
            'status' => 'nullable',
            'status_pesanan' => 'nullable',
            'bukti_transfer' => 'nullable',
        ]);

        

        $apdetDataOrderan = DataOrderan::find($dataOrderan);

        $foto = $request->file('bukti_transfer');
        if($foto){
            Storage::delete('public/gambar/'.$apdetDataOrderan->bukti_transfer);
            $gambar = date('YmdHis').".".$request->file('bukti_transfer')->getClientOriginalName();
            $foto = $request->file('bukti_transfer')->storeAs('public/gambar', $gambar);
            $apdetDataOrderan->bukti_transfer = $gambar;

        }else{
            # code...
            $apdetDataOrderan->bukti_transfer;

        }


        $apdetDataOrderan->id_pesanan           = $request->id_pesanan;
        $apdetDataOrderan->nama          = $request->nama;
        $apdetDataOrderan->no_hp         = $request->no_hp;
        $apdetDataOrderan->alamat       = $request->alamat;
        $apdetDataOrderan->latitude         = $request->latitude;
        $apdetDataOrderan->longitude        = $request->longitude;
        $apdetDataOrderan->nama_barang        = $request->nama_barang;
        $apdetDataOrderan->merk_barang        = $request->merk_barang;
        $apdetDataOrderan->harga_barang        = $request->harga_barang;
        $apdetDataOrderan->jumlah_pesanan  = $request->jumlah_pesanan;
        $apdetDataOrderan->satuan = $request->satuan;
        $apdetDataOrderan->gambar = $request->gambar;
        $apdetDataOrderan->tanggal_pengiriman  = $request->tanggal_pengiriman;
        $apdetDataOrderan->ongkir = $request->ongkir;
        $apdetDataOrderan->total_harga     = $request->total_harga;
        $apdetDataOrderan->metode_pembayaran    = $request->metode_pembayaran;
        $apdetDataOrderan->status     = $request->status;
        $apdetDataOrderan->status_pesanan     = $request->status_pesanan;
    
        
        $apdetDataOrderan->update();

        return $apdetDataOrderan;
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
        if ($hapusDataOrderan->bukti_transfer) {
            Storage::delete('public/gambar/'.$hapusDataOrderan->bukti_transfer);
        }
        $hapusDataOrderan->delete();
        return $hapusDataOrderan;
    }
}
