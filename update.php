<?php
 require_once('database.php');
 
  
   
	
 $id = $_GET['id'];
 $res = $database->read($id);
 $r = mysqli_fetch_assoc($res);
 if(isset($_POST) & !empty($_POST)){
	 $subject = $database->sanitize($_POST['subject_name']);
	 $class = $database->sanitize($_POST['class_id']);
	 

	$res = $database->update($subject, $class, $id);
	if($res){
	 	 header("location:view.php");
	}else{
	 	echo "failed to update data";
	}
}
?>
<?php
require_once('header.php');
$classes = $database->read_class();
?>
 <div class="container-fluid">
	<div class="row">
<form method="post" class="form-horizontal col-md-6 col-md-offset-3" name="update">
	<h2>Update</h2>
 
    			
	<div class="form-group">
	    <label for="input1" class="col-sm-2 control-label">Subject Name</label>
	    <div class="col-sm-10">
	      <input type="text" name="subject_name"  class="form-control" id="input1" value="<?php echo $r['subject_name'] ?>" placeholder="Subject Name" />
	    </div>
	</div>



	<div class="form-group">
	<label for="input1" class="col-sm-2 control-label">Class</label>
	<div class="col-sm-10">
	

		<select name="class_id" class="form-control">
					<option>Select Your Class</option>
					<?php    foreach ($classes as $key => $class) {  ?>
						<option value="<?php echo $class['class_id'] ?>" <?php if($class['class_id'] ==$r['class_id']) {echo "selected";}?> > <?php echo $class['class_name']; ?> </option>
					<?php } ?>
				</select>


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
          alert("Enter Subject Name.");
          return false;
        } else if (form.class.value == "") {
          alert("Select Your Class Name.");
          return false;
        }
      }
    </script>
<?php
require_once('footer.php');
?>