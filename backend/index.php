<?php include 'template/header.php'; ?>

<body>

  <?php include 'template/bar.php'; ?>

  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">AR-J</h1>
        <div class="list-group">
          <a href="#" class="list-group-item li-menu active" data-nama="kategori" data-load="category">Kategori Produk</a>
          <a href="#" class="list-group-item li-menu" data-nama="produk" data-load="product">Produk</a>
          <a href="#" class="list-group-item li-menu" data-nama="member" data-load="member">Member</a>
        </div>

      </div>

      <!-- Button trigger modal -->
      <button style="display: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="modalEdit"></button>

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
            <div class="modal-body">
              
            </div>
          </div>
        </div>
      </div>


      <div class="col-lg-9 my-5">
        
        <div class="row" id="row-button">
          <div class="col-lg-8 col-md-6 mb-2"></div>
          <div class="col-lg-4 col-md-6 mb-2 text-right">
            <button class="btn btn-success button-create">
              <a class="text-white" id="hrefKategori" data-nama="kategori">Tambah Kategori Produk</a>
            </button>
          </div>
        </div>

        <div class="row" id="tampil-data">

        </div>

      </div>

    </div>

  </div>

  <?php include 'template/footer.php'; ?>

</body>

</html>