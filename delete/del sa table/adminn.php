<?php
/* session_start(); */

include 'db.php';
include 'controllerUserData.php';
$email = $_SESSION['email'];
$password = $_SESSION['password'];



if($email != false && $password != false){


    $query = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
    $result=$query->execute([':email' => $email]);

   if($result){
       $fetch = $query->fetch(PDO::FETCH_ASSOC);
        /* $fetch_status = $fetch['status']; */
        $fetch_code = $fetch['code'];
        $fetch_classcode = $fetch['classcode'];
        $_SESSION["classcode"] = $fetch_classcode;
        /* if($fetch_status == "verified"){
            if($fetch_code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        } */
    }
}else{
    header('Location: login-user.php');
}

$varivari = $_GET['varivari'];






$query = $conn->prepare("SELECT * FROM classadmin WHERE classcode = :varivari");
                                    $result  =  $query->execute([':varivari' => $varivari]);
                               
if($result){

    $fetch =  $query->fetch(PDO::FETCH_ASSOC);
    $fetch_classcode  = $fetch['classcode'];
    
	
	
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="shortcut icon" href="favicon(1).ico"> -->
    <title> | Home</title>


    <link rel="stylesheet" type="text/css" href="styles.css">








    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>





    <script src="js/pace.js"></script>
    <link rel="stylesheet" href="css/pace-theme-minimal.css">




    <style>
        .video_menu {
            display: block;
        }

        .subject_menu {
            display: none;
        }
    </style>

</head>


<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light  sticky-top ">
        <a href="index" class="navbar-brand pl-5"><img src="img/logo.png" width="30px" height="30px"></a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto  ">

                <div class="nav-item  "> <button type="button" class="btn btn-light"><a
                            href="home.php">Link</a></button></div>
                <div class="nav-item  "> <button type="button" class="btn btn-light"><a
                            href="logout-user.php">Logout</a></button></div>

            </ul>
        </div>
    </nav>
    <?php 
	
	
	
	?>

    <div class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">
                <div class="nav-item"><?php  echo $fetch['classname']  ?><a class="" data-toggle="modal"
                        data-target="#exampleModal"><i class="fa fa-link" aria-hidden="true"></i></a>
                </div>
            </h1>
            <h3 class="jumbotron-heading">
                <div class="nav-item"></div>
            </h3>


        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body row">



                    <form action="admin.php" method="get" autocomplete="">
                        <div class="form-group">
                            <input type="hidden" value="<?php  echo $fetch['id']  ?>" name="id">
                            <input type="hidden" value="<?php  echo $varivari?>" name="varivari">
                            <input class="form-control" type="text" name="change-name" required
                                value="<?php  echo $fetch['classname']  ?>">
                        </div>

                        <div class="form-group">
                            <input class="form-control button" type="submit" name="check-name" value="Continue">
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>


    <button type="button" onclick="vidMenu()">Video</button>
    <button type="button" onclick="subMenu()">Subjkect</button>


    <div class="video_menu" id="video_menu">

        
    </div>

    <div class="subject_menu" id="subject_menu">
        <div class="content">
            <h1>Server Side Ajax CURD data table with Boostrap model</h1>
            <table id="subject_table" class="table table-striped">
                <thead bgcolor="#6cd8dc">
                    <tr class="table-primary">
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Number of Students</th>
                        <th></th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
            </table>
            </br>
            <div align="right">
                <button type="button" id="subject_add_button" data-toggle="modal" data-target="#subject_modal"
                    class="btn btn-success btn-lg">Add Course</button>
            </div>
        </div>



        <div id="subject_modal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="subject_form" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Course</h4>
                        </div>

                        <div class="modal-body">

                            <label>subjects</label>
                            <input type="text" name="subjects" id="subjects" class="form-control" />
                            <br />

                            <label>subjectcode</label>
                            <input type="text" name="subjectcode" id="subjectcode" class="form-control" />
                            <br />

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="subject_id" id="subject_id" />
                            <input type="hidden" name="subject_operation" id="subject_operation" />
                            <input type="submit" name="subject_action" id="subject_action" class="btn btn-primary"
                                value="Add" />
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <script>
        function vidMenu() {
            document.getElementById("video_menu").style.display = 'block';
            document.getElementById("subject_menu").style.display = 'none';
        }

        function subMenu() {
            document.getElementById("video_menu").style.display = 'none';
            document.getElementById("subject_menu").style.display = 'block';
        }
    </script>


    

 <script type="text/javascript" language="javascript" >
$(document).ready(function(){
    $('#subject_add_button').click(function(){
        $('#subject_form')[0].reset();
        $('.modal-title').text("Add Course Details");
        $('#subject_action').val("Add");
        $('#subject_operation').val("Add");
    });
    
    var dataTable = $('#subject_table').DataTable({
        "paging": false,
                "ordering": false,
                "processing": false,
                "serverSide": true,
                "responsive": true,
                "searching": false,
                
                "aoColumnDefs": [{
                    "bVisible": false,
                    "aTargets": [0, 3]
                }], 
               
                "order": [],
                "info": false,


                "ajax": {
                    url: "fetch.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 3, 4],
                    "orderable": false,
                }, ],
            });

    $(document).on('submit', '#subject_form', function(event){
        event.preventDefault();
        var id = $('#id').val();
        var subjects = $('#subjects').val();
        var subjectcode = $('#subjectcode').val();
       
        
        if(subjectcode != '' && subjects != '')
        {
            $.ajax({
                url:"insert.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#subject_form')[0].reset();
                    $('#subject_modal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            alert("Course Name, Number of students Fields are Required");
        }
    });
    
  
    $(document).on('click', '.delete', function(){
        var subject_id = $(this).attr("id");
        if(confirm("Are you sure you want to delete this user?"))
        {
            $.ajax({
                url:"insert.php",
                method:"POST",
                data:{subject_id:subject_id},
                success:function(data)
                {
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            return false;   
        }
    });
    
    
});
</script> 



    
</body>

</html>