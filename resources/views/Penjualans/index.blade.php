<!DOCTYPE html>
<html>
  <head>
    <title>Penjualan</title>
  </head>
  <body>
    <h1>Penjualan</h1>
    <a href="{{ route('penjualans.create') }}">Tambah Penjualan</a>
    <table border="1">
      <tr>
        <th>ID Nota</th>
        <th>Tanggal</th>
        <th>Kode Pelanggan</th>
        <th>Subtotal</th>
        <th>Action</th>
      </tr>
      @foreach ($penjualans as $penjualan)
      <tr>
        <td>{{ $penjualan->id_nota }}</td>
        <td>{{ $penjualan->tgl }}</td>
        <td>{{ $penjualan->kode_pelanggan }}</td>
        <td>{{ $penjualan->subtotal }}</td>
        <td>
          <a href="{{ route('penjualans.edit', $penjualan->id_nota) }}">Edit</a> |
          <form action="{{ route('penjualans.delete', $penjualan->id_nota) }}" method="POST" style="display:inline;">
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
