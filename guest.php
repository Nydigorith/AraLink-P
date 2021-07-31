<?php 
require "db.php"; 
 $codihe = $_GET['c'];

    $query = $conn->prepare("SELECT * FROM classadmin WHERE classcode = :codihe");
    $query->execute([':codihe' => $codihe]);
    if($query){
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
       $scode = $fetch['classcode'];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Loading -->
    <link rel="stylesheet" href="css/pace-theme-minimal.css">
</head>
<style>
    html,
    body {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
    }
 

    /* Back To Top */
    .back-to-top {
        position: fixed;
        bottom: 25px;
        right: 25px;
        display: none;
        color: rgb(27, 27, 19);
        background-color: rgb(254, 221, 2);
        border: 1px solid rgb(254, 221, 2);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .back-to-top:hover {
        color: rgb(27, 27, 19)9;
        background-color: rgb(254, 221, 2);
        border: 1px solid rgb(27, 27, 19);
    }
</style>
</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light  sticky-top ">
        <a href="index" class="navbar-brand pl-5"><img src="img/nav-logo.png" width="30px" height="30px"></a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navigation_bar"
            aria-controls="navigation_bar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation_bar">
            <ul class="navbar-nav ml-auto">
                <div class="nav-item"> <a href="login" class="btn btn-light">Login</a></div>
                <div class="nav-item"> <a href="signup" class="btn btn-light">Signup</a></div>
            </ul>
        </div>
    </nav>




<div class="background-image  d-flex align-items-center">
    <div class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading"><?php  echo $fetch['classname']  ?></h1>
        </div>
    </div>
</div>




    <div class="videos">
        <div class="container video-selection">
            <div class="row">
                <div class="filter text-center p-4">
                    <form id="form1" method="POST">
                        <label class="filter-selection" value='ALL'>
                            <input class="radio-filter" onchange="this.form.submit();" type="radio" name="subject"
                                value="ALL">ALL</input>
                        </label>
                        <?php
                            $codihe = $_GET['c'];
                            $query = $conn->prepare("SELECT * FROM classsubject WHERE subjectcode = :codihe");
                            $result  =  $query->execute([':codihe' => $codihe]);
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
            <div class="row">
                <?php
                    if(isset($_POST['subject'])) {
                        $subject = $_POST["subject"];
                        $query = $conn->prepare("SELECT * FROM classvideo WHERE subjects = :subject AND linkcode = :codihe");
                        $result  =  $query->execute([':subject' => $subject, ':codihe' => $codihe]);
                         echo "<style>.filter-selection[value='$subject']{background-color: yellow;}.filter-selection[value=ALL]{background-color: white;}</style>";   
                        if($result){
                            if($query->rowCount() > 0){
                                while($row = $query->fetch(PDO::FETCH_BOTH)){                           
                ?>
                <div class="col-md-4">
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
                                $query = $conn->prepare("SELECT * FROM classvideo WHERE linkcode = :codihe");
                                $result  =  $query->execute([':codihe' => $codihe]);
                                echo "<style>.filter-selection[value='ALL']{background-color: yellow;}></style>"; 
                                if($result){
                                    if($query->rowCount() > 0){
                                        while($row = $query->fetch(PDO::FETCH_BOTH)){
                            ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <iframe class="card-img-top" src="<?php echo $row['links'];?>" allowfullscreen="true" frameBorder="0"></iframe>
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
                                            echo "No records matching your query were found.";
                                    } 
                                }
                            }
                        }
                    } else {
                        $query = $conn->prepare("SELECT * FROM classvideo WHERE linkcode = :codihe");
                        $result  =  $query->execute([':codihe' => $codihe]);
                        if($result){
                            if($query->rowCount() > 0){
                                while($row = $query->fetch(PDO::FETCH_BOTH)){
                                    ?>
                <div class="col-md-4">
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
                                    echo "No records matching your query were found.";
                        }
                    }
                }
                            ?>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <!-- Back To Top -->
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i
            class="bi bi-chevron-up"></i></a>

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