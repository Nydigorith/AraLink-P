<?php require_once 'php/php-controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sign Up</title>
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
                <form action="signup" method="POST" onsubmit="hidebutton()">
                    <div class="text-center mb-3"><a href="index"><img src="img/src-logo.png" width="190px"
                                height="50px"></a></div>
                    <!--  <h2 class="text-center">Signup Form</h2> -->
                    <p class="text-center">Fill out the form to sign up.</p>
                    <?php
                    if(count($errors) == 1){
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
                        <input class="form-control" type="classname" name="classname"
                            onchange="this.setAttribute('value', this.value);" value="<?php echo $classname?>" required>
                        <label>Class</label>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name"
                            onchange="this.setAttribute('value', this.value);" value="<?php echo $name ?>" required >
                        <label>Username</label>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email"
                        onchange="this.setAttribute('value', this.value);"value="<?php echo $email ?>"  required >
                        <label>Email Address</label>
                    </div>
                    <div class="label-notes "> Only use gmail account</div>


                    <div class="form-group ">
                        
                        <input class="form-control" type="password" name="password" id="password"
                        onchange="this.setAttribute('value', this.value);" value="" required>
                        <label>Password</label>
                        <div class="input-group-append">
                            <span class="bi bi-eye-slash input-group-text" id="togglePassword"></span>
                        </div>
                        
                    </div>
                     <div class="label-notes">Combnation of Letters and number 8-20 cahracter</div>

                    <div class="form-group  ">
                        <input class="form-control" type="password" name="cpassword" id="cpassword"
                            onchange="this.setAttribute('value', this.value);" value="" required>
                        <label>Retype Password</label>
                        <div class="input-group-append">
                            <span class="bi bi-eye-slash input-group-text" id="togglecPassword"></span>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <button id="button-show" class="form-control button" type="submit" style="display:none;"
                            disabled><i class="fas fa-spinner fa-spin"></i> </button>
                        <input id="button-hide" class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Have an Account? <a href="login">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
    <!-- Loading -->
    <script src="js/pace.js"></script>
    <script>
        function hidebutton() {
            document.getElementById("button-hide").style.display = "none";
            document.getElementById("button-show").style.display = "block";
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