<!DOCTYPE html>
<html>
  <head>
    <title>Tambah Produk</title>
  </head>
  <body>
    <h1>Tambah Produk</h1>
    <form action="{{ route('pelanggans.store') }}" method="POST">
      @csrf

      <div>
        <label>ID Pelanggan:</label>
        <input type="text" name="id_pelanggan" value="{{ $id_pelanggan }}" required readonly><br>
      </div>

      <div>
        <label>Nama:</label>
        <input type="text" name="nama" required><br>
      </div>

      <div>
        <label>Domisili:</label>
        <input type="text" name="domisili" required><br>
      </div>

      <div>
        <label>Jenis Kelamin:</label>
        <input checked="checked" name="jenis_kelamin" type="radio" value="PRIA" /> PRIA <br /> 
        <input name="jenis_kelamin" type="radio" value="WANITA" /> Wanita <br />  
      </div>

      <button type="submit">Simpan</button>
    </form>
  </body>
</html>
