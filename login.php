<?php require_once 'php/php-controller.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>
    <link rel="icon" href="img/logo.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/ls_style.css">

    <!-- Loading -->
    <link rel="stylesheet" href="css/pace-theme-minimal.css">
</head>
<body>



<div class="container">
<div class="row p-4 justify-content-center">
            <div class="form">
                
                <form action="login" method="POST" autocomplete=""onsubmit="hidebutton()">
                    <div class="text-center"><a href="index"><img src="img/src-logo.png" width="190px" height="50px"></a></div>
                    <?php 
                if(isset($_SESSION['info']) != "Your password changed. Now you can login with your new password."){
                    unset($_SESSION["info"]);
                }
             else {
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php 
         } unset($_SESSION["info"]); 
            ?>
                    <p class="text-center">Login with your email and password.</p>
                   
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group input-group">
                       
                       <input class="form-control" type="password" name="password" id="password" placeholder="Password" required> 
                       <div class="input-group-append">
                       <span class="bi bi-eye-slash input-group-text" id="togglePassword"></span>
                       </div>
                      
                       
                   </div>
                    <div class="link forget-pass text-left"><a href="forgot-password">Forgot password?</a></div>
                    <div class="form-group">
                    <button id="button-show" class="form-control button" type="submit" style="display:none;" disabled><i class="fas fa-spinner fa-spin"></i> </button>
                        <input id="button-hide" class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="signup">Signup now</a></div>
                </form>
            </div>
        </div>
    </div>
    <!-- Loading -->
    <script src="js/pace.js"></script>
    
    <script>

        function hidebutton (){
            document.getElementById("button-hide").style.display="none";
            document.getElementById("button-show").style.display="block";
        }

        
        const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bi-eye');
});

/* Remove Confirm Form Resubmission  */
if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>