<!DOCTYPE html>
  <head>
    <style>
      .header {
        display: flex;
        justify-content: center;
        margin-bottom: 50px;
      }
      table.tb_pelanggan {
        border: 0px solid #000000;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
      }
      table.tb_pelanggan td, table.tb_pelanggan th {
        border: 1px solid #000000;
        padding: 5px 4px;
      }
      table.tb_pelanggan tbody td {
        font-size: 13px;
      }
      table.tb_pelanggan thead {
        background: #CFCFCF;
        background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
        background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
        background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
      }
      table.tb_pelanggan thead th {
        font-size: 15px;
        font-weight: bold;
        color: #000000;
        text-align: center;
      }
      table.tb_pelanggan tfoot td {
        font-size: 14px;
      }
    </style>
  </head>
  <body>
    <section class="layout">
      <div class="header"></div>
      <div class="main">
        <div>
          {{-- <a href="{{ route('pelanggan.tambah') }}" class="btn btn-primary">Tambah Data</a> --}}
        </div>
        <table class="tb_pelanggan">
          <thead>
            <tr>
              <th>ID Pelanggan</th>
              <th>Nama</th>
              <th>Domisili</th>
              <th>Jenis Kelamin</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>cell1_1</td>
              <td>cell2_1</td>
              <td>cell3_1</td>
              <td>cell4_1</td>
              <td>cell5_1</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </body>
</html>