<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
  public function index()
  {
    $pelanggans = Pelanggan::all();
    return view('pelanggans.index', compact('pelanggans'));
  }

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

  
  public function create()
  {
    $id_pelanggan = $this->getId();

    return view('pelanggans.create', compact('id_pelanggan'));
  }

  
  public function store(Request $request)
  {
    $data = [];
    $input = $request->all();
    
    if(!empty($input))
    {
      $data = [
        'id_pelanggan' => $input["id_pelanggan"],
        'nama' => $input["nama"],
        'domisili' => $input["domisili"],
        'jenis_kelamin' => $input["jenis_kelamin"],
      ];

      Pelanggan::create($data);
      return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    return redirect()->route('pelanggans.index')->with('warning', 'Pelanggan gagal ditambahkan');
  }
  
  public function edit($id_pelanggan)
  {
    $pelanggan = Pelanggan::where('id_pelanggan', $id_pelanggan)->firstOrFail();
    return view('pelanggans.edit', compact('pelanggan'));
  }
  
  public function update(Request $request, Pelanggan $pelanggan)
  {
    $data = [];
    $input = $request->all();

    if(!empty($input))
    {
      $data = [
        "nama" => $input['nama'],
        "domisili" => $input['domisili'],
        "jenis_kelamin" => $input['jenis_kelamin'],
      ];

      Pelanggan::where('id_pelanggan', $input['id_pelanggan'])->update($data);

      return redirect()->route('pelanggans.index')->with('success', 'Produk berhasil diperbarui');
    }

    return redirect()->route('pelanggans.index')->with('warning', 'Produk gagal diperbarui');
  }

  public function delete($id_pelanggan)
  {
    Pelanggan::where('id_pelanggan', $id_pelanggan)->delete();

    return redirect()->route('pelanggans.index')->with('success', 'Produk berhasil dihapus');
  }
}
