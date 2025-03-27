<!DOCTYPE html>
<html>
  <head>
    <title>Daftar Produk</title>
  </head>
  <body>
    <h1>Daftar Produk</h1>
    <a href="{{ route('pelanggans.create') }}">Tambah Produk</a>
    <table border="1">
      <tr>
        <th>ID Pelanggan</th>
        <th>Nama</th>
        <th>Domisili</th>
        <th>Jenis Kelamin</th>
        <th>Action</th>
      </tr>
      @foreach ($pelanggans as $pelanggan)
      <tr>
        <td>{{ $pelanggan->id_pelanggan }}</td>
        <td>{{ $pelanggan->nama }}</td>
        <td>{{ $pelanggan->domisili }}</td>
        <td>{{ $pelanggan->jenis_kelamin }}</td>
        <td>
          <a href="{{ route('pelanggans.edit', $pelanggan->id_pelanggan) }}">Edit</a> |
          <form action="{{ route('pelanggans.delete', $pelanggan->id_pelanggan) }}" method="POST" style="display:inline;">
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
