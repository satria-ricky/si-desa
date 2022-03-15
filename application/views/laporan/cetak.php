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
            <h3> RINCIAN ANGGARAN <?php echo $v_jenis_beneran; ?> DESA <br> PEMERINTAH DORI DUNGGA KECAMATAN DONGGO <br> TAHUN ANGGARAN <?php echo $laporan['laporan_tahun']; ?></h3>
        </div>
        <div> <?php echo $isi_konten; ?> </div>
        
        <br>
        <table id="ttd" >
            <thead >
                <tr>
                    <th style="text-align:center; width: 50%;">Disetujui</th>
                    <th style="text-align:right;padding-right: 40px;">Desa Doridungga, <?php echo $laporan['laporan_created']; ?></th>
                </tr>
                <tr>
                    <th >Kepala Desa</th>
                    <th >Sekretaris</th>
                </tr>
                <tr>
                    <th > <img style="width: 200px; height: 130px; margin-top: 15px;" src="<?php echo base_url('assets/foto/ttd/').$kepala['user_ttd'];?>"></th>
                    <th ><img style="width: 200px; height: 130px; margin-top: 15px;" src="<?php echo base_url('assets/foto/ttd/').$sekretaris['user_ttd'];?>"></th>
                </tr>
                <tr>
                    <th style="text-align:center"><?php echo $kepala['user_nama']; ?></th>
                    <th style="text-align:center"><?php echo $sekretaris['user_nama']; ?></th>
                </tr>
            </thead>
        </table>
    </body></html>
