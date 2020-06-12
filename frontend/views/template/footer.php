<!-- Footer -->
<footer class="py-3 bg-dark fixed-bottom">
	<div class="container">
	  <p class="m-0 text-center text-white">Copyright &copy; Tugas Besar ProWeb. Aditya Ricki Julianto @ 056</p>
	</div>
<!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="<?= '../../vendor/jquery/jquery.min.js' ?>"></script>
<script src="<?= '../../vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<script>
	function showProfile(){
		let email = '<?= $email ?>';
		
		$.ajax({
			url: '../process/profile.php',
			method: 'GET',
			data: {
				email
			},
			success: result => {
				let dataMember = JSON.parse(result);
				$.each(dataMember, (i, obj) => {
					$('#buttonModalProfile').click();
				    $('#modalProfileLabel').html(`Show ${obj.member_name}`);
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
		                			<th>EMail</th>
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
		                	</tbody>
		                </table>
				    `);
				});
			},
			error: error => {
				console.log(error);
			}
		});
	}

	$(document).ready(function(){
		loadDataProduct();

		$('#aCartModal').click(function(e){
			let email       = '<?= $email ?>';

			$.ajax({
				url: '../process/cart.php',
				method: 'GET',
				data: {
					cart: 'get-data',
					email: email
				},
				success: result => {
					let dataCart = JSON.parse(result);

					$('#showCartModal').click();
					$('#tbody-modal-cart').empty();

					if (dataCart == '') {
						$('#tbody-modal-cart').append(
							`<tr>
                                <td colspan="6" class="text-center">Cart is empty!</td>
                            </tr>`
						);
					} else {
						$.each(dataCart, function(i, v){
							let price        = v.product_price.toString().split('').reverse().join(''), priceRibuan = price.match(/\d{1,3}/g);
							priceRibuan      = priceRibuan.join('.').split('').reverse().join('');
							
							let totalPrice   = v.product_price * v.cart_qty;
							let priceTotal   = totalPrice.toString().split('').reverse().join(''), priceRibuanTotal = priceTotal.match(/\d{1,3}/g);
							priceRibuanTotal = priceRibuanTotal.join('.').split('').reverse().join('');

							$('#tbody-modal-cart').append(
								`<tr data-amount="${v.product_price * v.cart_qty}" data-count_items="${v.cart_qty}" data-product_code="${v.product_code}" data-member_email="${email}" class="rowData">
									<td>${i + 1}</td>
									<td>${v.product_name}</td>
									<td>Rp. ${priceRibuan}</td>
									<td>${v.cart_qty}</td>
									<td>Rp. ${priceRibuanTotal}</td>
									<td><a data-id="${i}" class="btn btn-danger text-white deleteCart">Delete</a></td>
								</tr>`
							);
						});
					}

					$('.formCartAll').on('submit', function(e){
						e.preventDefault();
						$.each($('.rowData'), function(i, v){
							let indexCart = [];
							indexCart.push(i);
							console.log(indexCart);
							let amount       = $(v).data('amount');
							let count_items  = $(v).data('count_items');
							let product_code = $(v).data('product_code');
							let member_email = $(v).data('member_email');

							$.ajax({
								url: '../process/cart.php',
								method: 'POST',
								data: {
									cart: 'checkout',
									amount,
									count_items,
									product_code,
									member_email
								},
								success: result => {
									if (result == 'true') {
										Swal.fire({
										  	title: 'Berhasil!',
										  	text: 'The product was successfully ordered!',
										  	icon: 'success',
										  	confirmButtonText: 'Oke'
										});

										$('#tbody-modal-cart').empty();
										$('#tbody-modal-cart').append(
											`<tr>
				                                <td colspan="6" class="text-center">Cart is empty!</td>
				                            </tr>`
										);
									}
								},
								error: error => {
									console.log(error);
								}
							});
						});
					});

					$('.deleteCart').click(function(e){
						console.log($('#cart_member_email').val());
					});
				}
			});
		});

		$('#live-search').on('keyup', function(){
			let keyword = $(this).val();

			$.ajax({
				url: `../../backend/product/crudProduct.php`,
				type: `GET`,
				data: {
					search: 'live-search',
					keyword
				},
				success: function(result) {
					let dataProduct = JSON.parse(result);
					let email       = '<?= $email ?>';

					$.each($('.tampil-data'), function(i, e){
						e.remove();
					});

					if (dataProduct.length == 0) {
						$('#tampil-data').append(
							`<div class="col-md-12 tampil-data">
								<div class="alert alert-danger" role="alert">
	  								Product tidak ditemukan!
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
					              	<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
					              	<div class="card-body">
					                	<h4 class="card-title">
					                  		<a href="#">` + val.product_name + `</a>
					                	</h4>
					                	<h5>Rp. ` + ribuan + `</h5>
					                	<p class="card-text">` + val.product_desc + `</p>
					              	</div>
					              	<div class="row">
					              		<div class="col-md-6">
						              		<button class="btn btn-block btn-info text-white showDataProduct" data-id="${val.product_code}">Show</button>
					              		</div>
					              		<div class="col-md-6">
							              	<form class="formCart" data-id='${val.product_code}'>
							              		<input type="hidden" name="product_id" value="${val.product_code}" id="id-${val.product_code}"/>
							              		<input type="hidden" min="1" class="form-control" name="amount" required id="amount-${val.product_code}" value="1">
							              		<button class="btn btn-block btn-success text-white cartDataProduct" data-id="${val.product_code}">Cart</button>
							              	</form>
					              		</div>
					              	</div>
					            </div>
					        </div>`
						);
					});

					if (email == '') {
						$('.cartDataProduct').remove();
					}

					$('.formCart').on('submit', function(e){
						e.preventDefault();
						let dataId			  = $(this).data('id');
						let idCartProduct     = $(`#id-${dataId}`).val();
						let amountCartProduct = $(`#amount-${dataId}`).val();
						let email             = '<?= $email ?>';

						$.ajax({
							url: `../process/cart.php`,
							method: 'POST',
							data: {
								cart: 'add-cart',
								idCartProduct,
								amountCartProduct,
								email
							},
							success: function(result){
								if (result == 'true') {
									Swal.fire({
									  	title: 'Berhasil!',
									  	text: 'Product added to cart!',
									  	icon: 'success',
									  	confirmButtonText: 'Oke'
									});
								}
							},
							error: function(error){
								console.log(error);
							}
						});
					});

					// SHOW PRODUCT
					$('.showDataProduct').click(function(e){
						$.ajax({
							url: '../../backend/product/crudProduct.php',
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
								    $('#modalFrontend').click();
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
						                			<td>: ` + obj.category_name + ` </td>
						                		</tr>
						                	</tbody>
						                </table>
								    `);
								});
							}
						});
					});
				}
			});
		});
	});

	// LOAD DATA PRODUCT
	function loadDataProduct(){
		$.ajax({
			url: `../../backend/product/crudProduct.php`,
			type: `GET`,
			data: {
				req: 'product'
			},
			success: function(result) {
				let dataProduct = JSON.parse(result);
				let email       = '<?= $email ?>';

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
				              	<a href="#"><img style="width: 329px; height: 220px" class="card-img-top" src="../../uploads/products/product.png" alt=""></a>
				              	<div class="card-body">
				                	<h4 class="card-title">
				                  		<a href="#">` + val.product_name + `</a>
				                	</h4>
				                	<h5>Rp. ` + ribuan + `</h5>
				                	<p class="card-text">` + val.product_desc + `</p>
				              	</div>
				              	<div class="row">
				              		<div class="col-md-6">
					              		<button class="btn btn-block btn-info text-white showDataProduct" data-id="${val.product_code}">Show</button>
				              		</div>
				              		<div class="col-md-6">
						              	<form class="formCart" data-id='${val.product_code}'>
						              		<input type="hidden" name="product_id" value="${val.product_code}" id="id-${val.product_code}"/>
						              		<input type="hidden" min="1" class="form-control" name="amount" required id="amount-${val.product_code}" value="1">
						              		<button class="btn btn-block btn-success text-white cartDataProduct" data-id="${val.product_code}">Cart</button>
						              	</form>
				              		</div>
				              	</div>
				            </div>
				        </div>`
					);
				});

				if (email == '') {
					$('.cartDataProduct').remove();
				}

				$('.formCart').on('submit', function(e){
					e.preventDefault();
					let dataId			  = $(this).data('id');
					let idCartProduct     = $(`#id-${dataId}`).val();
					let amountCartProduct = $(`#amount-${dataId}`).val();
					let email             = '<?= $email ?>';

					$.ajax({
						url: `../process/cart.php`,
						method: 'POST',
						data: {
							cart: 'add-cart',
							idCartProduct,
							amountCartProduct,
							email
						},
						success: function(result){
							if (result == 'true') {
								Swal.fire({
								  	title: 'Berhasil!',
								  	text: 'Product added to cart!',
								  	icon: 'success',
								  	confirmButtonText: 'Oke'
								});
							}
						},
						error: function(error){
							console.log(error);
						}
					});
				});

				// SHOW PRODUCT
				$('.showDataProduct').click(function(e){
					$.ajax({
						url: '../../backend/product/crudProduct.php',
						method: 'GET',
						data: {
							edit: 'product',
							id: $(this).data('id')
						},
						success: function(result){
							let dataProduct = JSON.parse(result);

							$.each(dataProduct, function(i, v){
								let obj  = v;

								$('#modal-body').empty();
							    $('#modalFrontend').click();
							    $('#exampleModalLabel').html(`Show ${obj.product_name}`);
							    $('#modal-body').append(`
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
					                			<td>: ` + obj.category_name + ` </td>
					                		</tr>
					                	</tbody>
					                </table>
							    `);
							});
						}
					});
				});
			}
		});
	}

	$('#form-registrasi').on('submit', function(e){
		e.preventDefault();
		
		let name     = $('#registerName').val();
		let email    = $('#registerEmail').val();
		let phone    = $('#registerPhone').val();
		let password = $('#registerPassword').val();
		let identity = $('#registerIdentity').val();
		let gender   = $('#registerGender').val();
		let address  = $('#registerAddress').val();

		if (name.length == 0 || email.length == 0 || phone.length == 0 || password.length == 0 || identity.length == 0 || gender.length == 0 || address.length == 0) {
			Swal.fire({
			  	title: 'Gagal!',
			  	text: 'Semua field harus diisi!',
			  	icon: 'error',
			  	confirmButtonText: 'Oke'
			});
		}

		$.ajax({
			url: '../process/registrasi.php',
			method: 'POST',
			data: {
				registrasi: '1',
				name,
				email,
				phone,
				password,
				identity,
				gender,
				address
			},
			success: function(result){
				if (result == 'double'){
					Swal.fire({
					  	title: 'Gagal!',
					  	text: 'Email sudah terdaftar!',
					  	icon: 'error',
					  	confirmButtonText: 'Oke'
					});
				} else if (result == 'true') {
					$('#form-registrasi')[0].reset();
					$('#closeModalRegister').click();

					Swal.fire({
					  	title: 'Berhasil!',
					  	text: 'Selamat anda berhasil terdaftar, silahkan login!',
					  	icon: 'success',
					  	confirmButtonText: 'Oke'
					});
				} else {
					Swal.fire({
					  	title: 'Gagal!',
					  	text: 'Gagal melakukan registrasi!',
					  	icon: 'error',
					  	confirmButtonText: 'Oke'
					});
				}
			},
			error: function(error){
				console.log(error);
			}
		});
	});

	$('#form-login').on('submit', function(e){
		e.preventDefault();
		
		let email    = $('#loginEmail').val();
		let password = $('#loginPassword').val();

		$.ajax({
			url: '../process/login.php',
			method: 'POST',
			data: {
				login: '1',
				email,
				password
			},
			success: result => {
				if (result == 'member-login') {
					window.location.href = '../views/index.php';
				} else if (result == 'admin-login') {
					window.location.href = '../../backend/index.php';
				} else if (result == 'invalid-password') {
					Swal.fire({
					  	title: 'Error!',
					  	text: 'Password is invalid!',
					  	icon: 'error',
					  	confirmButtonText: 'Oke'
					});
				} else if (result == 'invalid-email') {
					Swal.fire({
					  	title: 'Error!',
					  	text: 'Email is invalid!',
					  	icon: 'error',
					  	confirmButtonText: 'Oke'
					});
				}
			},
			error: error => {
				console.log(error);
			}
		});
	});

	$('.nav-item').on('click', function(){
		let el = $('.nav-item');

		el.removeClass('active');
		$(this).addClass('active');
	});
</script>