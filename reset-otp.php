<?php require_once 'php/php-controller.php'; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
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
                <form action="reset-otp" method="POST" autocomplete="off" onsubmit="hidebutton()">
                    <!-- <h2 class="text-center">Code Verification</h2> -->
                    <div class="text-center"><a href="index"><img src="img/src-logo.png" width="190px" height="50px"></a></div>
                    <?php 
                    if(isset($_SESSION['info-rotp'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                            <?php echo $_SESSION['info-rotp']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <style type="text/css">.alert-success{display:none;}</style>
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
                        <input class="form-control" type="text" name="otp" placeholder="Enter code" maxlength="6" required>
                    </div>
                    <div class="form-group">
                        <button id="button-show" class="form-control button" type="submit" style="display:none;" disabled><i class="fas fa-spinner fa-spin"></i> </button>
                        <input id="button-hide" class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                    </div>
                </form>
                <form action="otp" method="post" enctype="multipart/form-data">   
               <!--  <input class="form-control"id="otp-check" type="hidden" name="otp-check" > -->
               
                <input class="form-control" type="hidden" name="email" value="<?php echo $email ?>">
                            <input type="submit" class="btn reset-code text-center p-0 text-left" name="resendd" value="Resend Code">
                       
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

        /* Remove Confirm Form Resubmission  */
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>