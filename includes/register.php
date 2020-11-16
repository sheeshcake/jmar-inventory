<?php
    $_SESSION["page"] = "register";
    // var_dump($_SESSION);
?>
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            <?php 
                                    if(isset($_SESSION["data"])){
                                ?>
                                    <div id="reg-alert" class="alert alert-<?php echo $_SESSION['data']['status']; ?>"><?php echo $_SESSION["data"]["message"] ?></div>
                                <?php
                                        unset($_SESSION["data"]);
                                    }
                            ?>
                        </div>
                        <form class="user" method="POST" action="controller/register-controller.php"> 
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="f_name" class="form-control form-control-user"
                                        placeholder="First Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="l_name" class="form-control form-control-user"
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user"
                                    placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-user"
                                    placeholder="Username">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="password" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" id="r-password" class="form-control form-control-user"
                                        placeholder="Repeat Password">
                                </div>
                            </div>
                            <button id="b-reg" name="submit" type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <hr>
                            <a class="btn btn-secondary btn-user btn-block" id="b-lgn">Login</a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <!-- <a class="small" href="forgot-password.html">Forgot Password?</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="js/register.js"></script>