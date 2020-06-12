<?php include 'template/header.php'; ?>

<body>

  <!-- Navigation -->
  <?php include 'template/bar.php'; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">AR-J</h1>
        <?php if ($email != '') : ?>
        <div class="list-group">
          <a href="#" class="list-group-item" id="profil" onclick="showProfile()">Profil</a>
        </div>
        <?php endif; ?>
        <div class="input-group mb-3 mt-3">
          <input type="text" class="form-control" placeholder="Search..." name="live-search" id="live-search">
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <!-- Button trigger modal -->
      <button style="display: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="modalFrontend"></button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modalClose">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-body">
              
            </div>
          </div>
        </div>
      </div>

      <!-- Button trigger modal -->
      <button style="display: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProfile" id="buttonModalProfile"></button>

      <!-- Modal -->
      <div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="modalProfileLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalProfileLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modalProfileClose">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-profile-body">
              
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-9 my-5">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" style="width: 900px; height: 350px" src="../../uploads/banner/banner2.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" style="width: 900px; height: 350px" src="../../uploads/banner/banner1.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" style="width: 900px; height: 350px" src="../../uploads/banner/banner3.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row" id="tampil-data">

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <?php include 'template/footer.php'; ?>

</body>

</html>
