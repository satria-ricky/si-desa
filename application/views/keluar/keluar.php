
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Pengeluaran Desa</h1>
      </div>
      <div class="card">
        <div class="row ">
             <div class="card-header ml-2">
               <div class="form-inline">
                  <?= $isi_card_header; ?>
                </div>
              </div>
            <div class="card-body">

              <div class="row ">
                  <div class="card">
                      <div class="card-header ml-2">
                       <div class="form-inline">
                          <H3>DIAGRAM PENGELUARAN</H3>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <?= $isi_diagram; ?>
                        </div>
                      </div>
                  </div>                
              </div>
              
              <div class="row">
                <div class="table-responsive">
                    <div id="filter_datatable">
                      <?= $isi_konten; ?>  
                    </div>
                </div>    
              </div>
            


          </div>
        </div>
      </div>

      
     

    