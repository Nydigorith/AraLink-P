<?php

require 'db.php';
require_once 'php/php-controller.php';
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
    header('Location: login');
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
        background-image: url(img/bg2.png);
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
    <!--     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

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






        @media (min-width: 768px) {
            .fa-image {
                padding-top: 305px;
                margin-right: -15px;
                font-size: 17px;
                color: rgb(46, 50, 51);
            }
        }

        @media (max-width: 575px) {
            .fa-image {
                padding-top: 185px;
                margin-right: 0px;
                font-size: 15px;
                color: rgb(46, 50, 51);
            }
        }



        @media (max-width: 768px) and (min-width: 575px) {
            .fa-image {
                padding-top: 185px;
                margin-right: -15px;
                font-size: 15px;
                color: rgb(46, 50, 51);
            }
        }

        @media (max-width: 768px) {}


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
            font-family: "Font Awesome 5 Free";
            /*   left:-5px; */
            position: absolute;
            font-weight: 600;
            top: 21px;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th:first-child:before {
            background-color: white;
            color: black;
            border-style: none;
            box-shadow: 0px 0px;
            background: rgba(0, 0, 0, 0.0);
            font-weight: 600;
            content: "\f106";
            /* this is your text. You can also use UTF-8 character codes as I do here */
            font-family: "Font Awesome 5 Free";
            /*   left:-5px; */
            position: absolute;
            top: 21px;
        }

        /*    #table_div_id.dataTables_filter {
  float: right;
  text-align: right;
}
.dataTables_wrapper .myfilter .dataTables_filter {
    float:left
}
.dataTables_wrapper .mylength .dataTables_length {
    float:right
} */

        .dataTables_filter {
            display: none;


            /* margin-right:5px; */
        }

        ::-ms-clear {
            display: none !important;
        }

        ::-webkit-search-cancel-button {
            -webkit-appearance: none !important;
        }

        table {
            margin: 0px;
            padding: 0px;
            /* padding:1px; */
            /*   border-left: 1px solid black;
            border-top: 1px solid black;
            border-right: 1px solid black; */
            /* border: 1px solid black;  */
            font-size: 15px;

        }



        div.dataTables_filter input {
            border: 1px solid black !important;
        }

        table#video_table.dataTable tbody tr:hover,
        table#subject_table.dataTable tbody tr:hover {
            background-color: green;
        }

        table {
            background-color: white !important;
        }

        table#video_table.dataTable tbody tr,
        table#subject_table.dataTable tbody tr {
            background-color: white;
        }


        .btn-icon {
            padding: 10px;
            /* border-radius:5px; */
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

        #video_modal,
        .modal-content {
            padding: 0 2px;
        }

        #subject_modal,
        .modal-content {
            padding: 0 2px;
        }

        .imageContainer {
            height: 105px;
            width: 430px;
            overflow: hidden;
            position: relative;
            margin: auto;
            margin-top: -12px;
            border: 2px gray solid;

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

        .modal-footerrr {
            padding-top: 50px;
        }

        @media (min-width:420px) and (max-width:576px) {

            .upload-modal .modal-dialog {
                margin: 0px 3.5vw;
            }
        }



        .in-image {
            display: flex;
            margin-top: -70px;

            justify-content: center;
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





        .menu-buttons .btn {
            width: 100px;
        }

        @media (max-width: 800px) {
            .dipnone {
                display: none !important;
            }
        }

        .subjects-select {
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
            /* overflow-wrap: break-word; */


            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABTkAAANhCAYAAAAser/AAAAACXBIWXMAAC4jAAAuIwF4pT92AAAGWWlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDIgNzkuMTY0NDYwLCAyMDIwLzA1LzEyLTE2OjA0OjE3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjEuMiAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIxLTA4LTE2VDAxOjM5OjM1KzA4OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMS0wOC0xNlQwMTo0MDoxNyswODowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMS0wOC0xNlQwMTo0MDoxNyswODowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo4YmYyOTg0MC04MGE2LTgyNGMtOGZiYS05MmZkZGZhMTk1ZWUiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDo0MTc5ZWI4Mi1mZjQ0LTc0NDMtYTRiNi1hOTNjNTM2MWFiYTMiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDowYWM2N2NhZi0wOTJhLTdmNDItOGZhNC00NGZhMTQ4NzczYWEiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjBhYzY3Y2FmLTA5MmEtN2Y0Mi04ZmE0LTQ0ZmExNDg3NzNhYSIgc3RFdnQ6d2hlbj0iMjAyMS0wOC0xNlQwMTozOTozNSswODowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjIgKFdpbmRvd3MpIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjb252ZXJ0ZWQiIHN0RXZ0OnBhcmFtZXRlcnM9ImZyb20gYXBwbGljYXRpb24vdm5kLmFkb2JlLnBob3Rvc2hvcCB0byBpbWFnZS9wbmciLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjhiZjI5ODQwLTgwYTYtODI0Yy04ZmJhLTkyZmRkZmExOTVlZSIgc3RFdnQ6d2hlbj0iMjAyMS0wOC0xNlQwMTo0MDoxNyswODowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjIgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDwvcmRmOlNlcT4gPC94bXBNTTpIaXN0b3J5PiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PidjUH0AAESNSURBVHic7d3rlRxJfubpFzzzfYwSEC0BjRIQLcHWSLAxEmxRgq2RoIcSoEeC5kpQoARlLQFqJICNBNgPgSwkgLzExfz+POf8DyKBrExvVJ3w9l+aub/5/PlzAAAAAAC26h+WPgAAAAAA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nH/+/jeeuifnpzjxADBOj3t0AsCR1QicAIz1e5I/Jc/fk/NtnHgAGKvEik4AOKoagROA8d7mu3PL95GzznQgABxLidAJAEdTI3ACMJ36+AORE4C5lAidAHAUNQInANN69/iD7yPnDzftBICBSoROANi7GoETgOn90+MPnronJwBMqUToBIC9qhE4AZjH28cffP909c/zHw8AB9XjqesAsCc1AicA83rz1NPV3y5yKAAcVYkVnQCwFzUCJwDzKw8vRE4AllQidALA1tUInAAsoz68EDkBWFqJ0AkAW1UjcAKwnPLwQuQEYA1KhE4A2JoagROAZdWHF48j53+d/zgA4A8lQicAbEWNwAnAijyOnHWpgwCAL0qETgBYuxqBE4B1+OeHF//w0mcBwAJKhE4AWKsagROA9SgPL0ROANaoROgEgLWpETgBWCnb1QFYqxKhEwDWokbgBGB93j68ePP58+fzizdvPi91NADwgp7kz0nasocBAIdVI3ACsFKfP39+k9iuDsD6lVjRCQBLqRE4AdgAkROALSgROgFgbjUCJwAbIXICsBUlQicAzKVG4ARgQ0ROALakROgEgKnVCJwAbIzICcDWlAidADCVGoETgA0SOQHYohKhEwBGqxE4AdgokROArSoROgFglBqBE4ANEzkB2LISoRMA7lUjcAKwcSInAFtXInQCwK1qBE4AdkDkBGAPSoROALhWjcAJwE48jpwfljoIABigROgEgEvVCJwAbF97eGElJwB7UiJ0AsBragROAPahP7wQOQHYmxKhEwCeUyNwArBDjyNnW+ogAGCwEqETAL5XI3ACsC/94cXjyPl/5j8OAJhMidAJAA9qBE4A9ufvDy8eR84+/3EAwKRKhE4AqBE4Adg529UB2LsSoROA46oROAHYrw8PL6zkBOAISoROAI6nRuAE4CDefP78+fzizZsk+bzo0QDAtHqSP8fuBQD2r0bgBGD//mib//DdH/w++6EAwHxKrOgEYP9qBE4A9q8//kDkBOBoSoROAParRuAE4Bja4w++j5z/Od9xAMBiSoROAPanRuAE4Dja4w+s5ATgqEqETgD2o0bgBOBY/vfjD76PnG2+4wCAxZUInQBsX43ACcDxtMcffP909cQT1gE4nh5PXQdgm2oETgCO6U2SPPd09ST5MOPBAMAalFjRCcD21AicABxT+/43noqc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AIzUI3DOQuScR4vQCQAjlQidMFqNwAkAI/UInLMROefTInQCwEglQieMUiNwAsBIPQLnrETOebUInQAwUonQCfeqETgBYKQegXN2Iuf8WoROABipROiEW9UInAAwUo/AuQiRcxktQicAjFQidMK1agROABipR+BcjMi5nBahEwBGKhE64VI1AicAjNQjcC5K5FxWi9AJACOVCJ3wmhqBEwBG6hE4FydyLq9F6ASAkUqETnhOjcAJACP1CJyrIHKuQ4vQCQAjlQid8L0agRMARuoROFdD5FyPFqETAEYqETrhQY3ACQAj9QicqyJyrkuL0AkAI5UInVAjcALASD0C5+qInOvTInQCwEglQifHVSNwAsBIPQLnKomc69QidALASCVCJ8dTI3ACwEg9AudqiZzr1SJ0AsBIJUInx1EjcALASD0C56qJnOvWInQCwEglQif7VyNwAsBIPQLn6omc69cidALASCVCJ/tVI3ACwEg9AucmiJzb0CJ0AsBIJUIn+1MjcALASD0C52aInNvRInQCwEglQif7USNwAsBIPQLnpoic29IidALASCVCJ9tXI3ACwEg9AufmiJzb0yJ0AsBIJUIn21UjcALASD0C5yaJnNvUInQCwEglQifbUyNwAsBIPQLnZomc29UidALASCVCJ9tRI3ACwEg9AuemiZzb1iJ0AsBIJUIn61cjcALASD0C5+aJnNvXInQCwEglQifrVSNwAsBIPQLnLoic+9AidALASCVCJ+tTI3ACwEg9AuduiJz70SJ0AsBIJUIn61EjcALASD0C566InPvSInQCwEglQifLqxE4AWCkHoFzd0TO/WkROgFgpBKhk+XUCJwAMFKPwLlLIuc+tQidADBSidDJ/GoETgAYqUfg3C2Rc79ahE4AGKlE6GQ+NQInAIzUI3Dumsi5by1CJwCMVCJ0Mr0agRMARuoROHdP5Ny/FqETAEYqETqZTo3ACQAj9QichyByHkOL0AkAI5UInYxXI3ACwEg9AudhiJzH0SJ0AsBIJUIn49QInAAwUo/AeSgi57G0CJ0AMFKJ0Mn9agROABipR+A8HJHzeFqETgAYqUTo5HY1AicAjNQjcB6SyHlMLUInAIxUInRyvRqBEwBG6hE4D0vkPK4WoRMARioROrlcjcAJACP1CJyHJnIeW4vQCQAjlQidvK5G4ASAkXoEzsMTOWkROgFgpBKhk+fVCJwAMFKPwElETs5ahE4AGKlE6ORHNQInAIzUI3DyhcjJgxahEwBGKhE6+apG4ASAkXoETh4ROXmsRegEgJFKhE4ETgAYrUfg5DsiJ99rEToBYKQSofPIagROABipR+DkCSInT2kROgFgpBKh84hqBE4AGKlH4OQZIifPaRE6AWCkEqHzSGoETgAYqUfg5AUiJy9pEToBYKQSofMIagROABipR+DkFSInr2kROgFgpBKhc89qBE4AGKlH4OQCIieXaBE6AWCkEqFzj2oETgAYqUfg5EIiJ5dqEToBYKQSoXNPagROABipR+DkCiIn12gROgFgpBKhcw9qBE4AGKlH4ORKIifXahE6AWCkEqFzy2oETgAYqUfg5AYiJ7doEToBYKQSoXOLagROABipR+DkRiInt2oROgFgpBKhc0tqBE4AGKlH4OQOIif3aBE6AWCkEqFzC2oETgAYqUfg5E4iJ/dqEToBYKQSoXPNagROABipR+BkAJGTEVqETgAYqUToXKMagRMARuoROBlE5GSUFqETAEYqETrXpEbgBICRegROBhI5GalF6ASAkUqEzjWoETgBYKQegZPBRE5GaxE6AWCkEqFzSTUCJwCM1CNwMgGRkym0CJ0AMFKJ0LmEGoETAEbqETiZiMjJVFqETgAYqUTonFONwAkAI/UInExI5GRKLUInAIxUInTOoUbgBICRegROJiZyMrUWoRMARioROqdUI3ACwEg9AiczEDmZQ4vQCQAjlQidU6gROAFgpB6Bk5mInMylRegEgJFKhM6RagROABipR+BkRiInc2oROgFgpBKhc4QagRMARuoROJmZyMncWoROABipROi8R43ACQAj9QicLEDkZAktQicAjFQidN6iRuAEgJF6BE4WInKylBahEwBGKhE6r1EjcALASD0CJwsSOVlSi9AJACOVCJ2XqBE4AWCkHoGThYmcLK1F6ASAkUqEzpfUCJwAMFKPwMkKiJysQYvQCQAjlQidT6kROAFgpB6Bk5UQOVmLFqETAEYqETofqxE4AWCkHoGTFRE5WZMWoRMARioROhOBEwBG6xE4WRmRk7VpEToBYKSSY4fOGoETAEbqEThZIZGTNWoROgFgpJJjhs4agRMARuoROFkpkZO1ahE6AWCkkmOFzhqBEwBG6hE4WTGRkzVrEToBYKSSY4TOGoETAEbqEThZOZGTtWsROgFgpJJ9h84agRMARuoRONkAkZMtaBE6AWCkkn2GzhqBEwBG6hE42QiRk61oEToBYKSSfYXOGoETAEbqETjZEJGTLWkROgFgpJJ9hM4agRMARuoRONkYkZOtaRE6AWCkkm2HzhqBEwBG6hE42SCRky1qEToBYKSSbYbOGoETAEbqETjZKJGTrWoROgFgpJJthc4agRMARuoRONkwkZMtaxE6AWCkkm2EzhqBEwBG6hE42TiRk61rEToBYKSSdYfOGoETAEbqETjZAZGTPWgROgFgpJJ1hs4agRMARuoRONkJkZO9aBE6AWCkknWFzhqBEwBG6hE42RGRkz1pEToBYKSSdYTOGoETAEbqETjZGZGTvWkROgFgpJJlQ2eNwAkAI/UInOyQyMketQidADBSyTKhs0bgBICRegROdkrkZK9ahE4AGKlk3tBZI3ACwEg9Aic7JnKyZy1CJwCMVDJP6KwROAFgpB6Bk50TOdm7FqETAEYqmTZ01gicADBSj8DJAYicHEGL0AkAI5VMEzprBE4AGKlH4OQgRE6OokXoBICRSsaGzhqBEwBG6hE4ORCRkyNpEToBYKSSMaGzRuAEgJF6BE4ORuTkaFqETgAYqeS+0FkjcALASD0CJwckcnJELUInAIxUclvorBE4AWCkHoGTgxI5OaoWoRMARiq5LnTWCJwAMFKPwMmBiZwcWYvQCQAjlVwWOmsETgAYqUfg5OBETo6uRegEgJFKXg6dNQInAIzUI3CCyAkROgFgtJKnQ2eNwAkAI/UInJBE5IQHLUInAIxU8m3orBE4AWCkHoET/iBywlctQicAjFRyDpunCJwAMFKPwAnfePP58+fzizdvFj4UWI0aF2IAAACsU4/ACX94aJtWcsKPWqzoBAAAYH16BE54ksgJT2sROgEAAFiPHoETniVywvNahE4AAACW1yNwwotETnhZi9AJAADAcnoETniVyAmvaxE6AQAAmF+PwAkXETnhMi1CJwAAAPPpETjhYiInXK5F6AQAAGB6PQInXEXkhOu0CJ0AAABMp0fghKuJnHC9FqETAACA8XoETriJyAm3aRE6AQAAGKdH4ISbiZxwuxahEwAAgPv1CJxwF5ET7tMidAIAAHC7HoET7iZywv1ahE4AAACu1yNwwhAiJ4zRInQCAABwuR6BE4YROWGcFqETAACA1/UInDCUyAljtQidAAAAPK9H4IThRE4Yr0XoBAAA4Ec9AidMQuSEabQInQAAAHzVI3DCZEROmE6L0AkAAIDACZMTOWFaLUInAADAkfUInDA5kROm1yJ0AgAAHFGPwAmzEDlhHi1CJwAAwJH0CJwwG5ET5tMidAIAABxBj8AJsxI5YV4tQicAAMCe9QicMDuRE+bXInQCAADsUY/ACYsQOWEZLUInAADAnvQInLAYkROW0yJ0AgAA7EGPwAmLEjlhWS1CJwAAwJb1CJywOJETltcidAIAAGxRj8AJqyBywjq0CJ0AAABb0iNwwmqInLAeLUInAADAFvQInLAqIiesS4vQCQAAsGY9AiesjsgJ69MidAIAAKxRj8AJqyRywjq1CJ0AAABr0iNwwmqJnLBeLUInAADAGvQInLBqIiesW4vQCQAAsKQegRNWT+SE9WsROgEAAJbQI3DCJoicsA0tQicAAMCcegRO2AyRE7ajRegEAACYQ4/ACZsicsK2tAidAAAAU+oROGFzRE7YnhahEwAAYAo9AidsksgJ29QidAIAAIzUI3DCZomcsF0tQicAAMAIPQInbJrICdvWInQCAADco0fghM0TOWH7WoROAACAW/QInLALIifsQ4vQCQAAcI0egRN2Q+SE/WgROgEAAC7RI3DCroicsC8tQicAAMBLegRO2B2RE/anRegEAAB4So/ACbskcsI+tQidAAAAj/UInLBbIifsV4vQCQAAkAicsHsiJ+xbi9AJAAAcW4/ACbsncsL+tQidAADAMfUInHAIIiccQ4vQCQAAHEuPwAmHIXLCcbQInQAAwDH0CJxwKCInHEuL0AkAAOxbj8AJhyNywvG0CJ0AAMA+9QiccEgiJxxTi9AJAADsS4/ACYclcsJxtQidAADAPvQInHBoIiccW4vQCQAAbFuPwAmHJ3ICLUInAACwTT0CJxCREzhrEToBAIBt6RE4gS9ETuBBi9AJAABsQ4/ACTwicgKPtQidAADAuvUInMB3RE7gey1CJwAAsE49AifwBJETeEqL0AkAAKxLj8AJPEPkBJ7TInQCAADr0CNwAi8QOYGXtAidAADAsnoETuAVIifwmhahEwAAWEaPwAlcQOQELtEidAIAAPPqETiBC4mcwKVahE4AAGAePQIncAWRE7hGi9AJAABMq0fgBK4kcgLXahE6AQCAafQInMANRE7gFi1CJwAAMFaPwAncSOQEbtUidAIAAGP0CJzAHURO4B4tQicAAHCfHoETuJPICdyrRegEAABu0yNwAgOInMAILUInAABwnR6BExhE5ARGaRE6AQCAy/QInMBAIicwUovQCQAAvKxH4AQGEzmB0VqETgAA4Gk9AicwAZETmEKL0AkAAHyrR+AEJiJyAlNpEToBAICzHoETmJDICUypRegEAICj6xE4gYmJnMDUWoROAAA4qh6BE5iByAnMoUXoBACAo+kROIGZiJzAXFqETgAAOIoegROYkcgJzKlF6AQAgL3rETiBmYmcwNxahE4AANirHoETWIDICSyhRegEAIC96RE4gYWInMBSWoROAADYix6BE1iQyAksqUXoBACAresROIGFiZzA0lqETgAA2KoegRNYAZETWIMWoRMAALamR+AEVkLkBNaiRegEAICt6BE4gRUROYE1aRE6AQBg7XoETmBlRE5gbVqETgAAWKsegRNYIZETWKMWoRMAANamR+AEVkrkBNaqRegEAIC16BE4gRUTOYE1axE6AQBgaT0CJ7ByIiewdi1CJwAALKVH4AQ2QOQEtqBF6AQAgLn1CJzARoicwFa0CJ0AADCXHoET2BCRE9iSFqETAACm1iNwAhsjcgJb0yJ0AgDAVHoETmCDRE5gi1qETgAAGK1H4AQ2SuQEtqpF6AQAgFF6BE5gw0ROYMtahE4AALhXj8AJbJzICWxdi9AJAAC36hE4gR0QOYE9aBE6AQDgWj0CJ7ATIiewFy1CJwAAXKpH4AR2ROQE9qRF6AQAgNf0CJzAzoicwN60CJ0AAPCcHoET2CGRE9ijFqETAAC+1yNwAjslcgJ71SJ0AgDAgx6BE9gxkRPYsxahEwAAegROYOdETmDvWoROAACOq0fgBA5A5ASOoEXoBADgeHoETuAgRE7gKFqETgAAjqNH4AQOROQEjqRF6AQAYP96BE7gYERO4GhahE4AAParR+AEDkjkBI6oRegEAGB/egRO4KBETuCoWoROAAD2o0fgBA5M5ASOrEXoBABg+3oETuDgRE7g6FqETgAAtqtH4AQQOQEidAIAsE09AidAEpET4EGL0AkAwHb0CJwAfxA5Ab5qEToBAFi/HoET4BsiJ8C3WoROAADWq0fgBPiByAnwoxahEwCA9ekROAGeJHICPK1F6AQAYD16BE6AZ4mcAM9rEToBAFhej8AJ8CKRE+BlLUInAADL6RE4AV4lcgK8rkXoBABgfj0CJ8BFRE6Ay7QInQAAzKdH4AS4mMgJcLkWoRMAgOn1CJwAVxE5Aa7TInQCADCdHoET4GoiJ8D1WoROAADG6xE4AW4icgLcpkXoBABgnB6BE+BmIifA7VqETgAA7tcjcALcReQEuE+L0AkAwO16BE6Au4mcAPdrEToBALhej8AJMITICTBGi9AJAMDlegROgGFEToBxWoROAABe1yNwAgwlcgKM1SJ0AgDwvB6BE2A4kRNgvBahEwCAH/UInACTEDkBptEidAIA8FWPwAkwGZETYDotQicAAAInwOREToBptQidAABH1iNwAkxO5ASYXovQCQBwRD0CJ8AsRE6AebQInQAAR9IjcALMRuQEmE+L0AkAcAQ9AifArEROgHm1CJ0AAHvWI3ACzE7kBJhfi9AJALBHPQInwCJEToBltAidAAB70iNwAixG5ARYTovQCQCwBz0CJ8CiRE6AZbUInQAAW9YjcAIsTuQEWF6L0AkAsEU9AifAKoicAOvQInQCAGxJj8AJsBoiJ8B6tAidAABb0CNwAqyKyAmwLi1CJwDAmvUInACrI3ICrE+L0AkAsEY9AifAKomcAOvUInQCAKxJj8AJsFoiJ8B6tQidAABr0CNwAqyayAmwbi1CJwDAknoEToDVEzkB1q9F6AQAWEKPwAmwCSInwDa0CJ0AAHPqETgBNkPkBNiOFqETAGAOPQInwKaInADb0iJ0AgBMqUfgBNgckRNge1qETgCAKfQInACbJHICbFOL0AkAMFKPwAmwWSInwHa1CJ0AACP0CJwAmyZyAmxbi9AJAHCPHoETYPNEToDtaxE6AQBu0SNwAuyCyAmwDy1CJwDANXoEToDdEDkB9qNF6AQAuESPwAmwKyInwL60CJ0AAC/pETgBdkfkBNifFqETAOApPQInwC6JnAD71CJ0AgA81iNwAuyWyAmwXy1CJwBAInAC7J7ICbBvLUInAHBsPQInwO6JnAD71yJ0AgDH1CNwAhyCyAlwDC1CJwBwLD0CJ8BhiJwAx9EidAIAx9AjcAIcisgJcCwtQicAsG89AifA4YicAMfTInQCAPvUI3ACHJLICXBMLUInALAvPQInwGGJnADH1SJ0AgD70CNwAhyayAlwbC1CJwCwbT0CJ8DhiZwAtAidAMA29QicAETkBOCsRegEALalR+AE4AuRE4AHLUInALANPQInAI+InAA81iJ0AgDr1iNwAvAdkROA77UInQDAOvUInAA8QeQE4CktQicAsC49AicAzxA5AXhOi9AJAKxDj8AJwAtETgBe0iJ0AgDL6hE4AXiFyAnAa1qETgBgGT0CJwAXEDkBuESL0AkAzKtH4ATgQiInAJdqEToBgHn0CJwAXEHkBOAaLUInADCtHoETgCuJnABcq0XoBACm0SNwAnADkROAW7QInQDAWD0CJwA3EjkBuFWL0AkAjNEjcAJwB5ETgHu0CJ0AwH16BE4A7iRyAnCvFqETALhNj8AJwAAiJwAjtAidAMB1egROAAYROQEYpUXoBAAu0yNwAjCQyAnASC1CJwDwsh6BE4DBRE4ARmsROgGAp/UInABMQOQEYAotQicA8K0egROAiYicAEylRegEAM56BE4AJiRyAjClFqETAI6uR+AEYGIiJwBTaxE6AeCoegROAGYgcgIwhxahEwCOpkfgBGAmIicAc2kROgHgKHoETgBmJHICMKcWoRMA9q5H4ARgZiInAHNrEToBYK96BE4AFiByArCEFqETAPamR+AEYCEiJwBLaRE6AWAvegROABYkcgKwpBahEwC2rkfgBGBhIicAS2sROgFgq3oETgBWQOQEYA1ahE4A2JoegROAlRA5AViLFqETALaiR+AEYEVETgDWpEXoBIC16xE4AVgZkROAtWkROgFgrXoETgBWSOQEYI1ahE4AWJsegROAlRI5AVirFqETANaiR+AEYMVETgDWrEXoBICl9QicAKycyAnA2rUInQCwlB6BE4ANEDkB2IIWoRMA5tYjcAKwESInAFvRInQCwFx6BE4ANkTkBGBLWoROAJhaj8AJwMaInABsTYvQCQBT6RE4AdggkROALWoROgFgtB6BE4CNEjkB2KoWoRMARukROAHYMJETgC1rEToB4F49AicAGydyArB1LUInANyqR+AEYAdETgD2oEXoBIBr9QicAOyEyAnAXrQInQBwqR6BE4AdETkB2JMWoRMAXtMjcAKwMyInAHvTInQCwHN6BE4AdkjkBGCPWoROAPhej8AJwE6JnADsVYvQCQAPegROAHZM5ARgz1qETgDoETgB2DmRE4C9axE6ATiuHoETgAMQOQE4ghahE4Dj6RE4ATgIkROAo2gROgE4jh6BE4ADETkBOJIWoROA/esROAE4GJETgKNpEToB2K8egROAAxI5ATiiFqETgP3pETgBOCiRE4CjahE6AdiPHoETgAMTOQE4shahE4Dt6xE4ATg4kROAo2sROgHYrh6BEwBETgCI0AnANvUInACQROQEgActQicA29EjcALAH0ROAPiqRegEYP16BE4A+IbICQDfahE6AVivHoETAH4gcgLAj1qETgDWp0fgBIAniZwA8LQWoROA9egROAHgWSInADyvRegEYHk9AicAvEjkBICXtQidACynR+AEgFeJnADwuhahE4D59QicAHARkRMALtMidAIwnx6BEwAuJnICwOVahE4AptcjcALAVUROALhOi9AJwHR6BE4AuJrICQDXaxE6ARivR+AEgJuInABwmxahE4BxegROALiZyAkAt2sROgG4X4/ACQB3ETkB4D4tQicAt+sROAHgbiInANyvRegE4Ho9AicADCFyAsAYLUInAJfrETgBYBiREwDGaRE6AXhdj8AJAEOJnAAwVovQCcDzegROABhO5ASA8VqETgB+1CNwAsAkRE4AmEaL0AnAVz0CJwBMRuQEgOm0CJ0ACJwAMDmREwCm1SJ0AhxZj8AJAJMTOQFgei1CJ8AR9QicADALkRMA5tEidAIcSY/ACQCzETkBYD4tQifAEfQInAAwK5ETAObVInQC7FmPwAkAsxM5AWB+LUInwB71CJwAsAiREwCW0SJ0AuxJj8AJAIsROQFgOS1CJ8Ae9AicALAokRMAltUidAJsWY/ACQCLEzkBYHktQifAFvUInACwCiInAKxDi9AJsCU9AicArIbICQDr0SJ0AmxBj8AJAKsicgLAurQInQBr1iNwAsDqiJwAsD4tQifAGvUInACwSiInAKxTi9AJsCY9AicArJbICQDr1SJ0AqxBj8AJAKsmcgLAurUInQBL6hE4AWD1RE4AWL8WoRNgCT0CJwBsgsgJANvQInQCzKlH4ASAzRA5AWA7WoROgDn0CJwAsCkiJwBsS4vQCTClHoETADZH5ASA7WkROgGm0CNwAsAmiZwAsE0tQifASD0CJwBslsgJANvVInQCjNAjcALApomcALBtLUInwD16BE4A2DyREwC2r0XoBLhFj8AJALsgcgLAPrQInQDX6BE4AWA3RE4A2I8WoRPgEj0CJwDsisgJAPvSInQCvKRH4ASA3RE5AWB/WoROgKf0CJwAsEsiJwDsU4vQCfBYj8AJALslcgLAfrUInQCJwAkAuydyAsC+tQidwLH1CJwAsHsiJwDsX4vQCRxTj8AJAIcgcgLAMbQIncCx9AicAHAYIicAHEeL0AkcQ4/ACQCHInICwLG0CJ3AvvUInABwOCInABxPi9AJ7FOPwAkAhyRyAsAxtQidwL70CJwAcFgiJwAcV4vQCexDj8AJAIcmcgLAsbUIncC29QicAHB4IicA0CJ0AtvUI3ACABE5AYCzFqET2JYegRMA+ELkBAAetAidwDb0CJwAwCMiJwDwWIvQCaxbj8AJAHxH5AQAvtcidALr1CNwAgBPEDkBgKe0CJ3AuvQInADAM0ROAOA5LUInsA49AicA8AKREwB4SYvQCSyrR+AEAF4hcgIAr2kROoFl9AicAMAFRE4A4BItQicwrx6BEwC4kMgJAFyqRegE5tEjcAIAVxA5AYBrtAidwLR6BE4A4EoiJwBwrRahE5hGj8AJANxA5AQAbtEidAJj9QicAMCNRE4A4FYtQicwRo/ACQDcQeQEAO7RInQC9+kROAGAO4mcAMC9WoRO4DY9AicAMIDICQCM0CJ0AtfpETgBgEFETgBglBahE7hMj8AJAAwkcgIAI7UIncDLegROAGAwkRMAGK1F6ASe1iNwAgATEDkBgCm0CJ3At3oETgBgIiInADCVFqETOOsROAGACYmcAMCUWoROOLoegRMAmJjICQBMrUXohKPqETgBgBmInADAHFqETjiaHoETAJiJyAkAzKVF6ISj6BE4AYAZiZwAwJxahE7Yux6BEwCYmcgJAMytReiEveoROAGABYicAMASWoRO2JsegRMAWIjICQAspUXohL3oETgBgAWJnADAklqETti6HoETAFiYyAkALK1F6ISt6hE4AYAVEDkBgDVoETpha3oETgBgJUROAGAtWoRO2IoegRMAWBGREwBYkxahE9auR+AEAFZG5AQA1qZF6IS16hE4AYAVEjkBgDVqETphbXoETgBgpUROAGCtWoROWIsegRMAWDGREwBYsxahE5bWI3ACACsncgIAa9cidMJSegROAGADRE4AYAtahE6YW4/ACQBshMgJAGxFi9AJc+kROAGADRE5AYAtaRE6YWo9AicAsDEiJwCwNS1CJ0ylR+AEADZI5AQAtqhF6ITRegROAGCjRE4AYKtahE4YpUfgBAA2TOQEALasReiEe/UInADAxomcAMDWtQidcKsegRMA2AGREwDYgxahE67VI3ACADshcgIAe9EidMKlegROAGBHRE4AYE9ahE54TY/ACQDsjMgJAOxNi9AJz+kROAGAHRI5AYA9ahE64Xs9AicAsFMiJwCwVy1CJzzoETgBgB0TOQGAPWsROqFH4AQAdk7kBAD2rkXo5Lh6BE4A4ABETgDgCFqETo6nR+AEAA5C5AQAjqJF6OQ4egROAOBARE4A4EhahE72r0fgBAAORuQEAI6mRehkv3oETgDggEROAOCIWoRO9qdH4AQADkrkBACOqkXoZD96BE4A4MBETgDgyFqETravR+AEAA5O5AQAjq5F6GS7egROAACREwAgQifb1CNwAgAkETkBAB60CJ1sR4/ACQDwB5ETAOCrFqGT9esROAEAviFyAgB8q0XoZL16BE4AgB+InAAAP2oROlmfHoETAOBJIicAwNNahE7Wo0fgBAB4lsgJAPC8FqGT5fUInAAALxI5AQBe1iJ0spwegRMA4FUiJwDA61qETubXI3ACAFxE5AQAuEyL0Ml8egROAICLiZwAAJdrETqZXo/ACQBwFZETAOA6LUIn0+kROAEAriZyAgBcr0XoZLwegRMA4CYiJwDAbVqETsbpETgBAG4mcgIA3K5F6OR+PQInAMBdRE4AgPu0CJ3crkfgBAC4m8gJAHC/FqGT6/UInAAAQ4icAABjtAidXK5H4AQAGEbkBAAYp0Xo5HU9AicAwFAiJwDAWC1CJ8/rETgBAIYTOQEAxmsRsvhRj/8uAACm8fnz53z+/HnpwwAA2KOS5Lckn83h57ckbwMAwFB/tE2REwBgUiXJ+ywf2cxy82vO/x0AADCYyAkAMK9fsnxsM/PP+wAAMBmREwBgfj8l+ZTlw5uZZ04BAGBSIicAwDLexn069z6fktQAADA5kRMAYDklyV+yfIwz4+fXuP8mAMBsRE4AgOX9FNvX9zS/BACAWYmcAADrUHJe/bd0oDO3z8fYng4AsAiREwBgXX6OVZ1bnL/E9nQAgMWInAAA6/M2yd+yfLgzr8/HJO+e+pcIAMB8RE4AgPX6KeeItnTIM0/PL8/9iwMAYF4iJwDAupWcY9qnLB/1zHl+zXm1LQAAKyFyAgBsw9sk77N84DvyfIyt6QAAqyRyAgBsS42nsC8RN0+v/6sBAGApIicAwDa9i9gpbgIAkETkBADYunfxJHZxEwDg4EROAIB9eJvzPTs/ZflIuNX5LeImAMAmiZwAAPtSkvyc82rEpaPhVuZ9PFAIAGDTRE4AgP16F6s7n5vfco7B5ba/WgAA1kTkBADYv5LzNuy/Zfm4uOR8TPKXnJ9QDwDAjoicAADHUvI1eH7K8uFR2AQA4G4PbfPNQ+B88+bNwocEAMCMfkryrzlvba9LHsggPcmHJP+Z5D+S/L7coQAAMJc/2qbICQBweCXn2PmvOQfPd8sdysV+T9JyjpofvrwGAOBgRE4AAF5Sv8zbnOPn2y+zhJZz1Px7vgbNvtCxAACwIiInAAC3qDmv/Hz49Z/ybfx8d8XX6vl2BeZ/fvn19+8GAACe9EPkBAAAAADYon9Y+gAAAAAAAO7x/wPnxlhudGFs3wAAAABJRU5ErkJggg==");
            background-repeat: no-repeat, repeat;
            background-position: right .7em top 50%, 0 0;
            background-size: .65em auto, 100%;

        }

        table td:nth-child(1) {
            max-width: 120px;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-break: break-all;
            overflow: hidden;
        }

        table td:nth-child(4) {
            max-width: 120px;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-break: break-all;
            overflow: hidden;
        }

        .table-container {
            display: flex;
            margin-bottom: 40px;
            margin-top: 22px;
        }

        .video_menu {
            width: 70%;
            padding-left: 50px;
            padding-right: 15px;
        }

        .subject_menu {
            width: 30%;
            padding-left: 15px;
            padding-right: 50px;

        }

        @media (max-width: 1000px) {
            .table-container {
                display: flex;
                flex-direction: column;
            }

            .video_menu {
                width: 100%;
                margin-bottom: 5px;
                padding: 0px 30px;
            }

            .subject_menu {
                width: 100%;
                margin-top: 30px;
                padding: 0px 30px;
                /*  border-top:1px solid black; */
                /*  margin-top:50px; */
            }
        }

        .dataTables_scrollHeadInner {
            width: 100% !important;
        }

        .dataTables_scrollHeadInner table {
            width: 100% !important;
        }

        .dataTables_scrollBody::-webkit-scrollbar-track {
            /*     -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); */
            background-color: #F5F5F5;
            /*  border-radius: 10px; */


            /*  margin-top:-46px; */
        }

        .dataTables_scrollBody::-webkit-scrollbar {
            width: 6px;
            background-color: #F5F5F5;

        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb {
            background-color: #777;
            /*   border-radius: 10px; */
        }


th {
  /*   background-color: rgb(36, 150, 62);
    color:white; */
}

        th:first-child {

            border-left: 1px solid #dddddd;
        }

        th:last-child {

            border-right: 1px solid #dddddd;
        }

        td:first-child {

            border-left: 1px solid black;
        }

        td:last-child {

            border-right: 1px solid #dddddd;
        }


        #video_add_button {

            margin-right: 10px;
            width: 150px;

        }

        #subject_add_button {
            margin-right: 10px;
            width: 150px;
            margin-bottom: 5px;
            padding-bottom: 5px;
        }

        #subject_add_button {
            margin-right: 10px;
            margin-bottom: 5px;
            padding-bottom: 5px;
            width: 150px;
        }

        @media (max-width: 500px) {
            #video_add_button {


                width: 200px;

            }

            #subject_add_button {

                width: 200px;
            }
        }

        @media (min-width: 1000px) {
           
            #subject_add_button {

                width: 195px;
            }
        }

        .searchbarh {
            visibility: hidden
        }


        .content {}

        .content-row {
            display: flex;
            flex-direction: row;
            /*     border-left:1px gray solid;
            border-right:1px gray solid;
            border-top:1px gray solid; */
            /*  background-color:white;
            padding-top:6px;
            padding-bottom:10px;
            margin-bottom:-10px; */
        }

        /* .table-text {
            padding-top:6px;
            padding-bottom:8px;
        font-weight: 800;
        padding-left:25px;
        
       }
       .searchbar {
        margin: 0 25px;
       }
       .searchbutton {
           margin-right:25px;
       } */

        .modal-footerr-image {
            margin: 15px;
        }
        button .fa-plus {
            padding-right:1px;
            font-size:13px;
            /* margin-top: -20px; */
        }
        .alert {
            margin-bottom:29px;
           
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


                <div class="nav-item left "> <a href="home" class="btn btn-light"> <i
                            class="fas fa-house-user"></i>Home</a></div>
                <div class="nav-item right "> <a href="logout" class="btn btn-light"> <i
                            class="fas fa-sign-out-alt"></i>Logout</a></div>
            </ul>
        </div>
    </nav>


    <!-- Jumbotron -->
    <div class="background-image ">
        <div class="jumbotron d-flex align-items-center text-center">
            <div class="container">
                <h1 class="jumbotron-heading"><?php  echo $fetch['classname']?><a data-toggle="modal"
                        data-backdrop="static" data-keyboard="false" data-target="#change_code_modal"><i
                            class="fas fa-edit" aria-hidden="true"></i></a>
                </h1>
            </div>
            <div class="jumbotron-upload text-right"><a data-toggle="modal" data-backdrop="static" data-keyboard="false"
                    data-target="#upload_image_modal">
                    <i class="fas fa-image" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>


    <!-- <div class="menu-buttons ">
        <button type="button" class="btn btn-secondary" id="video_button">Video</button>
        <button type="button" class="btn btn-secondary" id="subject_button">Subject</button>
    </div> -->

    <div class="table-container">
        <div class="video_menu" id="video_menu">

            <div class="content">

                <div class="content-row">

                    <button type="button" id="video_add_button" data-toggle="modal" data-backdrop="static"
                        data-keyboard="false" data-target="#video_modal" class="btn btn-secondary searchbutton"><i
                            class="fas fa-plus"></i> Video</button>
                    <input type="seach" class="form-control searchbar" id="inputSearch" placeholder="Search for Title">
                </div>


                <table id="video_table" class="table dt-responsive nowrap  hover" style="width:100%">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Lesson</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th class="dipnone">Link</th>
                            <th>Code</th>
                            <th></th>
                            <th class="table-delete"></th>
                        </tr>
                    </thead>
                </table>

                <div>

                </div>
            </div>


            <div id="video_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="video_modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered px-3" role="document">
                    <div class="modal-content">
                        <form method="post" id="video_form" enctype="multipart/form-data">
                            <div class="modal-header">
                                <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                <h4 class="modal-title mx-auto">Add Video</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Title</label>

                                    <input type="text" name="titles" id="titles" class="form-control"
                                        placeholder="Title" required />

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
                                            <span class="fa fa-calendar input-group-text"
                                                style="padding-top:9px;"></span>
                                        </span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Link </label>
                                
                                    <input type="url" name="links" id="links" class="form-control"
                                        placeholder="https://drive.google.com/file/d/link/preview" required />

                                </div>
                                <input type="hidden" name="linkcode" id="linkcode" value="<?php  echo $varivari?>"
                                    class="form-control" />
                                <div class="modal-footerr text-right">
                                    <input type="hidden" name="video_id" id="video_id" />
                                    <input type="hidden" name="video_operation" id="video_operation" />
                                    <input type="submit" name="video_action" id="video_action" class="btn btn-primary"
                                        value="Add" />
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="subject_menu " id="subject_menu">
            <div class="content">
                <div class="content-row">

                    <button type="button" id="subject_add_button" data-toggle="modal" data-backdrop="static"
                        data-keyboard="false" data-target="#subject_modal" class="btn btn-secondary my-0  ">
                        <i class="fas fa-plus"></i> Subject</button>
                    <input type="seach" class="form-control searchbarh" id="inputSearch" placeholder="Search for Title">
                </div>

                <table id="subject_table" class="table dt-responsive nowrap hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Code</th>
                            <th></th>
                            <th width="0%"></th>
                        </tr>
                    </thead>
                </table>

                <div>

                </div>
            </div>

            <div id="subject_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="subject_modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered px-3">
                    <div class="modal-content">
                        <form method="post" id="subject_form" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title mx-auto">Add Subject</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Subject</label>

                                    <input type="text" name="subjects" id="subjects" class="form-control" />

                                    <input type="hidden" name="subjectcode" id="subjectcode"
                                        value="<?php  echo $varivari?>" class="form-control" />
                                </div>
                                <div class="modal-footerr text-right">
                                    <input type="hidden" name="subject_id" id="subject_id" />
                                    <input type="hidden" name="subject_operation" id="subject_operation" />
                                    <input type="submit" name="subject_action" id="subject_action"
                                        class="btn btn-primary" value="Add" />
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Code Modal -->
  

    <div class="name-modal">
        <div class="modal fade" id="change_code_modal" tabindex="-1" role="dialog"
            aria-labelledby="change_code_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-min px-3" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title mx-auto">Change Name</h5>
                    </div>

                    <div class="modal-body  text-center">
                        <form action="admin.php" method="get">
                            <div class="form-group ">
                                <input type="hidden" value="<?php  echo $fetch['id']  ?>" name="id">
                                <input type="hidden" value="<?php  echo $varivari?>" name="varivari">
                                <input class="form-control" type="text" name="change-name" required
                                    value="<?php  echo $fetch['classname']  ?>">
                            </div>
                        </form>

                        <div class="modal-footerr text-right">
<input type="submit" class="btn btn-primary" name="check-name" value="Change">
                                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
                        </div>
                    </div>
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
                    <div class="modal-body  ">

                        <?php 
                if(isset($_SESSION['info-image'])){
                ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info-image']; ?>
                        </div>
                        <?php
                }
                ?>
                        <?php
                if(count($errors) > 0){
                ?>
                        <div class="alert alert-danger text-center ">
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
                } unset($_SESSION["info-image"])
                ?>
                        <!--  <div class="label-notes-in">Please use a png image less than 100kb (Image will automatically fit) -->
                        <form id="deleteForm" action="admin" method="post" enctype="multipart/form-data">
                        </form>
                        <form action="admin" method="post" enctype="multipart/form-data">
                            <input type="file" id="image" name="image" style="display: none;"
                                onchange="document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])">




                            <div class="imageContainer">
                                <div class="imageCenterer">
                                    <img id="image-preview" />
                                </div>
                            </div>

                            <div class="in-image">
                                <input type="button" class=" browse btn btn-secondary mx-1" id="browse"value="Browse"
                                    onclick="document.getElementById('image').click();" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Only use gmail account" />
                                <button type="submit" class="btn btn-primary btn-icon mr-2" name="upload-image" id="btn"
                                    value="Upload"   > <i class="fas fa-upload"></i> </button>

                            </div>



                    </div>
                    <div class="modal-footerr modal-footerr-image text-right ">


                        <input type="submit" form="deleteForm" class="btn btn-primary" name="remove-image"
                            value="Remove" onclick="return confirm('Are you sure?');">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <footer class="page-footer">
        <div class="footer-text text-center py-2">
            <a href="https://github.com/Nydigorith/AraLink" target="_blank">Repository</a>
        </div>
    </footer>

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

                /*  $("#video_menu").show();
                         $("#subject_menu").hide(); */

                $("#subjects-select").change(function () {
                    $("#subjects").val($(this).val());
                });
                $('#date-picker').datetimepicker({
                    format: 'MMMM DD, YYYY'
                });


                $(document).ready(function () {
                    $('#browse').popover();
                    $("#video_button").on('click', function () {
                        /*  sessionStorage.setItem("btnActive", "video_menu");
                         window.location.reload(); */



                        /*   $("#video_menu").show();
                          $("#subject_menu").hide(); */
                    });


                    $("#subject_button").on("click", function () {
                        /* sessionStorage.setItem("btnActive", "subject_menu");
                        window.location.reload(); */



                        /*   $("#video_menu").hide();
                          $("#subject_menu").show(); */
                    });

                    /*  let sessionState = sessionStorage.getItem("btnActive");

                     if (sessionState !== null) {
                         if (sessionState == "video_menu") {
                             $("#video_menu").show();
                             $("#subject_menu").hide();

                         } else {
                             $("#video_menu").hide();
                             $("#subject_menu").show();

                         }
                     } else {
                         $("#video_menu").show();
                         $("#subject_menu").hide();

                     } */
                    $('#video_add_button').click(function () {
                        $('#video_form')[0].reset();
                        $('.modal-title').text("Add Video");
                        $('#video_action').val("Add");
                        $('#video_operation').val("Add");
                    });
                    var dataTable = $('#video_table').DataTable({

                        "paging": false,
                        "ordering": false,
                        "processing": false,
                        "scrollY": "368px",
                        "scrollX": "1000px",
                        "scrollCollapse": true,
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
                                "targets": [4],
                                'createdCell': function (td) {
                                    $(td).addClass('dipnone');

                                    // $(td).parent('tr').attr('data-id', rowData[0]); // adds the data attribute to the parent this cell row
                                }

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
                    $('#inputSearch').keyup(function () {
                        dataTable.search($(this).val()).draw();
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
                            url: "input-controller.php",
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
                            url: "vfetch.php",
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
                                url: "input-controller.php",
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
                        $('.modal-title').text("Add Subject");
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
                        "scrollY": "368px",
                        "scrollX": "1000px",
                        "scrollCollapse": true,
                        "order": [],
                        "info": false,
                        "ajax": {
                            url: "sfetch.php",
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
                            url: "input-controller.php",
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
                                url: "input-controller.php",
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

            <script>

            </script>
            </body>

</html>