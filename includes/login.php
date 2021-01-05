<?php
    $_SESSION["page"] = "login";
    // var_dump($_SESSION);
?>

<div class="back" style="z-index: -2; width: 100%; height: 100%; position:fixed; top:0; background-image: 
linear-gradient(12deg, #2f2626 0%, #f75d1b 46%, #ffffff 80%);;">
    <svg viewBox="0 0 400 500" preserveAspectRatio="xMinYMin meet">
    <path fill="#fff" fill-opacity="1" d="M0,100 C150,200 350,0 500,100 L500,00 L0,0 Z"></path>
  </svg>
</div>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    <?php 
                                        if(isset($_SESSION['data'])){
                                    ?>
                                        <div id="lgn-alert" class="alert alert-danger"><?php echo $_SESSION["data"] ?></div>
                                    <?php
                                            unset($_SESSION['data']);
                                        }
                                    ?>
                                </div>
                                <form class="user" method="POST" action="controller/login-controller.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            name="username" aria-describedby="emailHelp"
                                            placeholder="Enter Username...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    
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

    </div>

</div>
<script src="js/login.js"></script>