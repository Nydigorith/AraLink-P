<!doctype html>
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<!-- <link rel="shortcut icon" href="favicon(1).ico"> -->
<title> | Home</title>
   

    <link rel="stylesheet" type="text/css" href="styles.css">
    






<!-- 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script> -->
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script> -->

	<!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
  <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    

<script src="js/pace.js"></script>
<link rel="stylesheet" href="css/pace-theme-minimal.css">



   
</head>

<body>
   <div class="content"> 
    <h1>Server Side Ajax CURD data table with Boostrap model</h1>                    
                <table id="video_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead >
                        <tr class="table-primary">
                           <th >ID</th><!-- width="10%" -->
                           <th >Course Name</th>  
                           <th>Number of Students</th>
                           <th >Course Name</th>  
                           <th >Number of Students</th>
                           <th >Number of Students</th>
                           <th scope="col" >Edit</th>
                           <th scope="col" >Delete</th>
                        </tr>
                    </thead>
                </table>
            </br>
                <div >
                    <button type="button" id="video_add_button" data-toggle="modal" data-target="#video_modal" class="btn btn-success btn-lg">Add Course</button>
                </div>
   </div>               
<!--  </body>
 </html> -->


<div id="video_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="video_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Course</h4>
                </div>

                <div class="modal-body">
                <div class="form-group">
                    <label>titles</label>
                    <input type="text" name="titles" id="titles" class="form-control" />
                    <br />
                    </div>

                    <div class="form-group">
                    <label>subjects</label>
                    <input type="text" name="subjects" id="subjects" class="form-control" />
                    <br /> 
                    </div>
<!-- 
                    <label>dates</label>
                    <input type="text" name="dates" id="dates" class="form-control" />
                    <br /> -->


                    <div class="form-group">
                    <label>subjects</label>
								<div class='input-group date' id='date-picker'>
                                
									<input type="text" id="dates" name="dates" class="form-control" required>
									<span class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</span>
                                   <!--  <br /> -->
								</div>
							</div>


                            <div class="form-group">
                    <label>links</label>
                    <input type="text" name="links" id="links" class="form-control" />
                    <br /> 
                    </div>

                    <div class="form-group">
                    <label>linkcode</label>
                    <input type="text" name="linkcode" id="linkcode" class="form-control" />
                    <br /> 
                	</div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="video_id" id="video_id" />
                    <input type="hidden" name="video_operation" id="video_operation" />
                    <input type="submit" name="video_action" id="video_action" class="btn btn-primary" value="Add" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){

    $('#date-picker').datetimepicker({
                format: 'MM/DD/YYYY'
            });
          
    $('#video_add_button').click(function(){
        $('#video_form')[0].reset();
        $('.modal-title').text("Add Course Details");
        $('#video_action').val("Add");
        $('#video_operation').val("Add");
    });
    
    var dataTable = $('#video_table').DataTable({
        "paging":true,
        "ordering": false,
        "processing":true,
        "serverSide":true,
        "responsive": true,
        "aoColumnDefs": [{ "bVisible": false, "aTargets": [0,5] }],
        "pagingType": "numbers", /* simple_number */
        "order": [],
        "info":true,
  
    
        "ajax":{
            url:"fetch.php",
            type:"POST"
               },
        "columnDefs":[
            {
                "targets":[0,3,4],
                "orderable":false,
            },
        ],    
    });

    $(document).on('submit', '#video_form', function(event){
        event.preventDefault();
        var id = $('#id').val();
        var titles = $('#titles').val();
        var subjects = $('#subjects').val();
        var dates = $('#dates').val();
        var links = $('#links').val();
        var linkcode = $('#linkcode').val();
       
        
        if(titles != '' && dates != '')
        {
            $.ajax({
                url:"insert.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#video_form')[0].reset();
                    $('#video_modal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            alert("Course Name, Number of students Fields are Required");
        }
    });
    
    $(document).on('click', '.update', function(){
        var video_id = $(this).attr("id");
        $.ajax({
            url:"fetch_single.php",
            method:"POST",
            data:{video_id:video_id},
            dataType:"json",
            success:function(data)
            {
                $('#video_modal').modal('show');
                $('#id').val(data.id);

                $('#titles').val(data.titles);
                $('#subjects').val(data.subjects);
                $('#dates').val(data.dates);
                $('#links').val(data.links);
                $('#linkcode').val(data.linkcode);
               


                $('.modal-title').text("Edit Course Details");
                $('#video_id').val(video_id);
                $('#video_action').val("Save");
                $('#video_operation').val("Edit");
            }
        })
    });
    
    $(document).on('click', '.delete', function(){
        var video_id = $(this).attr("id");
        if(confirm("Are you sure you want to delete this user?"))
        {
            $.ajax({
                url:"insert.php",
                method:"POST",
                data:{video_id:video_id},
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

<!-- <script type="text/javascript">
        $(function() {
            $('#date-picker').datetimepicker({
                format: 'MM/DD/YYYY'
            });
        });
    </script> -->