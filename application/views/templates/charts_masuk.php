<script type="text/javascript">
       
       $(document).ready(function() {
        var barChart = document.getElementById('bar_diagram_masuk').getContext('2d');
        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
              labels: [
               <?php
                  if (count($tahun_charts)>0) {
                    foreach ($tahun_charts as $data) {
                      echo "'" .$data->tahun_masuk."',";
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
                    if (count($jumlah_charts)>0) {
                      foreach ($jumlah_charts as $data) {
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