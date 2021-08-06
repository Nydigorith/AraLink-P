<?php require_once 'php/php-controller.php'; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login');
}

if($email != false){
    $query = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
    $result=$query->execute([':email' => $email]);
   if($result){
       $fetch = $query->fetch(PDO::FETCH_ASSOC);
        $fetch_status = $fetch['code'];
       
        if($fetch_status != "0"){
            
            header('Location: reset-otp');
        } 
    }
}

    
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Reset Password</title>
    <link rel="icon" href="img/logo.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

                <form action="login" method="POST" autocomplete="off" onsubmit="hidebutton()">
                    <!-- <h2 class="text-center">New Password</h2> -->
                    <div class="text-center"><a href="index"><img src="img/src-logo.png" width="190px" height="50px"></a></div>
                    <p class="text-center">Enter your new password</p>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                    <div class="alert alert-success text-center">
                        <?php echo $_SESSION['info']; ?>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                    <style type="text/css">
                        .alert-success {
                            display: none;
                        }
                    </style>
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
                     <label class="label-notes"for="">Combnation of Letters and number 8-20 cahracter</label>
                    <div class="form-group input-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password"
                            required>
                        <div class="input-group-append">
                            <span class="bi bi-eye-slash input-group-text" id="togglePassword"></span>
                        </div>
                    </div>

                    <div class="form-group input-group">

                        <input class="form-control" type="password" name="cpassword" id="cpassword"
                            placeholder="Confirm password" required>
                        <div class="input-group-append">
                            <span class="bi bi-eye-slash input-group-text" id="togglecPassword"></span>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                    <button id="button-show" class="form-control button" type="submit" style="display:none;" disabled><i class="fas fa-spinner fa-spin"></i> </button>
                        <input id="button-hide" class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
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

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.classList.toggle('bi-eye');
        });

        const togglecPassword = document.querySelector('#togglecPassword');
        const cpassword = document.querySelector('#cpassword');

        togglecPassword.addEventListener('click', function (e) {

            const type = cpassword.getAttribute('type') === 'password' ? 'text' : 'password';
            cpassword.setAttribute('type', type);

            this.classList.toggle('bi-eye');
        });
        /* Remove Confirm Form Resubmission  */
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>