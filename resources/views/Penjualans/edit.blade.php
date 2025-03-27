<!DOCTYPE html>
<html>
<head>
    <title>Edit Penjualan</title>
</head>
<body>
    <h1>Edit Penjualan</h1>
    <form action="{{ route('penjualans.update', $penjualan->id_nota) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
          <label>ID Nota:</label>
          <input type="text" name="id_nota" value="{{ $penjualan->id_nota }}" required readonly><br>
        </div>

        <div>
          <label>Tanggal:</label>
          <input type="data" name="tgl" value="{{ $penjualan->tgl }}" required><br>
        </div>

        <div>
          <label>Nama Pelanggan:</label>
          <select name="kode_pelanggan" id="kode_pelanggan" required>
            <option value=""></option>
            @foreach ($pelanggans as $pelanggan)
              <option 
                value="{{ $pelanggan->id_pelanggan }}"
                {{ isset($penjualan->kode_pelanggan) && $penjualan->kode_pelanggan == $pelanggan->id_pelanggan ? 'selected' : '' }}
              >
                {{ $pelanggan->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label>Nama Barang:</label>
          <select name="kode_barang" id="kode_barang" required>
            <option value=""></option>
            @foreach ($barangs as $barang)
              <option 
                value="{{ $barang->kode }}"
                {{ isset($item_penjualan->kode_barang) && $item_penjualan->kode_barang == $barang->kode ? 'selected' : '' }}
              >
                {{ $barang->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label>Qty:</label>
        <input type="numeric" name="qty" value="{{ $item_penjualan->qty }}" required><br>
        </div>

        <button type="submit">Update</button>
    </form>
</body>
</html>
