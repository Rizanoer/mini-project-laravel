<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>
    <form action="{{ route('barangs.update', $barang->kode) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
          <label>Kode:</label>
          <input type="text" name="kode" value="{{ $barang->kode }}" required readonly><br>
        </div>

        <div>
          <label>Nama:</label>
          <input type="text" name="nama" value="{{ $barang->nama }}" required><br>
        </div>

        <div>
          <label>Kategori:</label>
          <input type="text" name="kategori" value="{{ $barang->kategori }}" required><br>
        </div>

        <div>
          <label>Harga:</label>
        <input type="numeric" name="harga" value="{{ $barang->harga }}" required><br>
        </div>

        <button type="submit">Update</button>
    </form>
</body>
</html>
