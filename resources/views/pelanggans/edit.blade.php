<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>
    <form action="{{ route('pelanggans.update', $pelanggan->id_pelanggan) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
          <label>ID Pelanggan:</label>
          <input type="text" name="id_pelanggan" value="{{ $pelanggan->id_pelanggan }}" required readonly><br>
        </div>

        <div>
          <label>Nama:</label>
          <input type="text" name="nama" value="{{ $pelanggan->nama }}" required><br>
        </div>

        <div>
          <label>Domisili:</label>
          <input type="text" name="domisili" value="{{ $pelanggan->domisili }}" required><br>
        </div>

        <div>
          <label>Jenis Kelamin:</label>
          <input @checked(old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'PRIA') name="jenis_kelamin" type="radio" value="PRIA" /> PRIA <br /> 
          <input @checked(old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'WANITA') name="jenis_kelamin" type="radio" value="WANITA" /> Wanita <br />  
        </div>

        <button type="submit">Update</button>
    </form>
</body>
</html>
