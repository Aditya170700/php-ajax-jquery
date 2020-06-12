<!-- Footer -->
<footer class="py-3 bg-dark fixed-bottom">
	<div class="container">
	  <p class="m-0 text-center text-white">Copyright &copy; Tugas Besar ProWeb. Aditya Ricki Julianto @ 056</p>
	</div>
<!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="<?= '../vendor/jquery/jquery.min.js' ?>"></script>
<script src="<?= '../vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<script>
	// LOAD DATA CATEGORY
	function loadDataCategory(){
			$.ajax({
				url: `kategori/crudKategori.php`,
				type: `GET`,
				data: {
					req: 'category'
				},
				success: function(result) {
					let data = JSON.parse(result);

					$.each($('.tampil-data'), function(i, e){
						e.remove();
					});

					if (data.length == 0) {
						$('#tampil-data').append(
							`<div class="col-md-12 tampil-data">
								<div class="alert alert-danger" role="alert">
	  								Belum ada product!
								</div>
							</div>`
						);
					}
					
					$.each(data, function(i, val){
						$('#tampil-data').append(
							`<div class="col-lg-4 col-md-6 mb-4 tampil-data">
					            <div class="card h-100">
					              <a href="#"><img style="width: 329px; height: 220px" class="card-img-top" src="../uploads/products/product2.jpg" alt=""></a>
					              <div class="card-body">
					                <h4 class="card-title">
					                  <a href="#">` + val.category_name + `</a>
					                </h4>
					              </div>
			                  	  <div class="btn-group" role="group">
					              	  <button class="btn btn-warning btn-flat text-white editDataCategory" data-id="${val.category_id}" data-name="${val.category_name}">Edit</button>
						              <button class="btn btn-danger btn-flat text-white deleteDataCategory" data-id="${val.category_id}">Delete</button>
			                  	  </div>
					            </div>
					          </div>`
						);
					});

					// EDIT CATEGORY
					$(".editDataCategory").click(function(){
						$('.modal-body').empty();
					    $('#modalEdit').click();
					    $('#exampleModalLabel').html('Form Edit Category');
					    $('.modal-body').append(`
			                <form id="form-edit" data-edit="kategori" method="POST">
					    		<input type="hidden" class="form-control" id="category_id" name="category_id" value="` + $(this).data('id') + `">
			                  	<div class="form-group">
			                    	<input type="text" class="form-control" id="category_name" placeholder="Masukkan kategori" name="category_name" value="` + $(this).data('name') + `">
			                  	</div>
			                  	<button type="submit" id="btn-edit" class="btn btn-primary">Update</button>
			                </form>
					    `);
					    $('#form-edit').on('submit', function(e){
							e.preventDefault();
							// EDIT KATEGORI
							if ($(this).data('edit') == 'kategori') {
								if ($('#category_name').val() == '') {
									Swal.fire({
									  title: 'Error!',
									  text: 'Nama kategori tidak boleh kosong!',
									  icon: 'error',
									  confirmButtonText: 'Oke'
									})
								} else {
									$.ajax({
										url: `kategori/crudKategori.php`,
										method: `POST`,
										data: {
											edit: '1',
											category_id: $('#category_id').val(),
											category_name: $('#category_name').val()
										},
										success: function(success) {

											loadDataCategory();

											$('#form-edit')[0].reset();
					    					$('#modalClose').click();
											if (success == 'true') {
												Swal.fire({
												  title: 'Berhasil!',
												  text: 'Kategori berhasil diupdate!',
												  icon: 'success',
												  confirmButtonText: 'Oke'
												});
											} else {
												Swal.fire({
												  title: 'Gagal!',
												  text: 'Kategori gagal diupdate!',
												  icon: 'error',
												  confirmButtonText: 'Oke'
												});
											}
										},
										error: function(error) {
											Swal.fire({
											  title: 'Berhasil!',
											  text: 'Gagal mengupdate kategori!',
											  icon: 'success',
											  confirmButtonText: 'Oke'
											})
										}
									});
								}
							} 
						});
					});

					// DELETE CATEGORY
					$('.deleteDataCategory').click(function(){
						Swal.fire({
						  title: 'Yakin?',
						  text: "Beneran mau hapus data ini?",
						  icon: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Hapus?'
						}).then((result) => {
						  	if (result.value) {
								$.ajax({
									url: `kategori/crudKategori.php`,
									method: `GET`,
									data: {
										delete: '1',
										category_id: $(this).data('id')
									},
									success: function(success) {

										loadDataCategory();

										if (success == 'true') {
											Swal.fire({
											  title: 'Berhasil!',
											  text: 'Kategori berhasil dihapus!',
											  icon: 'success',
											  confirmButtonText: 'Oke'
											});
										} else {
											Swal.fire({
											  title: 'Gagal!',
											  text: 'Kategori gagal dihapus!',
											  icon: 'error',
											  confirmButtonText: 'Oke'
											});
										}
									},
									error: function(error) {
										Swal.fire({
										  title: 'Berhasil!',
										  text: 'Gagal menghapus kategori!',
										  icon: 'success',
										  confirmButtonText: 'Oke'
										})
									}
								});
						  	}
						});
					});
				},
				error: function(err) {
					console.log(err);
				}
			});
	}

	// LOAD DATA PRODUCT
	function loadDataProduct(){
			$.ajax({
				url: `product/crudProduct.php`,
				type: `GET`,
				data: {
					req: 'product'
				},
				success: function(result) {
					let dataProduct = JSON.parse(result);

					$.each($('.tampil-data'), function(i, e){
						e.remove();
					});

					if (dataProduct.length == 0) {
						$('#tampil-data').append(
							`<div class="col-md-12 tampil-data">
								<div class="alert alert-danger" role="alert">
	  								Belum ada product!
								</div>
							</div>`
						);
					}

					$.each(dataProduct, function(i, val){
						let reverse = val.product_price.toString().split('').reverse().join(''), ribuan = reverse.match(/\d{1,3}/g);
							ribuan	= ribuan.join('.').split('').reverse().join('');
						$('#tampil-data').append(
							`<div class="col-lg-4 col-md-6 mb-4 tampil-data">
					            <div class="card h-100">
					              	<a href="#"><img style="width: 329px; height: 220px" class="card-img-top" src="../uploads/products/product.png" alt=""></a>
					              	<div class="card-body">
					                	<h4 class="card-title">
					                  		<a href="#">` + val.product_name + `</a>
					                	</h4>
					                	<h5>Rp. ` + ribuan + `</h5>
					                	<p class="card-text">` + val.product_desc + `</p>
					              	</div>
					              	<div class="btn-group" role="group">
						              	<button class="btn btn-warning btn-flat text-white editDataProduct" data-id="${val.product_code}">Edit</button>
						              	<button class="btn btn-info btn-flat text-white showDataProduct" data-id="${val.product_code}">Show</button>
						              	<button class="btn btn-danger btn-flat text-white deleteDataProduct" data-id="${val.product_code}">Delete</button>
					              	</div>
					            </div>
					        </div>`
						);
					});

					// SHOW PRODUCT
					$('.showDataProduct').click(function(e){
						$.ajax({
							url: 'product/crudProduct.php',
							method: 'GET',
							data: {
								edit: 'product',
								id: $(this).data('id')
							},
							success: function(result){
								let dataProduct = JSON.parse(result);

								$.each(dataProduct, function(i, v){
									let obj  = v;

									$('.modal-body').empty();
								    $('#modalEdit').click();
								    $('#exampleModalLabel').html(`Show ${obj.product_name}`);
								    $('.modal-body').append(`
						                <table class="table table-striped table-hover">
						                	<tbody>
						                		<tr>
						                			<th>Code</th>
						                			<td>: ` + obj.product_code + `</td>
						                		</tr>
						                		<tr>
						                			<th>Name</th>
						                			<td>: ` + obj.product_name + `</td>
						                		</tr>
						                		<tr>
						                			<th>Price</th>
						                			<td>: ` + obj.product_price + `</td>
						                		</tr>
						                		<tr>
						                			<th>Desc.</th>
						                			<td>: ` + obj.product_desc + `</td>
						                		</tr>
						                		<tr>
						                			<th>Number</th>
						                			<td>: ` + obj.product_number + `</td>
						                		</tr>
						                		<tr>
						                			<th>Category</th>
						                			<td id="catName"></td>
						                		</tr>
						                	</tbody>
						                </table>
								    `);

									$.ajax({
										url: `kategori/crudKategori.php`,
										method: `GET`,
										data: {
											get_cat: `category`,
											category_id: obj.category_id
										},
										success: function(success){
											let dataFromCategory = JSON.parse(success);

											$.each(dataFromCategory, function(i, v){
												$('#catName').html(
													`: ${v.category_name}`
												);
											});
										},
										error: function(error){
											console.log(error);
										}
									});
								});
							}
						});
					});

					// EDIT PRODUCT
					$(".editDataProduct").click(function(e){
						$.ajax({
							url: 'product/crudProduct.php',
							method: 'GET',
							data: {
								edit: 'product',
								id: $(this).data('id')
							},
							success: function(result){
								let dataProduct = JSON.parse(result);

								$.each(dataProduct, function(i, v){
									let obj  = v;

									$('.modal-body').empty();
								    $('#modalEdit').click();
								    $('#exampleModalLabel').html('Form Edit Product');
								    $('.modal-body').append(`
						                <form id="form-edit" data-edit="product" method="POST">
								    		<input type="hidden" class="form-control" id="product_code" name="product_code" value="` + obj.product_code + `">
						                  	<div class="form-group">
						                    	<input type="text" class="form-control" id="product_name" name="product_name" value="` + obj.product_name + `">
						                  	</div>
							                <div class="form-group">
							                    <input type="text" class="form-control" id="product_price" name="product_price" value="` + obj.product_price + `">
							                </div>
							                <div class="form-group">
							                  <textarea class="form-control" id="product_desc" name="product_desc" rows="3">` + obj.product_desc + `</textarea>
							                </div>
							                <div class="form-group">
							                    <input type="text" class="form-control" id="product_number" name="product_number" value="` + obj.product_number + `">
							                </div>
							                <div class="form-group">
											    <select class="form-control" id="dataFromCat" name="category_id">
											      <option>--PILIH--</option>
											    </select>
							                </div>
							                <button type="submit" id="btn-edit" class="btn btn-primary">Simpan</button>
							            </form>
								    `);

									$.ajax({
										url: `kategori/crudKategori.php`,
										method: `GET`,
										data: {
											get_data: `category`
										},
										success: function(success){
											let dataFromCategory = JSON.parse(success);

											$.each(dataFromCategory, function(i, v){
												$('#dataFromCat').append(
													`<option class="pilihCat" name="category_id" value="${v.category_id}">${v.category_name}</option>`
												);
											});
											console.log(dataFromCategory);
										},
										error: function(error){
											console.log(error);
										}
									});
	
								    $('#form-edit').on('submit', function(e){
										e.preventDefault();
										// EDIT PRODUCT
										if ($(this).data('edit') == 'product') {
											$.ajax({
												url: `product/crudProduct.php`,
												method: `POST`,
												data: {
													edit: 'product',
													product_code: $('#product_code').val(),
													product_name: $('#product_name').val(),
													product_price: $('#product_price').val(),
													product_desc: $('#product_desc').val(),
													product_number: $('#product_number').val(),
													category_id: $('#dataFromCat').val()
												},
												success: function(success) {
													console.log(success);

													loadDataProduct();

													$('#form-edit')[0].reset();
							    					$('#modalClose').click();
													if (success) {
														Swal.fire({
														  title: 'Berhasil!',
														  text: 'Product berhasil diupdate!',
														  icon: 'success',
														  confirmButtonText: 'Oke'
														});
													}
												},
												error: function(error) {
													Swal.fire({
													  title: 'Berhasil!',
													  text: 'Gagal mengupdate product!',
													  icon: 'success',
													  confirmButtonText: 'Oke'
													})
												}
											});
										} 
									});
								});
							}
						});
					});

					// DELETE PRODUCT
					$('.deleteDataProduct').click(function(){
						Swal.fire({
						  title: 'Yakin?',
						  text: "Beneran mau hapus data ini?",
						  icon: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Hapus?'
						}).then((result) => {
						  	if (result.value) {
								$.ajax({
									url: `product/crudProduct.php`,
									method: `GET`,
									data: {
										delete: 'product',
										product_code: $(this).data('id')
									},
									success: function(success) {

										loadDataProduct();

										if (success == 'true') {
											Swal.fire({
											  title: 'Berhasil!',
											  text: 'Product berhasil dihapus!',
											  icon: 'success',
											  confirmButtonText: 'Oke'
											});
										} else {
											Swal.fire({
											  title: 'Gagal!',
											  text: 'Product gagal dihapus!',
											  icon: 'error',
											  confirmButtonText: 'Oke'
											});
										}
									},
									error: function(error) {
										Swal.fire({
										  title: 'Berhasil!',
										  text: 'Gagal menghapus product!',
										  icon: 'error',
										  confirmButtonText: 'Oke'
										})
									}
								});
						  	}
						});
					});
				},
				error: function(err) {
					console.log(err);
				}
			});
	}

	// LOAD DATA MEMBER
	function loadDataMember(){
			$.ajax({
				url: `member/crudMember.php`,
				type: `GET`,
				data: {
					req: 'member'
				},
				success: function(result) {
					let dataMember = JSON.parse(result);

					$.each($('.tampil-data'), function(i, e){
						e.remove();
					});

					if (dataMember.length == 0) {
						$('#tampil-data').append(
							`<div class="col-md-12 tampil-data">
								<div class="alert alert-danger" role="alert">
	  								Belum ada product!
								</div>
							</div>`
							);
					}

					$.each(dataMember, function(i, val){
						$('#tampil-data').append(
							`<div class="col-lg-4 col-md-6 mb-4 tampil-data">
					            <div class="card h-100">
					              <a href="#"><img style="width: 329px; height: 220px" class="card-img-top" src="../uploads/member/no-image.png" alt=""></a>
					              <div class="card-body">
					                <h4 class="card-title">
					                  <a href="#">` + val.member_name + `</a>
					                </h4>
					                <h5>` + val.member_email + `</h5>
					                <b><small>Telp. ` + val.member_phone + `</small></b>
					                <p class="card-text">`+ val.member_address +`</p>
					              </div>
					              <div class="btn-group" role="group">
					              <button class="btn btn-warning btn-flat text-white editDataMember" data-id="${val.member_id}">Edit</button>
					              <button class="btn btn-info btn-flat text-white showDataMember" data-id="${val.member_id}">Show</button>
					              <button class="btn btn-danger btn-flat text-white deleteDataMember" data-id="${val.member_id}">Delete</button>
					              </div>
					            </div>
					        </div>`
						);
					});

					// SHOW MEMBER
					$('.showDataMember').click(function(e){
						$.ajax({
							url: 'member/crudMember.php',
							method: 'GET',
							data: {
								show: 'member',
								id: $(this).data('id')
							},
							success: function(result){
								let dataMember = JSON.parse(result);

								$.each(dataMember, function(i, v){
									let obj  = v;
										let reverse = obj.member_saldo.toString().split('').reverse().join(''), ribuan = reverse.match(/\d{1,3}/g);
										ribuan	= ribuan.join('.').split('').reverse().join('');

									$('.modal-body').empty();
								    $('#modalEdit').click();
								    $('#exampleModalLabel').html(`Show ${obj.member_name}`);
								    $('.modal-body').append(`
						                <table class="table table-striped table-hover">
						                	<tbody>
						                		<tr>
						                			<th>Name</th>
						                			<td>: ` + obj.member_name + `</td>
						                		</tr>
						                		<tr>
						                			<th>Address</th>
						                			<td>: ` + obj.member_address + `</td>
						                		</tr>
						                		<tr>
						                			<th>Phone</th>
						                			<td>: ` + obj.member_phone + `</td>
						                		</tr>
						                		<tr>
						                			<th>E-Mail</th>
						                			<td>: ` + obj.member_email + `</td>
						                		</tr>
						                		<tr>
						                			<th>Identity</th>
						                			<td>: ` + obj.member_identity + `</td>
						                		</tr>
						                		<tr>
						                			<th>Gender</th>
						                			<td>: ` + obj.member_gender + `</td>
						                		</tr>
						                		<tr>
						                			<th>Saldo</th>
						                			<td>: Rp. ` + ribuan + `</td>
						                		</tr>
						                		<tr>
						                			<th>Status</th>
						                			<td>: ` + obj.member_status + `</td>
						                		</tr>
						                	</tbody>
						                </table>
								    `);
								});
							}
						});
					});

					// EDIT MEMBER
					$(".editDataMember").click(function(e){
						$.ajax({
							url: 'member/crudMember.php',
							method: 'GET',
							data: {
								edit: 'member',
								id: $(this).data('id')
							},
							success: function(result){
								let dataMember = JSON.parse(result);

								$.each(dataMember, function(i, v){
									let obj  = v;

									$('.modal-body').empty();
								    $('#modalEdit').click();
								    $('#exampleModalLabel').html('Form Edit Product');
								    $('.modal-body').append(`
						                <form id="form-edit" data-edit="member" method="POST">
						                	  	<input type="hidden" name="member_id" id="m_id" value="` + obj.member_id + `"/>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="m_name" name="member_name" value="` + obj.member_name + `">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="m_address" name="member_address" value="` + obj.member_address + `">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="m_phone" name="member_phone" value="` + obj.member_phone + `">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="m_email" name="member_email" value="` + obj.member_email + `">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="m_password" name="member_password" placeholder="Edit password">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="m_identity" name="member_identity" value="` + obj.member_identity + `">
							                  </div>
							                  <div class="form-group">
												<select class="form-control" id="m_gender" name="member_gender">
												  <option>--PILIH--</option>
												  <option value="L">Laki-laki</option>
												  <option value="P">Perempuan</option>
												</select>
											   </div>
							                  <div class="form-group">
							                    <input type="number" class="form-control" id="m_saldo" name="member_saldo" value="` + obj.member_saldo + `">
							                  </div>
							                  <div class="form-group">
												<select class="form-control" id="m_status" name="member_status">
												  <option>--PILIH--</option>
												  <option value="0">0</option>
												  <option value="1">1</option>
												  <option value="2">2</option>
												</select>
											   </div>
							                  <button type="submit" id="btn-create" class="btn btn-primary">Update</button>
							                </form>
								    `);
	
								    $('#form-edit').on('submit', function(e){
										e.preventDefault();
										// EDIT MEMBER
										if ($(this).data('edit') == 'member') {
											$.ajax({
												url: `member/crudMember.php`,
												method: `POST`,
												data: {
													edit: 'member',
													member_id: $('#m_id').val(),
													member_name: $('#m_name').val(),
													member_address: $('#m_address').val(),
													member_phone: $('#m_phone').val(),
													member_email: $('#m_email').val(),
													member_password: $('#m_password').val(),
													member_identity: $('#m_identity').val(),
													member_gender: $('#m_gender').val(),
													member_saldo: $('#m_saldo').val(),
													member_status: $('#m_status').val()
												},
												success: function(success) {
													console.log(success);

													loadDataMember();

													$('#form-edit')[0].reset();
							    					$('#modalClose').click();
													if (success) {
														Swal.fire({
														  title: 'Berhasil!',
														  text: 'Product berhasil diupdate!',
														  icon: 'success',
														  confirmButtonText: 'Oke'
														});
													}
												},
												error: function(error) {
													Swal.fire({
													  title: 'Berhasil!',
													  text: 'Gagal mengupdate product!',
													  icon: 'success',
													  confirmButtonText: 'Oke'
													})
												}
											});
										} 
									});
								});
							}
						});
					});

					// DELETE PRODUCT
					$('.deleteDataMember').click(function(){
						Swal.fire({
						  title: 'Yakin?',
						  text: "Beneran mau hapus data ini?",
						  icon: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Hapus?'
						}).then((result) => {
						  	if (result.value) {
								$.ajax({
									url: `member/crudMember.php`,
									method: `GET`,
									data: {
										delete: 'member',
										member_id: $(this).data('id')
									},
									success: function(success) {

										loadDataMember();

										if (success == 'true') {
											Swal.fire({
											  title: 'Berhasil!',
											  text: 'Member berhasil dihapus!',
											  icon: 'success',
											  confirmButtonText: 'Oke'
											});
										} else {
											Swal.fire({
											  title: 'Gagal!',
											  text: 'Member gagal dihapus!',
											  icon: 'error',
											  confirmButtonText: 'Oke'
											});
										}
									},
									error: function(error) {
										Swal.fire({
										  title: 'Berhasil!',
										  text: 'Gagal menghapus member!',
										  icon: 'error',
										  confirmButtonText: 'Oke'
										})
									}
								});
						  	}
						});
					});
				},
				error: function(err) {
					console.log(err);
				}
			});
	}

	// DOCUMENT READY FUNCTION
	$(document).ready(function(){
		loadDataCategory();

		$('.button-create').data( "create", { first: 'kategori', second: 'produk', last: 'member' });

		// LI SIDEBAR / MENU
		$('.li-menu').on('click', function(){
			$('#form-hidden').remove();

			let elLi      = $('.li-menu');
			let btnCreate = $('.button-create');

			elLi.removeClass('active');
			$(this).addClass('active');

			if ($(this).data('nama') == 'kategori') {
				loadDataCategory();
				btnCreate.html(`<a class="text-white" id="hrefKategori" data-nama="kategori">Tambah Kategori Produk</a>`);
			} else if ($(this).data('nama') == 'produk') {
				loadDataProduct();
				btnCreate.html(`<a class="text-white" id="hrefProduk" data-nama="produk">Tambah Produk</a>`);
			} else if ($(this).data('nama') == 'member') {
				loadDataMember();
				btnCreate.html(`<a class="text-white" id="hrefMember" data-nama="member">Tambah Member</a>`);
			}
		});

		// BUTTON CREATE
		$('.button-create').on('click', function(){
			let btnCreate       = $('.button-create');
			let addFormKategori = ` <div class="row mt-5" id="form-hidden">
							          <div class="col-lg-12 col-md-6 mb-2">
							            <div class="card">
							              <div class="card-header">
							                <span id="judul-form">Form Tambah Kategori</span>
							              </div>
							              <div class="card-body">
							                <form id="form-create" data-create="kategori" method="POST">
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="category_name" placeholder="Masukkan kategori" name="category_name">
							                  </div>
							                  <button type="submit" id="btn-create" class="btn btn-primary">Simpan</button>
							                  <button id="btn-close" class="btn btn-outline-secondary">Batal</button>
							                </form>
							              </div>
							            </div>
							          </div>
							        </div>`;
			let addFormProduk   = ` <div class="row mt-5" id="form-hidden">
							          <div class="col-lg-12 col-md-6 mb-2">
							            <div class="card">
							              <div class="card-header">
							                <span id="judul-form">Form Tambah Produk</span>
							              </div>
							              <div class="card-body">
							                <form id="form-create" data-create="produk" method="POST">
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="prod_code" placeholder="Masukkan kode produk" name="product_code">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="prod_name" placeholder="Masukkan nama produk" name="product_name">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="prod_price" placeholder="Masukkan harga produk" name="product_price">
							                  </div>
							                  <div class="form-group">
							                  <textarea class="form-control" id="prod_desc" name="product_desc" rows="3" placeholder="Masukkan deskripsi"></textarea>
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="prod_number" placeholder="Masukkan nomor produk" name="product_number">
							                  </div>
							                  <div class="form-group">
											    <select class="form-control" id="dataFromCate" name="category_id">
											      <option>--PILIH--</option>
											    </select>
							                  </div>
							                  <button type="submit" id="btn-create" class="btn btn-primary">Simpan</button>
							                  <button id="btn-close" class="btn btn-outline-secondary">Batal</button>
							                </form>
							              </div>
							            </div>
							          </div>
							        </div>`;
			let addFormMember   = ` <div class="row mt-5" id="form-hidden">
							          <div class="col-lg-12 col-md-6 mb-2">
							            <div class="card">
							              <div class="card-header">
							                <span id="judul-form">Form Tambah Member</span>
							              </div>
							              <div class="card-body">
							                <form id="form-create" data-create="member" method="POST">
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="member_name" placeholder="Masukkan nama" name="member_name">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="member_address" placeholder="Masukkan alamat" name="member_address">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="member_phone" placeholder="Masukkan telepon" name="member_phone">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="member_email" placeholder="Masukkan email" name="member_email">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="member_password" placeholder="Masukkan password" name="member_password">
							                  </div>
							                  <div class="form-group">
							                    <input type="text" class="form-control" id="member_identity" placeholder="Masukkan NIK" name="member_identity">
							                  </div>
							                  <div class="form-group">
												<select class="form-control" id="member_gender" name="member_gender">
												  <option>--PILIH--</option>
												  <option value="L">Laki-laki</option>
												  <option value="P">Perempuan</option>
												</select>
											   </div>
							                  <div class="form-group">
							                    <input type="number" class="form-control" id="member_saldo" placeholder="Masukkan jumlah saldo" name="member_saldo">
							                  </div>
							                  <div class="form-group">
												<select class="form-control" id="member_status" name="member_status">
												  <option>--PILIH--</option>
												  <option value="0">0</option>
												  <option value="1">1</option>
												  <option value="2">2</option>
												</select>
											   </div>
							                  <button type="submit" id="btn-create" class="btn btn-primary">Simpan</button>
							                  <button id="btn-close" class="btn btn-outline-secondary">Batal</button>
							                </form>
							              </div>
							            </div>
							          </div>
							        </div>`;

			$('#form-hidden').remove();

			if ($(this).children().data('nama') == 'kategori') {
				$('#row-button').before(addFormKategori);
			} else if ($(this).children().data('nama') == 'produk') {
				$('#row-button').before(addFormProduk);

				// request category from product form
				$.ajax({
					url: `kategori/crudKategori.php`,
					method: `GET`,
					data: {
						get_data: `category`
					},
					success: function(success){
						let dataFromCategory = JSON.parse(success);

						$.each(dataFromCategory, function(i, v){
							$('#dataFromCate').append(
								`<option class="pilihCat" name="category_id" value="${v.category_id}">${v.category_name}</option>`
							);
						});
						console.log(dataFromCategory);
					},
					error: function(error){
						console.log(error);
					}
				});
			} else if ($(this).children().data('nama') == 'member') {
				$('#row-button').before(addFormMember);
			}

			$('#btn-close').on('click', function(){
				$('#form-hidden').remove();
			});

			$('#form-create').on('submit', function(e){
				e.preventDefault();
				// CREATE CATEGORY
				if ($(this).data('create') == 'kategori') {
					if ($('#category_name').val() == '') {
						Swal.fire({
						  title: 'Error!',
						  text: 'Nama kategori tidak boleh kosong!',
						  icon: 'error',
						  confirmButtonText: 'Oke'
						})
					} else {
						$.ajax({
							url: `kategori/crudKategori.php`,
							method: `POST`,
							data: {
								create: '1',
								category_name: $('#category_name').val()
							},
							success: function(success) {

								loadDataCategory();

								$('#form-create')[0].reset();
								if (success == 'true') {
									Swal.fire({
									  title: 'Berhasil!',
									  text: 'Kategori berhasil ditambahkan!',
									  icon: 'success',
									  confirmButtonText: 'Oke'
									});
								} else {
									Swal.fire({
									  title: 'Gagal!',
									  text: 'Kategori gagal ditambahkan!',
									  icon: 'error',
									  confirmButtonText: 'Oke'
									});
								}
							},
							error: function(error) {
								Swal.fire({
								  title: 'Berhasil!',
								  text: 'Gagal menamabahkan kategori!',
								  icon: 'success',
								  confirmButtonText: 'Oke'
								})
							}
						});
					}
				// CREATE PRODUCT
				} else if ($(this).data('create') == 'produk') {
					if ($('#product_code').val() == '' || $('#product_name').val() == '' || $('#product_price').val() == '' || $('#product_desc').val() == '' || $('#product_number').val() == '' || $('#category_id').val() == '') {
						Swal.fire({
						  title: 'Error!',
						  text: 'Semua kolom harus diisi!',
						  icon: 'error',
						  confirmButtonText: 'Oke'
						})
					} else {
						$.ajax({
							url: `product/crudProduct.php`,
							method: `POST`,
							data: {
								product_code: $('#prod_code').val(),
								product_name: $('#prod_name').val(),
								product_price: $('#prod_price').val(),
								product_desc: $('#prod_desc').val(),
								product_number: $('#prod_number').val(),
								category_id: $('#dataFromCate').val()
							},
							success: function(success) {

								loadDataProduct();

								$('#form-create')[0].reset();
								if (success == 'true') {
									Swal.fire({
									  title: 'Berhasil!',
									  text: 'Product berhasil ditambahkan!',
									  icon: 'success',
									  confirmButtonText: 'Oke'
									});
								} else {
									Swal.fire({
									  title: 'Gagal!',
									  text: 'Product gagal ditambahkan!',
									  icon: 'error',
									  confirmButtonText: 'Oke'
									});
								}
							},
							error: function(error) {
								Swal.fire({
								  title: 'Berhasil!',
								  text: 'Gagal menamabahkan product!',
								  icon: 'success',
								  confirmButtonText: 'Oke'
								})
							}
						});
					}
				} else if ($(this).data('create') == 'member') {
					if ($('#member_name').val() == '' || $('#member_address').val() == '' || $('#member_phone').val() == '' || $('#member_email').val() == '' || $('#member_password').val() == '' || $('#member_identity').val() == '' || $('#member_gender').val() == '' || $('#member_saldo').val() == '' || $('#member_status').val() == '') {
						Swal.fire({
						  title: 'Error!',
						  text: 'Semua kolom harus diisi!',
						  icon: 'error',
						  confirmButtonText: 'Oke'
						})
					} else {
						$.ajax({
							url: `member/crudMember.php`,
							method: `POST`,
							data: {
								create: 'member',
								member_name: $('#member_name').val(),
								member_address: $('#member_address').val(),
								member_phone: $('#member_phone').val(),
								member_email: $('#member_email').val(),
								member_password: $('#member_password').val(),
								member_identity: $('#member_identity').val(),
								member_gender: $('#member_gender').val(),
								member_saldo: $('#member_saldo').val(),
								member_status: $('#member_status').val()
							},
							success: function(success) {

								loadDataMember();

								$('#form-create')[0].reset();
								if (success == 'true') {
									Swal.fire({
									  title: 'Berhasil!',
									  text: 'Product berhasil ditambahkan!',
									  icon: 'success',
									  confirmButtonText: 'Oke'
									});
								} else {
									Swal.fire({
									  title: 'Gagal!',
									  text: 'Product gagal ditambahkan!',
									  icon: 'error',
									  confirmButtonText: 'Oke'
									});
								}
							},
							error: function(error) {
								Swal.fire({
								  title: 'Berhasil!',
								  text: 'Gagal menamabahkan product!',
								  icon: 'success',
								  confirmButtonText: 'Oke'
								})
							}
						});
					}
				}
			});
		});

		$('.nav-menu').on('click', function(){
			let el = $('.nav-menu');

			el.removeClass('active');
			$(this).addClass('active');
		});
	});
</script>