<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\ItemPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;

class ApiPenjualanController extends Controller
{
  public function getId()
  {
    $id_nota = Penjualan::select("id_nota")
      ->orderBy('id_nota', 'desc')
      ->first();

    if(isset($id_nota))
    {
      $Exid = explode("_", $id_nota['id_nota']);
      $id = (int)$Exid[1];
      $id++;

      $id_nota = $Exid[0] . "_" . $id;
    }
    else
    {
      $id_nota = "NOTA_1";
    }

    return $id_nota;
  }

  public function getPenjualan()
  {
    $penjualans = Penjualan::select(
      "table_penjualan.id_nota", 
      "table_penjualan.tgl", 
      "table_penjualan.kode_pelanggan", 
      "pelanggan.nama AS nama_pelanggan",
      "barang.kode AS kode_barang",
      "barang.nama AS nama_barang",
      "barang.harga",
      "item_penjualan.qty",
      "table_penjualan.subtotal"
    )
    ->leftJoin("table_pelanggan AS pelanggan", "pelanggan.id_pelanggan", "=", "table_penjualan.kode_pelanggan")
    ->leftJoin("table_item_penjualan AS item_penjualan", "item_penjualan.nota", "=", "table_penjualan.id_nota")
    ->leftJoin("table_barang AS barang", "barang.kode", "=", "item_penjualan.kode_barang")
    ->get()->toArray();

    return $penjualans;
  }

  public function index()
  {
    $id_nota = $this->getId();
    $pelanggans = Pelanggan::all();
    $barangs = Barang::all();
    $penjualans = $this->getPenjualan();

    $data = [
      "id_nota" => $id_nota,
      "pelanggans" => $pelanggans,
      "barangs" => $barangs,
      "penjualans" => $penjualans
    ];

    return response()->json($data);
  }

  public function store(Request $request)
  {
    $request->validate([
      'id_nota' => 'required',
      'kode_barang' => 'required',
      'kode_pelanggan' => 'required',
      'qty' => 'required',
      'tgl' => 'required'
    ]);

    $input = $request->all();

    if(!empty($input))
    {
      $id_nota = isset($input['id_nota']) ? $input['id_nota'] : "";
      $tgl = isset($input['tgl']) ? $input['tgl'] : "";
      $kode_pelanggan = isset($input['kode_pelanggan']) ? $input['kode_pelanggan'] : "";
      $kode_barang = isset($input['kode_barang']) ? $input['kode_barang'] : "";
      $qty = isset($input['qty']) ? $input['qty'] : "";

      $getHargaBarang = Barang::select("harga")->where("kode", $kode_barang)->first();

      $harga = 0;
      if(!empty($getHargaBarang))
      {
        $harga = $getHargaBarang['harga'];
      }

      $subtotal = $harga * (int)$qty;

      try
      {
        DB::beginTransaction();

        Penjualan::create([
          'id_nota' => $id_nota,
          'tgl' => $tgl,
          'kode_pelanggan' => $kode_pelanggan,
          'subtotal' => $subtotal
        ]);

        ItemPenjualan::create([
          'nota' => $id_nota,
          'kode_barang' => $kode_barang,
          'qty' => $qty,
        ]);
        
        DB::commit();

        $data = [
          "penjualans" => $this->getPenjualan(),
          "id_nota" => $this->getId(),
        ];

        return response()->json($data, 201);
      }
      catch (\Exception $e)
      {
        DB::rollback();

        return response()->json(["message => Data gaga di simpan", "error" => $e->getMessage()], 500);
      }
    }

    return response()->json([], 500);
  }

  public function update(Request $request, $id_nota)
  {
    $input = $request->all();

    if(!empty($input))
    {
      $id_nota = isset($input['id_nota']) ? $input['id_nota'] : "";
      $tgl = isset($input['tgl']) ? $input['tgl'] : "";
      $kode_pelanggan = isset($input['kode_pelanggan']) ? $input['kode_pelanggan'] : "";
      $kode_barang = isset($input['kode_barang']) ? $input['kode_barang'] : "";
      $qty = isset($input['qty']) ? $input['qty'] : "";

      $getHargaBarang = Barang::select("harga")->where("kode", $kode_barang)->first();

      $harga = 0;
      if(!empty($getHargaBarang))
      {
        $harga = $getHargaBarang['harga'];
      }

      $subtotal = $harga * (int)$qty;

      try
      {
        DB::beginTransaction();

        $penjualan = [
          'tgl' => $tgl,
          'kode_pelanggan' => $kode_pelanggan,
          'subtotal' => $subtotal
        ];

        Penjualan::where('id_nota', $id_nota)->update($penjualan);

        $item_penjualan = [
          'kode_barang' => $kode_barang,
          'qty' => $qty,
        ];

        ItemPenjualan::where('nota', $id_nota)->update($item_penjualan);
        
        DB::commit();

        $data = [
          "penjualans" => $this->getPenjualan(),
          "id_nota" => $this->getId(),
        ];

        return response()->json($data, 201);
      }
      catch (\Exception $e)
      {
        DB::rollback();

        return response()->json(["message => Data gaga di simpan", "error" => $e->getMessage()], 500);
      }
    }
    return response()->json([], 500);
  }

  public function delete($id_nota)
  {
    try
    {
      DB::beginTransaction();
      
      Penjualan::where('id_nota', $id_nota)->delete();
      ItemPenjualan::where('nota', $id_nota)->delete();

      DB::commit();

      $data = [
        "penjualans" => $this->getPenjualan(),
        "id_nota" => $this->getId(),
      ];

      return response()->json($data, 201);
    }
    catch (\Exception $e)
    {
      DB::rollBack();

      return response()->json(["message => Data gagal di hapus", "error" => $e->getMessage()], 500);
    }
  }
}
