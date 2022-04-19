<script type="text/javascript">
       
       $(document).ready(function() {
        var barChart = document.getElementById('bar_diagram_masuk').getContext('2d');
        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
              labels: [
               <?php
                  if (count($sumber_masuk)>0) {
                    foreach ($sumber_masuk as $data) {
                      echo "'" .$data->sumber_masuk_nama."',";
                    }
                  }
                ?>
              ],
              datasets : [{
                label: "Pemasukan (Rp.)",
                backgroundColor: 'rgb(23, 125, 255)',
                borderColor: 'rgb(23, 125, 255)',
                data: [
                  <?php
                    if (count($jumlah_charts_masuk)>0) {
                      foreach ($jumlah_charts_masuk as $data) {
                        echo "'" .$data->jumlah_masuk."',";
                      }
                    }
                  ?>
                  ],
              }],
            },
            options: {
              responsive: true, 
              maintainAspectRatio: false,
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero:true
                  }
                }]
              },
            }
          });
        
      } );


     </script>