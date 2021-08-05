<?php 
require "connection.php";
$email = "";
$name = "";
$errors = array();

 $codihe = $_GET['codehe'];




    $sql = "SELECT * FROM classadmin WHERE classcode = '$codihe'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $scode = $fetch_info['classcode'];
        
    }



?>

<!-- <p><a href="set_reg.php">Back to set_reg.php</a> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> | Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

   
    

</head>
<style>
    /* Scroll to Top */


}
</style>
<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        html,
body {
    width: 100%;
    height: 100%;
    margin: 0px;
    padding: 0px;
    font-family: 'Rubik', sans-serif;
    font-size: 18px;
    -webkit-overflow-scrolling: touch;
}

        nav {
            padding-left: 100px !important;
            padding-right: 100px !important;
            background: #6665ee;
            font-family: 'Poppins', sans-serif;
        }

        nav a.navbar-brand {
            color: #fff;
            font-size: 30px !important;
            font-weight: 500;
        }

        button a {
            color: #6665ee;
            font-weight: 500;
 
        }

        button a:hover {
            text-decoration: none;
        }

        /*     h1{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }   */



        #state {
             height: 44px; 
           /*   width:83vw; */
             border: none; 
            overflow: hidden;
         /*    text-align:center; */
         background-color:#F8F9FA;

            
        }

       /*  #state::-moz-focus-inner {
            border: 0;

        } */

        #state:focus {
            outline: none;
        }

        #state option {
            width: 60px;
            /* font-size: 1.2em; */
             padding: 10px 0px; 
             padding-left: 40px; 
             padding-right: 70px; 
            text-align: center;
            margin-right: 20px;
            /* display: inline-block; */
            display:inline;
            cursor: pointer;
            border: #CFD9E0 solid 1px;
            border-radius: 50px;
            /* color: rgb(204, 204, 0); */
            

        }

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


/* Footer */
.footer .copyright {
    text-align: center;
    padding-top: 10px;
    padding-bottom: 10px;
    color: white;
    font-size: 15px;
    background-color: rgb(27, 27, 19);
}
/* Nav-Separator */
@media (max-width:768px) {
    .nav-divider {
        height: 1px;
        margin: 9px 0;
        overflow: hidden;
        background-color: #e5e5e5;
    }
    .pl-5 img{
        margin-left: -50px;
    }
}

/* Navbar */
.navbar {
    box-shadow: 0px 8px 10px -8px rgba(0, 0, 0, .3);
    background-color: rgb(255, 255, 255);
}

.navbar .navbar-nav .nav-item .nav-link {
    color: rgb(140, 140, 138);
    transition: 0.5s;
}

.navbar .navbar-nav .nav-item .nav-link:hover {
    color: rgb(27, 27, 19);
}

.navbar .navbar-nav .nav-item .active {
    color: rgb(27, 27, 19);
}

.navbar .navbar-nav .nav-item .float-right {
    margin-right: -48px;
}

.navbar-light .navbar-toggler {
    background-image: url("data:image/svg+xml;..");
}

@media (min-width:768px) {
    .navbar .navbar-nav .nav-item .nav-link i {
        display: none;
    }
}

.card {
    border-radius: 3%;
}
.card-img-top {
    
    text-align:center;
    width: 100%;
    height: 10em; 
    object-fit: cover;
    margin-left: auto;
  margin-right: auto;
}
/* .btn-light {
   
    width:200px;
} */


    </style>
    </head>

    <body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light sticky-top">
        <a class="navbar-brand pl-5"><img src="img/logo.png" width="30px" height="30px"></a>
        <button class="navbar-toggler ml-auto " data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapse_target">
            <ul class="navbar-nav ml-auto pr-5">
               
     
   <!--   <div class="span2"> -->
           <div class="nav-item  px-3"> <button type="button" class="btn btn-light"><a href="login-user.php">Login</a></button></div>
           <div class="nav-item  px-3">    <button type="button" class="btn btn-light"><a href="signup-user.php">Signup</a></button></div>
          <!--  </div> -->
  
