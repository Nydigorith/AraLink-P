<?php 
require 'php/php-controller.php'; 
$femail = $_SESSION['femail'];

if($femail == false){
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

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Loading -->
    <link rel="stylesheet" href="css/pace-theme-minimal.css">
    <style>
        html,
        body {
            background-color: rgb(31, 155, 95);
            color: rgb(46, 50, 51);
        }
    </style>
</head>

<body>
    <div class="account">
        <div class="container">
            <div class="row p-4 justify-content-center">
                <div class="form">
                    <form id="resend" action="reset-otp" method="post"> </form>
                    <form action="reset-otp" method="POST" onsubmit="hidebutton()">
                        <!-- <h2 class="text-center">Code Verification</h2> -->
                        <div class="text-center mb-3"><a href="index"><img src="img/src-logo.png" width="190px"
                                    height="50px"></a></div>
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
                        <div class="form-group">
                            <input class="form-control" type="text" name="otp" maxlength="6"
                                onchange="this.setAttribute('value', this.value);" value="" required>
                            <label>Verification Code</label>
                        </div>
                        <input class="form-control" type="hidden" name="email" value="<?php echo $femail ?>"
                            form="resend">
                        <input type="submit" class="btn reset-code text-center py-1 text-left link forget-pass"
                            name="resendd" value="Resend Code" form="resend">
                        <div class="form-group mb-3">
                            <button id="button-show" class="form-control button" type="submit" style="display:none;"
                                disabled><i class="fas fa-spinner fa-spin"></i> </button>
                            <input id="button-hide" class="form-control button" type="submit" name="check-reset-otp"
                                value="Continue">
                        </div>
                    </form>
                </div>
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

        /* Remove Confirm Form Resubmission  */
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>