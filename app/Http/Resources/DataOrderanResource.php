<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataOrderanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_pesanan' => $this->id_pesanan,
            'nama' => $this->nama,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'nama_barang' => $this->nama_barang,
            'merk_barang' => $this->merk_barang,
            'harga_barang' => $this->harga_barang,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'satuan' => $this->satuan,
            'gambar' => $this->gambar,
            'tanggal_pengiriman' => $this->tanggal_pengiriman,
            'ongkir' => $this->ongkir,
            'total_harga' => $this->total_harga,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status' => $this->status,
            'status_pesanan' => $this->status_pesanan,
            'bukti_transfer' => $this->bukti_transfer,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
