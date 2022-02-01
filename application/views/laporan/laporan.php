<!DOCTYPE html>
<html><head>
	<style>
		table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}

		th {
		  border: 5px solid #dddddd;
		  text-align: center;
		  padding: 8px;
		}
		td {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;
		}

		tr:nth-child(odd) {
		  background-color: #dddddd;
		}
	</style>
  <title><?= $title ?></title>

</head><body>
<div style="text-align: center;">
	<h2 >Laporan Riwayat</h2>
	Tanggal <?= $tanggal1; ?> sampai dengan tanggal <?= $tanggal2; ?>
</div>
	<hr>
	

<table>
	<tr>
		<th rowspan="2">#No</th>
		<th rowspan="2">Tanggal</th>
		<th rowspan="2">Rute</th>
		<th rowspan="2">Nama Toko</th>
		<th rowspan="2">Nama Sales</th>
		<th colspan="2">Banyaknya</th>
		<th colspan="2">Harga Satuan</th>
		<th colspan="2">Jumlah</th>
		<th colspan="2">Bonus</th>
	</tr>
	<tr>
		<th>Spray</th>
		<th>Roll</th> 
		<th>Spray</th>
		<th>Roll</th>
		<th>Spray</th>
		<th>Roll</th>
		<th>Spray</th>
		<th>Roll</th>
	</tr>
	
	<?php 

		if (!empty($data_main)){ 
			$no = 0;
			$output = '';
			$qty_sepray = 0;
			$qty_roll = 0;
			$jumlah_sepray = 0;
			$jumlah_roll = 0;
			$qty_bonus_sepray = 0;
			$qty_bonus_roll = 0;
			foreach ($data_main as $row) {
				$no++;
				$output .= '
					<tr>
				    	<td style="text-align: center;">'.$no.'</td>
				        <td>'.$row['main_waktu_mulai'].'</td>
				        <td>'.$row['rute_nama'].'</td>
				        <td>'.$row['toko_nama'].'</td>
				        <td>'.$row['user_nama'].'</td>
				        <td style="text-align: center;">'.number_format($row['main_stok_sepray'], 0, ",", ",").'</td>
				        <td style="text-align: center;">'.number_format($row['main_stok_roll'], 0, ",", ",").'</td>
				        <td style="text-align: center;">'.number_format($row['main_harga_sepray'], 0, ",", ",").'</td>
				        <td style="text-align: center;">'.number_format($row['main_harga_roll'], 0, ",", ",").'</td>
				        <td style="text-align: center;">'.number_format($row['main_jumlah_sepray'], 0, ",", ",").'</td>
				        <td style="text-align: center;">'.number_format($row['main_jumlah_roll'], 0, ",", ",").'</td>
				        <td style="text-align: center;">'.number_format($row['main_bonus_sepray'], 0, ",", ",").'</td>
				        <td style="text-align: center;">'.number_format($row['main_bonus_roll'], 0, ",", ",").'</td>
				    </tr>
				';
				$qty_sepray = $qty_sepray + $row['main_stok_sepray'];
				$qty_roll = $qty_roll + $row['main_stok_roll'];
				$jumlah_sepray = $jumlah_sepray + $row['main_jumlah_sepray'];
				$jumlah_roll = $jumlah_roll + $row['main_jumlah_roll'];
				$qty_bonus_sepray = $qty_bonus_sepray + $row['main_bonus_sepray'];
				$qty_bonus_roll = $qty_bonus_roll + $row['main_bonus_roll'];
			}
			$output .= '
				<tr>
				    <th colspan="5" style="text-align: center; font-weight: bold;">TOTAL</th>
				    <th>'.number_format($qty_sepray, 0, ",", ",").'</th>
					<th>'.number_format($qty_roll, 0, ",", ",").'</th>
					<th> </th>
					<th> </th>
					<th>Rp.'.number_format($jumlah_sepray, 0, ",", ",").'</th>
					<th>Rp.'.number_format($jumlah_roll, 0, ",", ",").'</th>
					<th>'.number_format($qty_bonus_sepray, 0, ",", ",").'</th>
				  	<th>'.number_format($qty_bonus_roll, 0, ",", ",").'</th>
				</tr>
				</table>
			';
			echo $output;
		}
		else{
			echo '
				<tr>
					<td colspan="13" style="text-align: center;"> No data available!</td>
				</tr>
				</table>
			';
		}
	?>
</div>

</body></html>