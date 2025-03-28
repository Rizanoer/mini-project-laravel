<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
      .button {
          display: inline-block;
          padding: 10px 20px;
          margin: 10px;
          font-size: 16px;
          text-decoration: none;
          color: white;
          background-color: #007bff;
          border-radius: 5px;
          border: none;
          cursor: pointer;
      }
      .button:hover {
          background-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <div style="text-align: center">
      <a href="{{ route('pelanggans.index') }}" class="button">Pelanggan</a>
      <a href="{{ route('barangs.index') }}" class="button">Barang</a>
      <a href="{{ route('penjualans.index') }}" class="button">Penjualan</a>
    </div>
  </body>
</html>
