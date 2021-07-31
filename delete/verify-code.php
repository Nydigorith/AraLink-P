
<?php 
/* 
 $codihe = $_POST['codehe'];  */

 
 require "db.php";

$errors = array();




if(isset($_POST['gsubmit'])){
    $codihe = $_POST['c'];
   
   
   
  

        $query = $conn->prepare("SELECT * FROM classadmin WHERE classcode = :classcode");
        $query->execute([':classcode' => $codihe]);
   
       if($query->rowCount() > 0){

       /*  $codihe = $_POST['codehe'];  */
        header('location: homie?c='.$codihe);   

    } else {
        
        $errors['classcode'] = "Looks like bobo!";
       
         ?>
     <script type="text/javascript">
     var error = "trues";
			/* $(document).ready(function(){
				$("#exampleModal").modal("show");
			}); */
    </script> 
   
        <?php 

    }

}


 
   
    

?>