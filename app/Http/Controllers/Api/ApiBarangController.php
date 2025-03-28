<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;

class ApiBarangController extends Controller
{
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
      $kode = "BARANG_1";
    }

    return $kode;
  }

  public function index()
  {
    $kode = $this->getId();
    $barangs = Barang::all();

    $data = [
      "kode" => $kode,
      "barangs" => $barangs
    ];

    return response()->json($data);
  }

  public function store(Request $request)
  {
    $request->validate([
        'kode' => 'required',
        'nama' => 'required',
        'kategori' => 'required',
        'harga' => 'required'
    ]);

    $input = $request->all();

    if(!empty($input))
    {
      $data = [
        'kode' => $input["kode"],
        'nama' => $input["nama"],
        'kategori' => $input["kategori"],
        'harga' => $input["harga"],
      ];

      $pelanggan = Barang::create($data);
      $kode = $this->getId();

      $data = [
        'kode' => $kode,
        'data' => $pelanggan
      ];

      return response()->json($data, 201);
    }

    return response()->json([], 500);
  }

  public function show($id)
  {
      $pelanggan = Barang::find($id);
      if (!$pelanggan) {
          return response()->json(['message' => 'Barang tidak ditemukan'], 404);
      }
      return response()->json($pelanggan);
  }

  public function update(Request $request, $id)
  {
      $pelanggan = Barang::find($id);
      if (!$pelanggan) {
          return response()->json(['message' => 'Barang tidak ditemukan'], 404);
      }

      $pelanggan->update($request->all());
      return response()->json($pelanggan);
  }

  public function destroy($id)
  {
    $pelanggan = Barang::find($id);
    if (!$pelanggan) {
      return response()->json(['message' => 'Barang tidak ditemukan'], 404);
    }

    $pelanggan->delete();

    $kode = $this->getId();
    return response()->json(['kode' => $kode, 'message' => 'Barang berhasil dihapus']);
  }
}
