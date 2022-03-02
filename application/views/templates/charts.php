<script type="text/javascript">
       // Global method for setting Y axis number format.
Chart.scaleService.updateScaleDefaults('linear', {
  ticks: {/*ww w  .dem  o  2  s. c o m*/
    callback: function(tick) {
      return 'Rp.' + tick.toLocaleString();
    }
  }
});
// Global method for setting tooltip number format.
Chart.defaults.global.tooltips.callbacks.label = function(tooltipItem, data) {
  var dataset = data.datasets[tooltipItem.datasetIndex];
  var datasetLabel = dataset.label || '';
  return datasetLabel + " " + dataset.data[tooltipItem.index].toLocaleString();
};

       $(document).ready(function() {
        var barChart = document.getElementById('bar_diagram_masuk').getContext('2d');
        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
              labels: [
               <?php
                  if (count($tahun_charts_masuk)>0) {
                    foreach ($tahun_charts_masuk as $data) {
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




       $(document).ready(function() {
        var barChart = document.getElementById('bar_diagram_keluar').getContext('2d');
        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
              labels: [
               <?php
                  if (count($tahun_charts_keluar)>0) {
                    foreach ($tahun_charts_keluar as $data) {
                      echo "'" .$data->tahun_keluar."',";
                    }
                  }
                ?>
              ],
              datasets : [{
                label: "Pengeluaran (Rp.)",
                backgroundColor: '#f3545d',
                borderColor: '#f3545d',
                data: [
                  <?php
                    if (count($jumlah_charts_keluar)>0) {
                      foreach ($jumlah_charts_keluar as $data) {
                        echo "'" .$data->jumlah_keluar."',";
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