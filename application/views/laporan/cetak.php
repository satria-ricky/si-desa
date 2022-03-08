<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                /*background-color: #4CAF50;*/
                color: black;
            }

            #ttd {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #ttd th {
                /*padding-top: 10px;
                padding-bottom: 10px;*/
                /*background-color: #4CAF50;*/
                color: black;
                /*border: 1px solid #ddd;*/
                /*padding: 8px;*/
            }
        </style>
</head><body>
        <div id="table" style="text-align:center" >
            <h3> RINCIAN ANGGARAN <?php echo $v_jenis_beneran; ?> DESA <br> PEMERINTAH DORI DUNGGA KECAMATAN DONGGO <br> TAHUN ANGGARAN <?php echo $v_tahun; ?></h3>
        </div>
        <div> <?php echo $isi_konten; ?> </div>
        <!-- <table id="table">
            <thead>
                <tr>
                    <th style="text-align:center">KODE REKENING</th>
                    <th style="text-align:center">URAIAN</th>
                    <th style="text-align:center">TAHUN</th>
                    <th style="text-align:center">HARGA SATUAN</th>
                    <th style="text-align:center">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td>Kacang Goreng</td>
                    <td>Rp5.000,-</td>
                    <td>1</td>
                    <td>25 Oktober 2020, 17:01:03</td>
                </tr>
                <tr>
                    <td scope="row">2</td>
                    <td>Kopi Hitam</td>
                    <td>Rp5.000,-</td>
                    <td>1</td>
                    <td>25 Oktober 2020, 16:01:03</td>
                </tr>
                <tr>
                    <td scope="row">3</td>
                    <td>Gorengan Bakwan</td>
                    <td>Rp3.000,-</td>
                    <td>3</td>
                    <td>25 Oktober 2020, 15:01:02</td>
                </tr>
                <tr>
                    <td scope="row">4</td>
                    <td>Nasi uduk</td>
                    <td>Rp14.000,-</td>
                    <td>2</td>
                    <td>25 Oktober 2020, 14:04:03</td>
                </tr>
            </tbody>
            <tfoot>
                
            </tfoot>
        </table> -->
        <br>
        <table id="ttd" >
            <thead >
                <tr>
                    <th style="text-align:center; width: 50%;">Disetujui</th>
                    <th style="text-align:right;padding-right: 40px;">Desa Doridungga, <?php echo date("d-m-Y"); ?></th>
                </tr>
                <tr>
                    <th style="text-align:center;padding-bottom: 70px;">Kepala Desa</th>
                    <th style="text-align:center;padding-bottom: 70px;">Sekretaris</th>
                </tr>
                <tr>
                    <th style="text-align:center"><?php echo $v_ketua; ?></th>
                    <th style="text-align:center"><?php echo $v_sekretaris; ?></th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            n =  new Date();
            y = n.getFullYear();
            m = n.getMonth() + 1;
            d = n.getDate();
            document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
        </script>
    </body></html>