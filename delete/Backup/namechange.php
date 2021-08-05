
<?php  
include 'connection.php';

if( isset($_GET['changename']) ){
    $id = $_GET['id'];
    $varivari = = $_GET['varivari'];
    $subjectname = mysqli_real_escape_string($con, $_GET['subjectname']);
    $sql =("UPDATE classadmin SET classname = $subjectname WHERE id = $id ");
 
    $result = $con->query($sql);
}
?>