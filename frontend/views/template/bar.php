<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">E-Commerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <?php if ($email == '') : ?>
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#registerModal" id="registerMdl">Register</a>
                    <?php else : ?>
                        <a class="nav-link" href="#" id="aCartModal">Cart</a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <?php if ($email == '') : ?>
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal" id="loginMdl">Login</a>
                    <?php else : ?>
                        <a class="nav-link" href="template/session.php?param=logout">Logout</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Button trigger modal -->
<button style="display: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal" id="closeModalRegister"></button>
<button style="display: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal" id="closeModalLogin"></button>
<button style="display: none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cartModal" id="showCartModal"></button>

<!-- Modal Registrasi -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <form id="form-registrasi" method="POST">
                        <div class="text-center">
                            <h3>Registrasi Member</h3>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="text" class="form-control" id="registerName" name="member_name" placeholder="Name">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="registerEmail" name="member_email" placeholder="E-Mail">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="registerPhone" name="member_phone" placeholder="Phone number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="registerPassword" name="member_password" placeholder="Password">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="registerIdentity" name="member_identity" placeholder="Identity number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="registerGender" name="member_gender">
                                    <option>--GENDER--</option>
                                    <option value="L" name="member_gender">Man</option>
                                    <option value="P" name="member_gender">Woman</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="registerAddress" name="member_address" rows="3" placeholder="Address"></textarea>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <form id="form-login" method="POST">
                        <div class="text-center">
                            <h3>Login</h3>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Top Up -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container" id="modal-body-cart">
                    <h4 class="mb-3">Cart</h4>
                    <form class="formCartAll">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Qty</th>
                                <th>Total Price</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody id="tbody-modal-cart">
                                    
                            </tbody>
                        </table>
                        <button class="btn btn-primary">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>