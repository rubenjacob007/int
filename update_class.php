<?php
 require_once('database.php');
 
  
   
	
 $id = $_GET['id'];
 $res = $database->read_class($id);
 $r = mysqli_fetch_assoc($res);
 if(isset($_POST) & !empty($_POST)){
	 $class = $database->sanitize($_POST['class_name']);
	 

	$res = $database->update_class( $class, $id);
	if($res){
	 	 header("location:class.php");
	}else{
	 	echo "failed to update data";
	}
}
?>
<?php
require_once('header.php');
?>
 <div class="container-fluid">
	<div class="row">
<form method="post" class="form-horizontal col-md-6 col-md-offset-3" name="update">
	<h2>Update Class</h2>
 
    			
	<div class="form-group">
	    <label for="input1" class="col-sm-2 control-label">Class Name</label>
	    <div class="col-sm-10">
	      <input type="text" name="class_name"  class="form-control" id="input1" value="<?php echo $r['class_name'] ?>" placeholder="Subject Name" />
	    </div>
	</div>




	</div>
	<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Update" onclick="return(submitupdate());"/>
</form>
	</div>
</div>

  <script>
      function submitupdate() {
        var form = document.update;
        if (form.subject_name.value == "") {
          alert("Enter Class Name.");
          return false;
        }
      }
    </script>
<?php
require_once('footer.php');
?>