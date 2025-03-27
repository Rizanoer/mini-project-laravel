<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
  public function index()
  {
    $barangs = Barang::all();
    return view('barangs.index', compact('barangs'));
  }

  public function getId()
  {
    $kode = Barang::select("kode")
      ->orderBy('kode', 'desc')
      ->first();

    if(isset($kode))
    {
      $Exid = explode("_", $kode['kode']);
      $id = (int)$Exid[1];
      $id++;

      $kode = $Exid[0] . "_" . $id;
    }
    else
    {
      $kode = "BRG_1";
    }

    return $kode;
  }

  
  public function create()
  {
    $kode = $this->getId();

    return view('barangs.create', compact('kode'));
  }

  
  public function store(Request $request)
  {
    $data = [];
    $input = $request->all();
    
    if(!empty($input))
    {
      $data = [
        'kode' => $input["kode"],
        'nama' => $input["nama"],
        'kategori' => $input["kategori"],
        'harga' => $input["harga"],
      ];

      Barang::create($data);
      return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan');
    }

    return redirect()->route('barangs.index')->with('warning', 'Barang gagal ditambahkan');
  }
  
  public function edit($kode)
  {
    $barang = Barang::where('kode', $kode)->firstOrFail();
    return view('barangs.edit', compact('barang'));
  }
  
  public function update(Request $request, Barang $barang)
  {
    $data = [];
    $input = $request->all();

    if(!empty($input))
    {
      $data = [
        "nama" => $input['nama'],
        "kategori" => $input['kategori'],
        "harga" => $input['harga'],
      ];

      Barang::where('kode', $input['kode'])->update($data);

      return redirect()->route('barangs.index')->with('success', 'Produk berhasil diperbarui');
    }

    return redirect()->route('barangs.index')->with('warning', 'Produk gagal diperbarui');
  }

  public function delete($kode)
  {
    Barang::where('kode', $kode)->delete();

    return redirect()->route('barangs.index')->with('success', 'Produk berhasil dihapus');
  }
}
