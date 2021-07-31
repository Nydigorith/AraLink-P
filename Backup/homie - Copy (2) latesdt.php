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

    <script src="js/pace.js"></script>
    <link rel="stylesheet" href="css/pace-theme-minimal.css">
    

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




        /* #state {
             height: 44px; 
           
             border: none; 
            overflow: hidden;
      
         background-color:#F8F9FA;

            
        }
 */
       /*  #state::-moz-focus-inner {
            border: 0;

        } */

        /* #state:focus {
            outline: none;
        } */

     .filter-tab {
       /*  width: 710vw; */
     }
  
        .filter-des  {
            
           
            -moz-transition: all .2s ease-in;
    -o-transition: all .2s ease-in;
    -webkit-transition: all .2s ease-in;
    transition: all .2s ease-in;
            padding: 10px; 
             padding-left: 25px; 
             padding-right: 36px; 
          
            margin-right: 1vw;
            cursor: pointer;
            border: #CFD9E0 solid 1px;
            border-radius: 50px;
            
            

        }

        .filter-des:hover {
            background-color: yellow;
        }
        
        .radio-filter {
    opacity: 0;
    margin:0;
}

.card .card-title, .card-subtitle{
    margin:0; 
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


@media (max-width: 768px) {
   .nav-item .btn{
    margin: 0px;
       padding: 0px;
       width:100%;
   }
   .navbar {
   /*     margin: -70px;
       padding: -70px; */
   }
}

.copied {
    display:none;
    position:fixed;
    left: 50%;
top: 90%;
transform: translate(-50%,-50%);
z-index:999;
padding: 10px; 
             padding-left: 25px; 
             padding-right: 36px; 
          
            margin-right: 1vw;
            cursor: pointer;
            border: #CFD9E0 solid 1px;
            border-radius: 50px;
            background-color:green;
            /* visibility: hidden; */

            -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
  -o-transition: all 0.5s;
    
}


/* .btn-light {
   
    width:200px;
} */

/* [target=ALL] */

/* .filter-des[value=ALL]{
            background-color: yellow;
           
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
            <ul class="navbar-nav ml-auto  ">
               
     
    

           <div class="nav-item  "> <button type="button" class="btn btn-light"><a href="login-user.php">Login</a></button></div>
           <div class="nav-item  ">    <button type="button" class="btn btn-light"><a href="signup-user.php">Signup</a></button></div>
 
            </ul>
        </div>
    </nav>

<div class="copied" id="bank">Copied to clipboard</div>

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
      <div class="modal-body row">
      <div id="select_txt" class="nav-item"><?php echo $fetch_info['classcode'] ?></div>
      <div  class="close-fade" data-dismiss="modal" onclick="copy_data(select_txt)" id="btn">copy</div>
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
                <h1 class="jumbotron-heading">           <div class="nav-item"><?php echo $fetch_info['classname'] ?> <a  class="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-link" aria-hidden="true"></i></a></h1>
               
                
            </div>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="filter-tab text-center p-4">
                        <form id="form1" method="POST" >

                    <!--         <select  class="form-control" id="state" multiple name="state"
                                onchange="if(this.value != 0) { this.form.submit(); }"> -->
                                <label  class="filter-des" value='ALL'>
                                  <!--   <div value=ALL> -->
                                <input class="radio-filter" onchange="this.form.submit();" type="radio" name="state" value="ALL" >ALL</input>
<!-- </div> -->
                                </label>
                                <?php
                            $codihe = $_GET['codehe'];
                                $sql = "SELECT * FROM classsubject WHERE subjectcode = '$codihe'";
                                if($result = mysqli_query($con, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                            ?>
<label class="filter-des" value='<?php echo $row['subjects'];?>'>
                                <input  class="radio-filter" onchange="this.form.submit();" type="radio" name="state" value="<?php echo $row['subjects'];?>" for=<?php echo $row['subjects'];?>><?php echo $row['subjects'];?> </input>
                                </label>
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
                                    echo "<style>
                                    
                                    .filter-des[value='$str']{
                                        background-color: yellow;}
                                        
                                        /* .filter-des[value=ALL]{
                                            background-color: yellow;} */

                                        </style>";
                                        
                                    if($result = mysqli_query($con, $sql)){
                                        if(mysqli_num_rows($result) > 0){
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


                                            } mysqli_free_result($result); 
                                        } else 
                                        {
                                            $sql = "SELECT * FROM classvideo WHERE linkcode = '$codihe'";
                                            $result = mysqli_query($con, $sql);
                                           /*  echo "<style>.filter-des[value='ALL']{
                                                background-color: yellow;}></style>"; */
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
          
<!--       <div id="btn">Show bank div and hide fancy div</div> -->

     <!--  <div id="bank" style="display:none;">Bank Div</div> -->

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
$('#btn').click(function(e){    
    
    $('#bank').fadeIn(1000);
        $('#bank').delay(2000).fadeOut(1000);
  

});

</script>
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