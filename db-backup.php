
<?php
include "db.php";




$query  = $conn->prepare("SELECT * INTO OUTFILE 'C:\...\tableName.sql'
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\r\n'
FROM classadmin;" );
            $query->execute();

          
?>
 
