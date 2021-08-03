<?php 
require_once "controllerUserData.php";
require "db.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];

if($email != false && $password != false){
    $query = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
    $result=$query->execute([':email' => $email]);
   if($result){
       $fetch = $query->fetch(PDO::FETCH_ASSOC);
        $fetch_status = $fetch['status'];
        $fetch_code = $fetch['code'];
        $fetch_classcode = $fetch['classcode'];
        $_SESSION["classcode"] = $fetch_classcode;
        if($fetch_status == "verified"){
            if($fetch_code != 0){
                $info = "We've sent a passwrod reset otp to your email - $email";
                        $_SESSION['info'] = $info;
                header('Location: reset-otp');
            }
        }else{
            header('Location: otp');
        }
    }
}else{
    header('Location: login');
}

$background = 'data:image/png;base64,'.base64_encode($fetch['images']);
if (!empty($fetch['images'])) {
?>
<style>
    .jumbotron {
        background-image: url(<?php echo $background; ?>);
    }
</style>
<?php
} else {
?>
<style>
    .jumbotron {
        background-image: url(img/2k.png);
    }
</style>
<?php
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>AraLink: <?php echo $fetch['classname'] ?></title>
    <link rel="icon" href="img/logo.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Loading -->
    <link rel="stylesheet" href="css/pace-theme-minimal.css">

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;

        }


        .copied {
            display: none;
            position: fixed;
            left: 50%;
            top: 90%;
            transform: translate(-50%, -50%);
            z-index: 999;
            padding: 10px;
            padding-left: 25px;
            padding-right: 36px;
            margin-right: 1vw;
            cursor: pointer;
            border: #CFD9E0 solid 1px;
            border-radius: 50px;
            /* background-color: green; */

            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            -o-transition: all 0.5s;
        }

        .copy-code {
            margin-top: -15px;
        }



        @media (min-width: 581px) {
            .modal .modal-dialog {
                max-width: 350px !important;
            }
        }

        @media (max-width: 581px) and (min-width: 381px) {
            .modal {
                padding-left: 23vw;
                padding-right: 23vw;
            }
        }

        .videos .mb-4 {
            margin-top: 8px;
        }
    </style>
</head>

