<?php  require_once "verify-code.php";  



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                
                    <form method="GET" action="index.php">
                    <h2 class="text-center">Login Form</h2>
                    <p class="text-center">Login with your email and password.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="form-group">
                        <input id="codehe" class="form-control" type="codehe" name="codehe" placeholder="Class Code" onkeypress="return event.charCode != 32" maxlength="8" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="gsubmit" >  <!-- onclick="passvalues();" -->
                    </div>
</form>
                    

                    <br>
                    
                    <form action="login-user.php" method="POST" autocomplete="">

                    <div class="link login-link text-center">Login or Signup INstead</div>

                    <div class="form-group" action="login-user.php">
                    <input class="form-control button" type="submit" value="Login" />
                    </div>
                    </form>
                    <form action="signup-user.php" method="POST" autocomplete="">
                    <div class="form-group" action="signup-user.php">
                    <input class="form-control button" type="submit" value="SignUp" />
                    </div>
                    
                    </form>
            </div>
        </div>
    </div>
    

    <script>
    
    /* function passvalues () {
        var angcode=document.getElementById("codehe"). value;
        localStorage.setItem("textValue", angcode);
        return false;
    } */
    
    </script>
</body>
</html>