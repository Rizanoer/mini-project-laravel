<!DOCTYPE html>
<html>
  <head>
    <title>Daftar Produk</title>
  </head>
  <body>
    <h1>Daftar Produk</h1>
    <a href="{{ route('barangs.create') }}">Tambah Produk</a>
    <table border="1">
      <tr>
        <th>ID Barang</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Action</th>
      </tr>
      @foreach ($barangs as $barang)
      <tr>
        <td>{{ $barang->kode }}</td>
        <td>{{ $barang->nama }}</td>
        <td>{{ $barang->kategori }}</td>
        <td>{{ $barang->harga }}</td>
        <td>
          <a href="{{ route('barangs.edit', $barang->kode) }}">Edit</a> |
          <form action="{{ route('barangs.delete', $barang->kode) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </body>
</html>
