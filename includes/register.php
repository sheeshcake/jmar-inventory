<?php
    $_SESSION["page"] = "register";
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
                                    if(isset($_SESSION['message'])){
                                ?>
                                    <div id="reg-alert" class="alert alert-<?php echo $_SESSION['status']; ?>"><?php echo $_SESSION["message"] ?></div>
                                <?php
                                        unset($_SESSION['data']);
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
                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).on("click", "#b-lgn", function(){
        $.ajax({
            url : url(window.location.href) + "/controller/page-controller.php",
            method : "POST",
            data: {
                "page" : "login"
            },
            success: function(data){
                $(".main-content").fadeIn(500).html(data);
            },
            error : function(xhr, textStatus, errorThrown) {
                if (textStatus == 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        //try again
                        $.ajax(this);
                        return;
                    }
                    return;
                }
                if (xhr.status == 500) {
                    //handle error
                } else {
                    //handle error
                }
            }
        });
    });
    $(document).ready(function(){
        $("#b-reg").hide();
    });
    $(document).on("input", "#r-password", function(){
        if($("#password").val() == $("#r-password").val()){
            $("#b-reg").fadeIn(500);
            $("#b-reg").attr("type", "submit");
            $("#b-reg").attr("name", "submit");
        }
        else{
            $("#b-reg").fadeOut(500);
            $("#b-reg").removeAttr("type");
            $("#b-reg").removeAttr("name");
        }
    });
    $(document).ready(function(){
        setTimeout(function() {
            $("#reg-alert").fadeOut(300);
        }, (3000));
    });
</script>
