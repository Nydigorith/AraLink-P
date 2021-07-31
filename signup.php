<?php require_once "controllerUserData.php"; ?>
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

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/ls_style.css">

    <!-- Loading -->
    <link rel="stylesheet" href="css/pace-theme-minimal.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="  col-md-4 . offset-md-4  form">
                <form action="signup" method="POST" autocomplete="">
                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
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
                    }elseif(count($errors) > 1){
                        ?>
                        <style type="text/css">.alert-success{display:none;}</style>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Full Name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group input-group">
                        <input class="form-control" type="password" name="password" id ="password" placeholder="Password"  required>
                        <div class="input-group-append">
                            <span class="bi bi-eye-slash input-group-text" id="togglePassword"></span>
                        </div>
                    </div>

                    <label for="">Combnation of Letters and number 8-20 cahracter</label> 
                    <div class="form-group input-group">
                   
                        <input class="form-control" type="password" name="cpassword" id ="cpassword" placeholder="Confirm password"  required>
                        <div class="input-group-append">
                        <span class="bi bi-eye-slash input-group-text" id="togglecPassword"></span>
                </div>
                    </div>


                    



                    <div class="form-group">
                   
                        <input class="form-control" type="classname" name="classname" placeholder="classname" value="<?php echo $classname?>"required>
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
    <!-- Loading -->
    <script src="js/pace.js"></script>
    <script>

        
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
    </script>


</body>
</html>