<!DOCTYPE html>
<html>
  <head>
    <title>Tambah Produk</title>
  </head>
  <body>
    <h1>Tambah Produk</h1>
    <form action="{{ route('barangs.store') }}" method="POST">
      @csrf

      <div>
        <label>Kode:</label>
        <input type="text" name="kode" value="{{ $kode }}" required readonly><br>
      </div>

      <div>
        <label>Nama:</label>
        <input type="text" name="nama" required><br>
      </div>

      <div>
        <label>Kategori:</label>
        <input type="text" name="kategori" required><br>
      </div>

      <div>
        <label>Harga:</label>
        <input type="numeric" name="harga" required><br>
      </div>

      <button type="submit">Simpan</button>
    </form>
  </body>
</html>