<body>






    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light sticky-top nav-index">
        <a href="index" class="navbar-brand pl-3"><img src="img/nav-logo.png" width="190px" height="50px"></a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navigation_bar"
            aria-controls="navigation_bar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse " id="navigation_bar">
            <ul class="navbar-nav ml-auto flex-sm-row pr-2">
                <div class="nav-item left col-sm-6 "> <a href="admin" class="btn btn-light">Admin</a></div>
                <div class="nav-item right col-sm-6"> <a href="logout" class="btn btn-light">Logout</a></div>
            </ul>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="background-image ">
        <div class="jumbotron d-flex align-items-center text-center">
            <div class="container">
                <h1 class="jumbotron-heading"><?php  echo $fetch['classname']?><a data-toggle="modal"
                        data-target="#copy_code_modal"><i class="fa fa-share" aria-hidden="true"></i></a></h1>
            </div>
        </div>
    </div>

    <!-- Videos -->
    <div class="videos">
        <div class="container video-selection text-center">
            <div class="text-center">
                <div class="filter p-4">
                    <form id="form1" method="POST">
                        <label class="filter-selection" value='ALL'>
                            <input class="radio-filter" onchange="this.form.submit();" type="radio" name="subject"
                                value="ALL">ALL</input>
                        </label>
                        <?php
                           
                            $query = $conn->prepare("SELECT * FROM classsubject WHERE subjectcode = :codihe");
                            $result  =  $query->execute([':codihe' => $fetch_classcode]);
                            echo "<style>.filter-selection[value='ALL']{background-color: yellow;}></style>"; 
                            if($result){
                                if($query->rowCount() > 0){
                                    while($row = $query->fetch(PDO::FETCH_BOTH)){
                        ?>
                        <label class="filter-selection" value='<?php echo $row['subjects'];?>'>
                            <input class="radio-filter" onchange="this.form.submit();" type="radio" name="subject"
                                value="<?php echo $row['subjects'];?>"
                                for=<?php echo $row['subjects'];?>><?php echo $row['subjects'];?> </input>
                        </label>
                        <?php
                                    }
                                } /* else {
                                        echo "Mr.Beast6000";
                                    } */
                            }
                                ?>
                        <input type="hidden" name="c" value="<?php echo $_GET['c']?>">
                    </form>
                </div>
            </div>
        </div>


        <div class="container video-show">
            <div class="row px-2">
                <?php
                    if(isset($_POST['subject'])) {
                        $subject = $_POST["subject"];
                        if ($subject == "ALL") {
                            $query = $conn->prepare("SELECT * FROM classvideo WHERE linkcode = :codihe");
                            $result  =  $query->execute([':codihe' => $fetch_classcode]);
                            echo "<style>.filter-selection[value='ALL']{background-color: yellow;}></style>"; 
                            if($result){
                                if($query->rowCount() > 0){
                                    while($row = $query->fetch(PDO::FETCH_BOTH)){
                        ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card mb-4 box-shadow ">
                        <iframe class="card-img-top" src="<?php echo $row['links'];?>" allowfullscreen="true"></iframe>
                        <div class="card-body">
                            <div class="card-subtitle text-muted"> <?php echo $row['subjects'];?></div>
                            <div class="card-title"> <?php echo $row['titles'];?></div>
                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                        </div>
                    </div>
                </div>
                <?php
                                    }  
                                } else {
                                    ?>
                <div class="error-text mx-auto">No video were found </div>';
                <?php
                                } 
                            }
                        } else {
                            $query = $conn->prepare("SELECT * FROM classvideo WHERE subjects = :subject AND linkcode = :codihe");
                            $result  =  $query->execute([':subject' => $subject, ':codihe' => $fetch_classcode]);
                             echo "<style>.filter-selection[value='$subject']{background-color: yellow;}.filter-selection[value=ALL]{background-color: white;}</style>";   
                            if($result){
                                if($query->rowCount() > 0){
                                    while($row = $query->fetch(PDO::FETCH_BOTH)){                           
                    ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card mb-4 box-shadow">
                        <iframe class="card-img-top" src="<?php echo $row['links'];?>" allowfullscreen="true"></iframe>
                        <div class="card-body">
                            <div class="card-subtitle text-muted"> <?php echo $row['subjects'];?></div>
                            <div class="card-title"> <?php echo $row['titles'];?></div>
                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                        </div>
                    </div>
                </div>
                <?php
                                     } 
                                } else {
                                    ?>
                <div class="error-text mx-auto">No video for <?php echo $subject;?> </div>';
                <?php
                                }
                            }
                        }
                    }
                     else {
                        $query = $conn->prepare("SELECT * FROM classvideo WHERE linkcode = :codihe");
                        $result  =  $query->execute([':codihe' => $fetch_classcode]);
                        if($result){
                            if($query->rowCount() > 0){
                                while($row = $query->fetch(PDO::FETCH_BOTH)){
                                    ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card mb-4 box-shadow">
                        <iframe class="card-img-top" src="<?php echo $row['links'];?>" allowfullscreen="true"></iframe>
                        <div class="card-body">
                            <div class="card-subtitle text-muted"> <?php echo $row['subjects'];?></div>
                            <div class="card-title"> <?php echo $row['titles'];?></div>
                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                        </div>
                    </div>
                </div>
                <?php
                                }  
                            }else {
                                ?>
                <div class="error-text mx-auto">No video were found </div>';
                <?php
                        }
                    }
                }
                            ?>
            </div>
        </div>
    </div>



    <!--   <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->

    <!-- Footer -->
    <footer class="page-footer">
        <div class="footer-text text-center py-3">
            <a href="https://github.com/Nydigorith/AraLink" target="_blank">Download Source Code</a>

        </div>
    </footer>
    <!-- Footer -->

    <!-- Back To Top -->
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i
            class="fa fa-chevron-up pt-2"></i></a>

    <!-- Copied Message -->
    <div class="copied btn btn-dark" id="copied">Copied to clipboard</div>

    <!-- Copy Modal -->
    <div class="modal fade" id="copy_code_modal" tabindex="-1" role="dialog" aria-labelledby="copy_code_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered px-3" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title mx-auto">Class Code</h5>
                </div>
                <div class="modal-body  text-center">
                    <h3 id="select_txt" class="class-code"><?php echo $fetch['classcode']  ?></h3>
                </div>

                <div class="modal-footer">

                    <input type="button" class="btn btn-secondary" id="copy-code" data-dismiss="modal" value="Copy"
                        onclick="copy_data(select_txt)">
                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>



    <!-- Loading -->
    <script src="js/pace.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script>
        /* Copy */
        $('#copy-code').click(function (e) {
            $('#copied').fadeIn(1000);
            $('#copied').delay(2000).fadeOut(1000);
        });

        function copy_data(containerid) {
            var range = document.createRange();
            range.selectNode(containerid);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
        }

        /* Back to Top */
        $(window).scroll(function () {
            if ($(this).scrollTop() > 750) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        $('#back-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });

        /* Remove Confirm Form Resubmission  */
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        /* Store Scroll Position */
        document.addEventListener("DOMContentLoaded", function (event) {
            var scrollpos = sessionStorage.getItem('scrollpos');
            if (scrollpos) {
                window.scrollTo(0, scrollpos);
                sessionStorage.removeItem('scrollpos');
            }
        });

        window.addEventListener("beforeunload", function (e) {
            sessionStorage.setItem('scrollpos', window.scrollY);
        });
    </script>

</body>

</html>