<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pelanggan;

class ApiPelangganController extends Controller
{
  public function getId()
  {
    $id_pelanggan = Pelanggan::select("id_pelanggan")
      ->orderBy('id_pelanggan', 'desc')
      ->first();

    if(isset($id_pelanggan))
    {
      $Exid = explode("_", $id_pelanggan['id_pelanggan']);
      $id = (int)$Exid[1];
      $id++;

      $id_pelanggan = $Exid[0] . "_" . $id;
    }
    else
    {
      $id_pelanggan = "PELANGGAN_1";
    }

    return $id_pelanggan;
  }

  public function index()
  {
    $id_pelanggan = $this->getId();
    $pelanggans = Pelanggan::all();

    $data = [
      "id_pelanggan" => $id_pelanggan,
      "pelanggans" => $pelanggans
    ];

    return response()->json($data);
  }

  public function store(Request $request)
  {
    $request->validate([
      'id_pelanggan' => 'required',
      'nama' => 'required',
      'domisili' => 'required',
      'jenis_kelamin' => 'required'
    ]);

    $input = $request->all();

    if(!empty($input))
    {
      $data = [
        'id_pelanggan' => $input["id_pelanggan"],
        'nama' => $input["nama"],
        'domisili' => $input["domisili"],
        'jenis_kelamin' => $input["jenis_kelamin"],
      ];

      $pelanggan = Pelanggan::create($data);
      $id_pelanggan = $this->getId();

      $data = [
        'id_pelanggan' => $id_pelanggan,
        'data' => $pelanggan
      ];

      return response()->json($data, 201);
    }

    return response()->json([], 500);
  }

  public function update(Request $request, $id)
  {
    $pelanggan = Pelanggan::find($id);
    if (!$pelanggan) {
      return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
    }

    $pelanggan->update($request->all());
    return response()->json($pelanggan);
  }

  public function destroy($id)
  {
    $pelanggan = Pelanggan::find($id);
    if (!$pelanggan) {
      return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
    }

    $pelanggan->delete();

    $id_pelanggan = $this->getId();
    return response()->json(['id_pelanggan' => $id_pelanggan, 'message' => 'Pelanggan berhasil dihapus']);
  }
}
