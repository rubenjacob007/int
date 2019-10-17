<?php

 require_once('database.php');
 
 
 if(isset($_POST) & !empty($_POST)){
	 $subject = $database->sanitize($_POST['subject_name']);
	 $class = $_POST['class'];

	 $res = $database->create($subject, $class);
	 if($res){
	 	echo "Successfully inserted data";
	 }else{
	 	echo "failed to insert data";
	 }
}
?>
<?php
require_once('header.php');
$classes = $database->read_class();
?>
 <div class="container-fluid">

	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3" name="insert">
			<h2>Create Subject</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Subject Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="subject_name"  class="form-control" id="input1" placeholder="Subject Name" / required="required">
			    </div>
			</div>

			<div class="form-group">
			<label for="input1" class="col-sm-2 control-label">Class</label>
			<div class="col-sm-10">
				<select name="class" class="form-control">
					<option>Select Your Class</option>
					<?php    foreach ($classes as $key => $class) {  ?>
						<option value="<?php echo $class['class_id'] ?>">  <?php echo $class['class_name'] ?> </option>
					<?php } ?>
				</select>
			</div>
			</div>
			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="submit" onclick="return(submitinsert());"/>
		</form>
	</div>
</div>

   <script>
      function submitinsert() {
        var form = document.insert;
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