</button>
            </ul>
        </div>
    </nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <!--   <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
      <div id="select_txt" class="nav-item"><?php echo $fetch_info['classcode'] ?></div>
      <button type="button" class="close" data-dismiss="modal" onclick="copy_data(select_txt)">copy</button>
      </div>
<script>
function copy_data(containerid) {
  var range = document.createRange();
  range.selectNode(containerid); //changed here
  window.getSelection().removeAllRanges(); 
  window.getSelection().addRange(range); 
  document.execCommand("copy");
  window.getSelection().removeAllRanges();
  /* alert("data copied"); */
}
</script>

    <!--   <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>



        <div class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">           <div class="nav-item"><?php echo $fetch_info['classname'] ?> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"></div></h1>
               
                
            </div>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="text-menu p-4">
                        <form id="form1" method="POST">

                            <select  class="form-control" id="state" multiple name="state"
                                onchange="if(this.value != 0) { this.form.submit(); }">
                                <option value="ALL">ALL</option>
                                <?php
                            $codihe = $_GET['codehe'];
                                $sql = "SELECT * FROM classsubject WHERE subjectcode = '$codihe'";
                                if($result = mysqli_query($con, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                            ?>

                                <option value="<?php echo $row['subjects'];?>"><?php echo $row['subjects'];?></option>
                                <?php
                                        } mysqli_free_result($result);
                                    } else {
                                        echo "No records matching your query were found.";
                                    }
                                }
                            ?>
                            </select>

                            <input type="hidden" name="codehe" value="<?php echo $_GET['codehe']?>">
                        </form>
                    </div>
                </div>
            </div>
                       

                        <div class="container">
                            <div class="row">

                                <?php
                                if(isset($_POST['state'])) {
                                    ?>
                
                                <?php 
                                    
                                    $str = $_POST["state"];

                                    $sql = "SELECT * FROM classvideo WHERE subjects = '$str' AND linkcode = '$codihe'";
                                    if($result = mysqli_query($con, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                            ?>
                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">

                                        <iframe class="card-img-top" src="<?php echo $row['links'];?>"
                                            allowfullscreen="true"></iframe>
                                        <div class="card-body">
                                            <div class="card-title"> <?php echo $row['titles'];?></div>
                                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                            } mysqli_free_result($result); 
                                        } else 
                                        {
                                            $sql = "SELECT * FROM classvideo WHERE linkcode = '$codihe'";
                                            $result = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_array($result)){
                            ?>

                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">

                                        <iframe class="card-img-top" src="<?php echo $row['links'];?>"
                                            allowfullscreen="true"></iframe>
                                        <div class="card-body">
                                            <div class="card-title"> <?php echo $row['titles'];?></div>
                                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                            }  
                                        }
                                    }
                                } else {
                                
                                           
                                    $sql = "SELECT * FROM classvideo WHERE linkcode = '$codihe'";
                                    $result = mysqli_query($con, $sql);
                                    while($row = mysqli_fetch_array($result)){
                    ?>

                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">

                                        <iframe class="card-img-top" src="<?php echo $row['links'];?>"
                                            allowfullscreen="true"></iframe>
                                        <div class="card-body">
                                        <div class="card-title"> <?php echo $row['subjects'];?></div>
                                            <div class="card-title"> <?php echo $row['titles'];?></div>
                                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    }  
                                }
                            ?>
                            </div>
                        </div>
          
                        </div>
          

                      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
               <!--    
                    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
                    <script src="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-alpha.6.min.js"></script>
 -->
                   <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i
            class="fa fa-chevron-up"></i></a> 

                    <div class="footer">
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear());
            </script>
        </div>
    </div>



                    <script>
                    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
        
    </script>
    
    <script>
    /* Back to Top */
       $(document).ready(function () {
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
        }); 
    </script>
    </body>

</html>