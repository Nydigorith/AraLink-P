<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];



if($email != false && $password != false){
    $sql = "SELECT * FROM classadmin WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $scode = $fetch_info['classcode'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
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
    <a class="navbar-brand" href="#"><?php echo $fetch_info['classname'] ?></a>
    <a class="navbar-brand" href="#"><?php echo $fetch_info['classcode'] ?></a>
    
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
  <!--   <h1>Welcome <?php echo $fetch_info['name'] ?></h1> -->


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
                                $sql = "SELECT * FROM classsubject WHERE subjectcode = '$scode'";
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
                                if(isset($_GET['state'])) {
                                    
                                    $str = $_GET["state"];

                                    $sql = "SELECT * FROM classvideo WHERE subjects = '$str' AND linkcode = '$scode'";
                                    if($result = mysqli_query($con, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                            ?>

                            <div class="video-border"><iframe src="<?php echo $row['links'];?>" allowfullscreen="true" class="videorow"></iframe><div class="video-text"> <?php echo $row['titles'];?><br><?php echo $row['dates'];?> </div></div>
                            
                            
                              
                            <?php
                                            } mysqli_free_result($result); 
                                        } else{
                                            $sql = "SELECT * FROM classvideo WHERE linkcode = '$scode'";
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
    
</body>
</html>