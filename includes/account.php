<?php
    $permissions = home_core("get_roles", $_SESSION["user"]["role"]);
    if(isset($_SESSION["account"])){
        foreach ($_SESSION["account"] as &$value) {
            if(isset($value["user_data"])){
                echo '<div class="new-alert alert alert-' . $value["user_data"]["status"] . ' m-1">';
                echo "User Data: " . $value["user_data"]["message"] . "</div>";
            }else if(isset($value["password"])){
                echo '<div class="new-alert alert alert-' . $value["password"]["status"] . ' m-1">';
                echo "Password: " . $value["password"]["message"] . "</div>";
            }else if(isset($value["image"])){
                echo '<div class="new-alert alert alert-' . $value["image"]["status"] . ' m-1">';
                echo "Image: " . $value["image"]["message"] . "</div>";
            }
        }
        unset($_SESSION["account"]);
    }
?>
<form enctype="multipart/form-data" action="" method="POST" id="account-form" class="mb-3">
    <div class="d-flex">
        <div class="w-25 h-25">
            <div class="card m-2">
                <div class="card-body text-center shadow">
                    <img class="rounded-circle mb-3 mt-4 " id="item-image-selected" src="img/<?php echo $_SESSION["user"]["user_img"]; ?>" width="160" height="160">
                    <h4><?php echo $_SESSION["user"]["f_name"] . " " . $_SESSION["user"]["l_name"]; ?> 
                    <input id="img" type="file" class="form-control-file btn" name="user_img">
                    <hr class="sidebar-divider">
                    <h5>Permissions</h5>
                    <div>
                    <?php
                        foreach ($permissions as &$value) {
                            echo "<span class='badge badge-info'>" . $value . "</span>";
                        }
                    ?>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <input class="btn btn-primary btn-sm w-100" type="submit" name="submit" value="Save Settings">
            </div>
        </div>
        <div class="card shadow m-2 w-75">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">User Settings</p>
            </div>
            <div class="card-body">
            <h5>User Details Settings</h5>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="username"><strong>User ID</strong></label>
                            <input class="form-control" type="text" value="<?php echo $_SESSION["user"]["user_id"]; ?>" name="user_id" readonly="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for=""><strong>User Role</strong></label>
                            <input class="form-control" type="text" value="<?php echo $_SESSION["user"]["role"]; ?>" name="role" readonly="">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="username"><strong>First Name</strong></label>
                            <input class="form-control" type="text" value="<?php echo $_SESSION["user"]["f_name"]; ?>" name="f_name">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for=""><strong>Last Name</strong></label>
                            <input class="form-control" type="text" value="<?php echo $_SESSION["user"]["l_name"]; ?>" name="l_name">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="username"><strong>Email</strong></label>
                            <input class="form-control" type="text" value="<?php echo $_SESSION["user"]["email"]; ?>" name="email">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email"><strong>Username</strong></label>
                            <input class="form-control" type="text" value="<?php echo $_SESSION["user"]["username"]; ?>" name="username">
                        </div>
                    </div>
                </div>
                <hr class="sidebar-divider">
                <h5>Password Settings</h5>
                <div class="alert alert-warning">
                        Changing Password, Please Enter The Last Password and Enter New One
                    </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="last_name"><strong>Last Password</strong></label>
                            <input class="form-control" type="Password" value="" name="last_password">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="last_name"><strong>New Password</strong></label>
                            <input class="form-control" type="Password" value="" name="new_password">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function(){
    $("form").attr("action" , url(window.location.href) + "/controller/account-controller.php");
    $(".new-alert").fadeTo(3000, 500).slideUp(500, function() {});
});
$('#img').change(function(){
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
        {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#item-image-selected').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    else
    {
        $('#item-image-selected').attr('src', '/img/item.jpg');
    }
});
</script>