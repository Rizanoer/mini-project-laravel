<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ItemPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
  public function index()
  {
    $penjualans = Penjualan::all();
    return view('penjualans.index', compact('penjualans'));
  }

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

  
  public function create()
  {
    $id_nota = $this->getId();
    $pelanggans = Pelanggan::all();
    $barangs = Barang::all();

    $data = [
      'id_nota' => $id_nota,
      'pelanggans' => $pelanggans,
      'barangs' => $barangs
    ];

    return view('penjualans.create', $data);
  }

  
  public function store(Request $request)
  {
    $data = [];
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

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil ditambahkan');
      }
      catch (\Exception $e)
      {
        DB::rollback();

        return redirect()->route('penjualans.index')->with('error', 'Penjualan gagal ditambahkan: ' . $e->getMessage());
      }
    }

    return redirect()->route('penjualans.index')->with('warning', 'Input Kosong');
  }
  
  public function edit($id_nota)
  {
    $pelanggans = Pelanggan::all();
    $barangs = Barang::all();

    $penjualan = Penjualan::where('id_nota', $id_nota)->firstOrFail();
    $item_penjualan = ItemPenjualan::where('nota', $id_nota)->firstOrFail();

    $data = [
      'pelanggans' => $pelanggans,
      'barangs' => $barangs,
      'penjualan' => $penjualan,
      'item_penjualan' => $item_penjualan
    ];

    return view('penjualans.edit', $data);
  }
  
  public function update(Request $request, Barang $barang)
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

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil di update');
      }
      catch (\Exception $e)
      {
        DB::rollback();

        return redirect()->route('penjualans.index')->with('success', 'Penjualan gagal di update');
      }
    }

    return redirect()->route('penjualans.index')->with('warning', 'Input Kosong');
  }

  public function delete($id_nota)
  {
    try
    {
      DB::beginTransaction();
      
      Penjualan::where('id_nota', $id_nota)->delete();
      ItemPenjualan::where('nota', $id_nota)->delete();

      DB::commit();

      return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil di hapus');
    }
    catch (\Exception $e)
    {
      DB::rollBack();

      return redirect()->route('penjualans.index')->with('success', 'Penjualan gagal di update');
    }
  }
}
