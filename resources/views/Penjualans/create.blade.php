<!DOCTYPE html>
<html>
  <head>
    <title>Tambah Penjualan</title>
  </head>
  <body>
    <h1>Tambah Penjualan</h1>
    <form action="{{ route('penjualans.store') }}" method="POST">
      @csrf

      <div>
        <label>ID Nota:</label>
        <input type="text" name="id_nota" value="{{ $id_nota }}" required readonly><br>
      </div>

      <div>
        <label>Tanggal:</label>
        <input type="date" name="tgl" required><br>
      </div>

      <div>
        <label>Nama Pelanggan:</label>
        <select name="kode_pelanggan" id="kode_pelanggan" required>
          <option value=""></option>
          @foreach ($pelanggans as $pelanggan)
            <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label>Nama Barang:</label>
        <select name="kode_barang" id="kode_barang" required>
          <option value=""></option>
          @foreach ($barangs as $barang)
            <option value="{{ $barang->kode }}">{{ $barang->nama }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label>Qty:</label>
        <input type="numeric" name="qty" required><br>
      </div>

      <button type="submit">Simpan</button>
    </form>
  </body>
</html>
