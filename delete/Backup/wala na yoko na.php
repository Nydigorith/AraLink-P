<?php /* require_once "controllerUserData.php"; */ ?>
<?php 
require "connection.php";
$email = "";
$name = "";
$errors = array();

$regValue = $_GET['codehe'];



?>

<!-- <p><a href="set_reg.php">Back to set_reg.php</a> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    nav{
        padding-left: 100px!important;
        padding-right: 100px!important;
        background: #6665ee;
        font-family: 'Poppins', sans-serif;
    } 
    nav a.navbar-brand{
        color: #fff;
        font-size: 30px!important;
        font-weight: 500;
    }
    button a{
        color: #6665ee;
        font-weight: 500;
    }
    button a:hover{
        text-decoration: none;
    }
    h1{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }
    </style>
</head>
<body>
    <nav class="navbar">
    <a class="navbar-brand" href="#"><span id = "classcoding"></span></a>











    <a class="navbar-brand" href="#"></a>
    
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
  

    <div class="section text-center  mt-5">
        <h1>Video Recording</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="text-menu">
                <form method="GET">
                    <select id="state" multiple name="state" onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value="ALL">ALL</option> 

                            <?php
                                $sql = "SELECT * FROM classsubject";
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
                </form>


                <div class="videos">
                    <div class="row">
                        <div class="card">
                            <?php
                                if(isset($_GET['state']) && ($_GET['codehe'])) {
                                    
                                    $str = $_GET["state"];
                                    
$codihe = $_GET['codehe'];

                                    $sql = "SELECT * FROM classvideo WHERE subjects = '$str' AND linkcode = '$codihe'";
                                    if($result = mysqli_query($con, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                            ?>

                            <div class="video-border"><iframe src="<?php echo $row['links'];?>" allowfullscreen="true" class="videorow"></iframe><div class="video-text"> <?php echo $row['titles'];?><br><?php echo $row['dates'];?> </div></div>
                            
                            
                              
                            <?php
                                            } mysqli_free_result($result); 
                                        } else{
                                            $sql = "SELECT * FROM classvideo WHERE linkcode = '$codihe'";
                                            $result = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_array($result)){
                            ?>

 <div class="video-border"><iframe src="<?php echo $row['links'];?>" allowfullscreen="true" class="videorow"></iframe><div class="video-text"> <?php echo $row['titles'];?><br><?php echo $row['dates'];?> </div></div>
                            
                            <?php
                                            }  
                                        }
                                    }
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    


<?php
   
   /*  $codihe  = '<script>var retrievedObject = localStorage.getItem("textValue");;</script>"';
echo $codihe; */
?>

     <script>
     var retrievedObject = localStorage.getItem('textValue'); */
   /*  document.getElementById("result").innerHTML=localStorage.getItem("textValue"); */

    </script> 
</body>
</html>