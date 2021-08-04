<?php

include 'db.php';
include 'controllerUserData.php';
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$varivari= $_SESSION["classcode"];
if($email != false && $password != false){
    $query = $conn->prepare("SELECT * FROM classadmin WHERE email = :email");
    $result=$query->execute([':email' => $email]);
    if($result){
       $fetch = $query->fetch(PDO::FETCH_ASSOC);
        $fetch_code = $fetch['code'];
        $fetch_classcode = $fetch['classcode'];
        $_SESSION["classcode"] = $fetch_classcode;
    }
}else{
    header('Location: login-user.php');
}

$query = $conn->prepare("SELECT * FROM classadmin WHERE classcode = :varivari");
$result  =  $query->execute([':varivari' => $varivari]);                           
if($result){
    $fetch =  $query->fetch(PDO::FETCH_ASSOC);
    $fetch_classcode  = $fetch['classcode'];
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

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Loading -->
    <link rel="stylesheet" href="css/pace-theme-minimal.css">

    <!-- Datatable -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> -->
    <!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">


    <!-- Date Picker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">


    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            display: flex;
            flex-direction: column;


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
            background-color: green;

            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            -o-transition: all 0.5s;
        }


        /* Button */
        .video_menu {
            display: block;
        }

        .subject_menu {
            display: none;
        }

        .content {
            /* max-width: 1400px; */
            padding-left: 30px;
            padding-right: 30px;
            /* margin: auto; */
        }

        @media (min-width: 581px) {
            .name-modal .modal .modal-dialog {
                max-width: 350px !important;
            }
        }

        @media (max-width: 581px) and (min-width: 381px) {
            .name-modal .name {
                padding-left: 18vw;
                padding-right: 18vw;
            }
        }


        @media (min-width: 768px) {
            .fa-image {
                padding-top: 305px;
                margin-right: -15px;
                font-size: 17px;
            }
        }

        @media (max-width: 575px) {
            .fa-image {
                padding-top: 185px;
                margin-right: 0px;
                font-size: 14px;
            }
        }



        @media (max-width: 768px) and (min-width: 575px) {
            .fa-image {
                padding-top: 185px;
                margin-right: -15px;
                font-size: 14px;
            }
        }


        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td:first-child,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th:first-child {
            position: relative;
        }


        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background: rgba(0, 0, 0, 0.0);
            color: black;
            border-style: none;
            box-shadow: 0px 0px;

            content: "\f107";
            /* this is your text. You can also use UTF-8 character codes as I do here */
            font-family: FontAwesome;
            /*   left:-5px; */
            position: absolute;
            top: 21px;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th:first-child:before {
            background-color: white;
            color: black;
            border-style: none;
            box-shadow: 0px 0px;
            background: rgba(0, 0, 0, 0.0);

            content: "\f106";
            /* this is your text. You can also use UTF-8 character codes as I do here */
            font-family: FontAwesome;
            /*   left:-5px; */
            position: absolute;
            top: 21px;
        }


        @media (min-width:768px) {
            .dataTables_filter {

                float: left !important;
                margin-left: -49vw !important;


            }

        }

        @media (max-width:768px) {
            .dataTables_filter {
                user-select: none;
                float: left !important;
                /* margin-left:-1vw!important; */
                margin-left: -7px !important;

            }
        }

        .dataTables_filter input {

            box-shadow: none !important;
            width: 250px !important;
            height: 40px !important;
        }

        ::-ms-clear {
            display: none;
        }

        #video_table,
        #subject_table {
            border: 1px solid black;
        }

        .edit {
            /* padding:100px; */
        }

        .btn .update,
        .delete {
            margin-left: -20px;


        }

        /*   #image-preview {

            height: 105px;
            width: 4400px;
            object-fit: cover;
            overflow: hidden;

        }

        #image-div {
            text-align:center;
             object-fit: content; 
            position: relative;
            height: 170px;
            width: 480px;
            overflow: hidden;

        }

        @media (max-width:575px) {
            #image-preview {

                height: 20vw;
                width: 85vw;
                object-fit: cover;

            }
        } */

        .imageContainer {
            height: 105px;
            width: 430px;
            overflow: hidden;
            position: relative;
            margin: auto;

        }

        .imageCenterer {
            width: 1000px;
            position: absolute;
            left: 50%;
            top: 0;
            margin-left: -500px;
        }

        .imageCenterer img {
            display: block;
            margin: 0 auto;
            height: 105px;
            width: 430px;
            object-fit: cover;
        }


        @media (max-width:575px) {

            .imageContainer {
                height: 105px;
                margin: auto;

                width: 78vw;
                overflow: hidden;
                position: relative;
            }

            .imageCenterer img {
                display: block;
                margin: 0 auto;
                /* height: 105px;
           
                width: 85vw; */
                object-fit: cover;
            }
        }

        @media (min-width:420px) and (max-width:576px) {

            .upload-modal .modal-dialog {
                margin: 0px 3.5vw;
            }
        }






        .browse {
            margin-top: -70px;
            margin-left: 40%;
            position: relative;


        }

        .dt-body-center {
            text-align: left !important;
            padding-left: 10px !important;
        }

        .dt-first-last {
            text-align: left !important;
            padding-left: 25px !important;
        }

        .menu-buttons {
            padding-left: 30px;
            padding-bottom: 30px;
        }
    </style>




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


                <div class="nav-item left col-sm-6 "> <a href="home" class="btn btn-light">Videos</a></div>
                <div class="nav-item right col-sm-6"> <a href="logout" class="btn btn-light">Logout</a></div>
            </ul>
        </div>
    </nav>


    <!-- Jumbotron -->
    <div class="background-image ">
        <div class="jumbotron d-flex align-items-center text-center">
            <div class="container">
                <h1 class="jumbotron-heading"><?php  echo $fetch['classname']?><a data-toggle="modal"
                        data-target="#change_code_modal"><i class="fas fa-share" aria-hidden="true"></i></a>
                </h1>
            </div>
            <div class="jumbotron-upload text-right"><a data-toggle="modal" data-target="#upload_image_modal">
                    <i class="fas fa-image" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="menu-buttons ">
        <button type="button" class="btn btn-secondary" onclick="vidMenu()">Video</button>
        <button type="button" class="btn btn-secondary" onclick="subMenu()">Subject</button>
    </div>
    <div class="video_menu" id="video_menu">
        <div class="content">

            <table id="video_table" class="table dt-responsive nowrap row-border hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="25%">Lesson</th>
                        <th width="10%">Subject</th>
                        <th width="5%">Date</th>
                        <th width="30%">Link</th>
                        <th>Code</th>
                        <th width="0%"></th>
                        <th class="table-delete" width="0%"></th>
                    </tr>
                </thead>
            </table>

            <div>
                <button type="button" id="video_add_button" data-toggle="modal" data-target="#video_modal"
                    class="btn btn-secondary">Add Video</button>
            </div>
        </div>


        <div id="video_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="video_modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered px-3">
                <div class="modal-content">
                    <form method="post" id="video_form" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <h4 class="modal-title">Add Video</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title</label>

                                <input type="text" name="titles" id="titles" class="form-control" placeholder="Title"
                                    required />

                            </div>
                            <!-- Subject -->
                            <div class="form-group">
                                <label>Subject</label>
                                <select class="form-control subjects-select" id="subjects-select" required>
                                    <option selected disabled value="" style="display:none; color:#81898f;">Select a
                                        Subject</option>
                                    <?php
                                    $query = $conn->prepare("SELECT * FROM classsubject WHERE subjectcode = :subjectcode");
                                    $result  =  $query->execute([':subjectcode' => $fetch_classcode]);
                                    if($result){
                                        if($query->rowCount() > 0){
                                            while($row = $query->fetch(PDO::FETCH_BOTH)){
                                ?>
                                    <option><?php echo $row['subjects'];?></option>
                                    <?php
                                            }
                                        } else{
                                            echo "Add a Subject.";
                                        }
                                    }
                                     ?>
                                </select>
                                <input type="hidden" name="subjects" id="subjects" class="form-control"
                                    placeholder="Subject" />

                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <div class='input-group date' id='date-picker'>
                                    <input type="text" id="dates" name="dates" class="form-control"
                                        placeholder="Month Date, Year" required>
                                    <span class="input-group-append input-group-addon">
                                        <span class="bi bi-calendar input-group-text"></span>
                                    </span>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Link </label>
                                <!--  <div class="label-notes">include everything in beetween of " "</div> -->
                                <input type="url" name="links" id="links" class="form-control"
                                    placeholder="https://drive.google.com/file/d/link/preview" required />

                            </div>
                            <input type="hidden" name="linkcode" id="linkcode" value="<?php  echo $varivari?>"
                                class="form-control" />
                        </div>
                        <div class="modal-footerr text-right">
                            <input type="hidden" name="video_id" id="video_id" />
                            <input type="hidden" name="video_operation" id="video_operation" />
                            <input type="submit" name="video_action" id="video_action" class="btn btn-primary"
                                value="Add" />
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="subject_menu" id="subject_menu">
        <div class="content">

            <table id="subject_table" class="table dt-responsive nowrap row-border hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="100%">Subject</th>
                        <th>Code</th>
                        <th></th>
                        <th width="1%"></th>
                    </tr>
                </thead>
            </table>

            <div>
                <button type="button" id="subject_add_button" data-toggle="modal" data-target="#subject_modal"
                    class="btn btn-secondary ">Add Subject</button>
            </div>
        </div>

        <div id="subject_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="subject_modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered px-3">
                <div class="modal-content">
                    <form method="post" id="subject_form" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Subject</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="subjects" id="subjects" class="form-control" />

                                <input type="hidden" name="subjectcode" id="subjectcode" value="<?php  echo $varivari?>"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footerr text-right">
                            <input type="hidden" name="subject_id" id="subject_id" />
                            <input type="hidden" name="subject_operation" id="subject_operation" />
                            <input type="submit" name="subject_action" id="subject_action" class="btn btn-primary"
                                value="Add" />
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Code Modal -->
    <div class="name-modal">
        <div class="modal fade" id="change_code_modal" tabindex="-1" role="dialog"
            aria-labelledby="change_code_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered px-3" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title mx-auto">Change Name</h5>
                    </div>
                    <form action="admin.php" method="get" autocomplete="">
                        <div class="modal-body">

                            <div class="form-group pt-3">
                                <input type="hidden" value="<?php  echo $fetch['id']  ?>" name="id">
                                <input type="hidden" value="<?php  echo $varivari?>" name="varivari">
                                <input class="form-control" type="text" name="change-name" required
                                    value="<?php  echo $fetch['classname']  ?>">
                            </div>
                            <!--  <div class="form-group">

                            </div>
 -->


                        </div>
                        <div class="modal-footerr text-right">
                            <input type="submit" class="btn btn-primary" name="check-name" value="Change">
                            <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Upload Image Modal -->
    <div class="upload-modal">
        <div class="modal fade" id="upload_image_modal" tabindex="-1" role="dialog"
            aria-labelledby="upload_image_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered px-3" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title mx-auto">Select Image File</h5>
                    </div>
                    <div class="modal-body ">

                        <?php 
                if(isset($_SESSION['info'])){
                ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                }
                ?>
                        <?php
                if(count($errors) > 0){
                ?>
                        <div class="alert alert-danger text-center">
                            <style type="text/css">
                                .alert-success {
                                    display: none;
                                }
                            </style>
                            <?php
                    foreach($errors as $showerror){
                        echo $showerror;
                    }
                ?>
                        </div>
                        <?php
                } unset($_SESSION["info"])
                ?>
                        <form action="admin" method="post" enctype="multipart/form-data">

                            <input type="file" id="image" name="image" style="display: none;"
                                onchange="document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])">




                            <div class="imageContainer ">
                                <div class="imageCenterer">
                                    <img id="image-preview" />
                                </div>
                            </div>

                            <input type="button" class=" browse btn btn-secondary" value="Browse"
                                onclick="document.getElementById('image').click();" />




                    </div>

                    <div class="modal-footerr text-right">
                        <input type="submit" class="btn btn-primary" name="upload-image" id="btn" value="Upload">
                        <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer">
        <div class="footer-text text-center py-2">
            <a href="https://github.com/Nydigorith/AraLink" target="_blank">Download Source Code</a>

            <!-- Back To Top -->
            <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i
                    class="fas fa-chevron-up pt-2"></i></a>

            <!-- Loading -->
            <script src="js/pace.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous">
            </script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <!-- Jquery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

            <!-- Datatable -->
            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

            <!-- Date Picker -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
            </script>



            <script>
                if (document.getElementById("image").files.length == 0) {
                    document.getElementById("image-preview").src = "img/no-image.jpg";
                    console.log("no files selected");
                }
            </script>
            <script type="text/javascript" language="javascript">
                var message;
                if (message == "e") {
                    $('#upload_image_modal').modal("show");
                }



                $("#subjects-select").change(function () {
                    $("#subjects").val($(this).val());
                });
                $('#date-picker').datetimepicker({
                    format: 'MMMM DD, YYYY'
                });


                $(document).ready(function () {
                    $('#video_add_button').click(function () {
                        $('#video_form')[0].reset();
                        $('.modal-title').text("Add Video Details");
                        $('#video_action').val("Add");
                        $('#video_operation').val("Add");
                    });
                    var dataTable = $('#video_table').DataTable({
                        "paging": false,
                        "ordering": false,
                        "processing": false,
                        "serverSide": true,
                        "responsive": true,
                        "columns": [{
                                "responsivePriority": 1
                            },
                            {
                                "responsivePriority": 2
                            },
                            {
                                "responsivePriority": 6
                            },
                            {
                                "responsivePriority": 5
                            },
                            {
                                "responsivePriority": 8
                            },
                            {
                                "responsivePriority": 3
                            },
                            {
                                "responsivePriority": 4
                            },
                            {
                                "responsivePriority": 0
                            }
                        ],



                        "language": {
                            "searchPlaceholder": "Search for Lesson",
                            "search": ''
                        },


                        "order": [],
                        "info": false,
                        "ajax": {
                            url: 'vfetch.php',
                            type: "POST"
                        },
                        "columnDefs": [{
                                "targets": [0, 3, 4],
                                "orderable": false,

                            },

                            {
                                "targets": [6],
                                "className": "text-right pr-3",
                                "autoWidth": false
                                /* "width": "%" */

                            },
                            {
                                "targets": [7],
                                "className": "text-right pr-3",
                                "autoWidth": false
                                /* "width": "%" */

                            },
                            {
                                "targets": [0, 5],
                                "visible": false,
                            },

                            {
                                "targets": [0, 2, 3, 4, 5, 6],
                                "className": "dt-body-center",

                                /* "width": "%" */

                            },
                            {
                                "targets": [1],
                                "className": "dt-first-last",

                                /* "width": "%" */

                            },

                        ]

                    });

                    $(document).on('submit', '#video_form', function (event) {
                        event.preventDefault();
                        var id = $('#id').val();
                        var titles = $('#titles').val();
                        var subjects = $('#subjects').val();
                        var dates = $('#dates').val();
                        var links = $('#links').val();
                        var linkcode = $('#linkcode').val();
                        $.ajax({
                            url: "insert.php",
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                $('#video_form')[0].reset();
                                $('#video_modal').modal('hide');
                                dataTable.ajax.reload();
                            }
                        });
                    });

                    $(document).on('click', '.update', function () {
                        var video_id = $(this).attr("id");
                        $.ajax({
                            url: "fetch_edit.php",
                            method: "POST",
                            data: {
                                video_id: video_id
                            },
                            dataType: "json",
                            success: function (data) {
                                $('#video_modal').modal('show');
                                $('#id').val(data.id);

                                $('#titles').val(data.titles);
                                $('#subjects-select').val(data.subjects);
                                $('#subjects').val(data.subjects);
                                $('#dates').val(data.dates);
                                $('#links').val(data.links);
                                $('#linkcode').val(data.linkcode);

                                $('.modal-title').text("Edit Video Details");
                                $('#video_id').val(video_id);
                                $('#video_action').val("Save");
                                $('#video_operation').val("Edit");
                            }
                        })
                    });

                    $(document).on('click', '.delete', function () {
                        var video_id = $(this).attr("id");
                        if (confirm("Are you sure you want to delete this user?")) {
                            $.ajax({
                                url: "insert.php",
                                method: "POST",
                                data: {
                                    video_id: video_id
                                },
                                success: function (data) {
                                    dataTable.ajax.reload();
                                }
                            });
                        } else {
                            return false;
                        }
                    });
                });
            </script>

            <script type="text/javascript" language="javascript">
                $(document).ready(function () {
                    $('#subject_add_button').click(function () {
                        $('#subject_form')[0].reset();
                        $('.modal-title').text("Add Video Details");
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
                        "order": [],
                        "info": false,
                        "ajax": {
                            url: "fetch.php",
                            type: "POST"
                        },
                        "columnDefs": [{
                                "targets": [0, 3, 4],
                                "orderable": false,
                            },
                            {

                                "targets": [0, 2, 3],
                                "visible": false,

                            },
                            {
                                "targets": [4],
                                "className": "text-right pr-3",
                                "autoWidth": false,


                            },

                            {
                                "targets": [0, 1, 2, 3],
                                "className": "text-left pl-3",



                            },
                            {
                                "targets": [1],
                                "className": "text-left pl-3",



                            },
                        ],
                    });

                    $(document).on('submit', '#subject_form', function (event) {
                        event.preventDefault();
                        var id = $('#id').val();
                        var subjects = $('#subjects').val();
                        var subjectcode = $('#subjectcode').val();
                        $.ajax({
                            url: "insert.php",
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                $('#subject_form')[0].reset();
                                $("#subjects-select").load(" #subjects-select > *");
                                $('#subject_modal').modal('hide');
                                dataTable.ajax.reload();
                            }
                        });
                    });

                    $(document).on('click', '.deletee', function () {
                        var subject_id = $(this).attr("id");
                        if (confirm("Are you sure you want to delete this user?")) {
                            $.ajax({
                                url: "insert.php",
                                method: "POST",
                                data: {
                                    subject_id: subject_id
                                },
                                success: function (data) {
                                    dataTable.ajax.reload();
                                    $("#subjects-select").load(" #subjects-select > *");
                                }
                            });
                        } else {
                            return false;
                        }
                    });



                });
            </script>

            <script>
                /* Button */
                function vidMenu() {
                    document.getElementById("video_menu").style.display = 'block';
                    document.getElementById("subject_menu").style.display = 'none';
                }

                function subMenu() {
                    document.getElementById("video_menu").style.display = 'none';
                    document.getElementById("subject_menu").style.display = 'block';
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