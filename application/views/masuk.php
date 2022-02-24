
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Pemasukan Desa</h1>
      </div>

      <div class="card">
        <div class="row ">
             <div class="card-header ml-2">
               <div class="form-inline">
                  <?= $isi_card_header; ?>
                </div>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <div id="filter_datatable">
                  <?= $isi_konten; ?>  
                </div>
            </div>
          </div>
        </div>
        </div>
        <hr>
        <br>
        <div class="card">
          <div class="card-header ml-2">
               <div class="form-inline">
                  <H1>STATISTIK DIAGRAM PEMASUKAN</H1>
                </div>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
                  <div style="width: 300px; height: 300px">
                    <canvas id="bar_diagram_masuk" height="300" width="0"></canvas>
                  </div>
                </div>
            </div>
          </div>
        </div>