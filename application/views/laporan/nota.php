<!DOCTYPE html>
<html><head>
	<style>

    #tabel2 {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      border: 0px black;
      text-align: center;
    }

		th {
		  border:solid #dddddd;
		  text-align: center;
		  padding: 5px;
		}
		td {
		  border: 1px solid #dddddd;
		  
		}

		tr:nth-child(even){background-color: #f2f2f2}

    

	</style>
  <title><?= $title ?></title>

</head><body>
<div style=" font-size: 12px;">

  <table cellspacing="0" cellpadding="0" id="tabel1" style="text-align: left;padding: 0px;">
    <tr>
      <td rowspan="4" style="border: 0px;">BATU BULAN
        <br><img src="<?= $foto; ?>" width="80" height="80">

      </td>
      <td style="border: 0px;">Tanggal</td>
      <td style="border: 0px;">
        : <?= $data_nota['main_waktu_mulai'] ?>
      </td>
    </tr>
    <tr>
      <td style="border: 0px;" >Rute</td>
      <td style="border: 0px;">
        : <?= $data_nota['rute_nama'] ?>
      </td>
    </tr>
    <tr>
      <td style="border: 0px;">
        <div style="width: 65px;">
        </div>
          Nama toko
      </td>
      <td style="border: 0px;">
        <div style="width: 110px;">
        </div>
         : <?= $data_nota['toko_nama'] ?>
      </td>
    </tr>
    <tr>
      <td style="border: 0px;">Kontak toko</td>
      <td style="border: 0px;">: <?= $data_nota['toko_kontak'] ?></td>
    </tr>
  </table>

  <div style="width:135%;text-align: center; ">
    <hr >
<p>Nota Transaksi</p>
  </div>
<table id="tabel2" cellspacing="0" cellpadding="0">
            
  <tr>
    <th scope="col">#</th>
    <th scope="col">Nama Barang</th>
    <th scope="col">Qty</th>
    <th scope="col">Harga Satuan (Rp)</th>
    <th scope="col">Jumlah (Rp)</th>
    <th scope="col">Bonus</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Spray</td>
    <td><?= $data_nota['main_stok_sepray']?> </td>
    <td>Rp. <?= number_format($data_nota['main_harga_sepray'], 0, ",", ","); ?></td>
    <td>Rp. <?= number_format($data_nota['main_harga_sepray']*$data_nota['main_stok_sepray'], 0, ",", ",");?></td>
    <td><?= $data_nota['main_bonus_sepray']?></div></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Roll</td>
    <td><?= $data_nota['main_stok_roll']?> </td>
    <td>Rp. <?= number_format($data_nota['main_harga_roll'], 0, ",", ","); ?></td>
    <td>Rp. <?= number_format($data_nota['main_harga_roll'] * $data_nota['main_stok_roll'], 0, ",", ","); ?></td>
    <td><?= $data_nota['main_bonus_roll']?></div></td>

  </tr>
  <tr>
    <td colspan="4">TOTAL</td>
    <td>Rp. <?= number_format(($data_nota['main_harga_sepray']*$data_nota['main_stok_sepray']) + ($data_nota['main_harga_roll'] * $data_nota['main_stok_roll']), 0, ",", ","); ?></div></td>
    <td><?= $data_nota['main_bonus_sepray'] + $data_nota['main_bonus_roll']?></td>
  </tr>
</table>
<div style="text-align:right; width:135%;">
  <br><b>Hormat kami :</b>
  <br>
  <br>
  <br>
  Sales  : <u><?= $data_nota['user_nama'] ?></u><br>
  Kontak sales : <u><?= $data_nota['user_kontak'] ?></u>

</div>
</div>
</body></html>