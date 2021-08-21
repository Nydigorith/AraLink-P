<!-- Videos -->
<div class="videos">
        <div class="container video-selection text-center">
            <div class="text-center">
                <div class="filter pb-4">
                    <form id="form1" method="POST">
                        <label class="filter-selection" value='ALL'>
                            <input class="radio-filter" onchange="this.form.submit();" type="radio" name="subject"
                                value="ALL">ALL</input>
                        </label>
                        <?php
                           
                            $query = $conn->prepare("SELECT * FROM classsubject WHERE subjectcode = :codihe");
                            $result  =  $query->execute([':codihe' => $codihe]);
                            echo "<style>.filter-selection[value='ALL']{background-color: yellow;}></style>"; 
                            if($result){
                                if($query->rowCount() > 0){
                                    while($row = $query->fetch(PDO::FETCH_BOTH)){
                        ?>
                        <label class="filter-selection" value='<?php echo $row['subjects'];?>'>
                            <input class="radio-filter" onchange="this.form.submit();" type="radio" name="subject"
                                value="<?php echo $row['subjects'];?>"
                                for=<?php echo $row['subjects'];?>><?php echo $row['subjects'];?> </input>
                        </label>
                        <?php
                                    }
                                } /* else {
                                        echo "Mr.Beast6000";
                                    } */
                            }
                                ?>
                        <input type="hidden" name="c" value="<?php echo $_GET['c']?>">
                    </form>
                </div>
            </div>
        </div>


        <div class="container video-show">
            <div class="row px-2">
                <?php
                    if(isset($_POST['subject'])) {
                        $subject = $_POST["subject"];
                        if ($subject == "ALL") {
                            $query = $conn->prepare("SELECT * FROM classvideo WHERE linkcode = :codihe");
                            $result  =  $query->execute([':codihe' => $codihe]);
                            echo "<style>.filter-selection[value='ALL']{background-color: yellow;}></style>"; 
                            if($result){
                                if($query->rowCount() > 0){
                                    while($row = $query->fetch(PDO::FETCH_BOTH)){
                        ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card mb-4 box-shadow ">
                        <iframe class="card-img-top" src="<?php echo $row['links'];?>" allowfullscreen="true"></iframe>
                        <div class="card-body">
                            <div class="card-subtitle text-muted"> <?php echo $row['subjects'];?></div>
                            <div class="card-title"> <?php echo $row['titles'];?></div>
                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                        </div>
                    </div>
                </div>
                <?php
                                    }  
                                } else {
                                    ?>
                <div class="error-text mx-auto">No video were found </div>
                <?php
                                } 
                            }
                        } else {
                            $query = $conn->prepare("SELECT * FROM classvideo WHERE subjects = :subject AND linkcode = :codihe");
                            $result  =  $query->execute([':subject' => $subject, ':codihe' => $codihe]);
                             echo "<style>.filter-selection[value='$subject']{background-color: yellow;}.filter-selection[value=ALL]{background-color: white;}</style>";   
                            if($result){
                                if($query->rowCount() > 0){
                                    while($row = $query->fetch(PDO::FETCH_BOTH)){                           
                    ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card mb-4 box-shadow">
                        <iframe class="card-img-top" src="<?php echo $row['links'];?>" allowfullscreen="true"></iframe>
                        <div class="card-body">
                            <div class="card-subtitle text-muted"> <?php echo $row['subjects'];?></div>
                            <div class="card-title"> <?php echo $row['titles'];?></div>
                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                        </div>
                    </div>
                </div>
                <?php
                                     } 
                                } else {
                                    ?>
                <div class="error-text mx-auto">No video for <?php echo $subject;?> </div>
                <?php
                                }
                            }
                        }
                    }
                     else {
                        $query = $conn->prepare("SELECT * FROM classvideo WHERE linkcode = :codihe");
                        $result  =  $query->execute([':codihe' => $codihe]);
                        if($result){
                            if($query->rowCount() > 0){
                                while($row = $query->fetch(PDO::FETCH_BOTH)){
                                    ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card mb-4 box-shadow">
                        <iframe class="card-img-top" src="<?php echo $row['links'];?>" allowfullscreen="true"></iframe>
                        <div class="card-body">
                            <div class="card-subtitle text-muted"> <?php echo $row['subjects'];?></div>
                            <div class="card-title"> <?php echo $row['titles'];?></div>
                            <div class="card-subtitle text-muted"> <?php echo $row['dates'];?> </div>
                        </div>
                    </div>
                </div>
                <?php
                                }  
                            }else {
                                ?>
                <div class="error-text mx-auto">No video were found </div>
                <?php
                        }
                    }
                }
                            ?>
            </div>
        </div>
    </div>