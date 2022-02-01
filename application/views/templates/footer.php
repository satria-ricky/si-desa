<footer class="footer">
        <div class="container-fluid">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fab fa-instagram text-danger"></i>
                  Instagram
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="#">
                  <i class="fab fa-facebook text-primary"></i>
                  Facebook
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="#">
                  <i class="fab fa-whatsapp-square text-success"></i>
                  Whatsapp
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright ml-auto">
            Copyright <i class="far fa-copyright"></i> <b>Batu Bulan</b>
          </div>        
        </div>
      </footer>
    </div>

 
 <script> 

  function logout(){
    $('#logoutModal').modal('show');
    setTimeout(function() {
        $('#logoutModal').modal('hide');
    }, 50000);      
  }
  
  


</script>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin Logout ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-footer">
          <button class="btn btn-info" type="button" data-dismiss="modal">Kembali</button>
          <a class="btn btn-danger" href="<?= base_url(); ?>auth/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

 
</body>
</html>




<script type="text/javascript">
  function show_password() {
    var input = document.getElementById("input_password");
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  } 

</script>