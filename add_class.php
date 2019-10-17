<?php

 require_once('database.php');
 
 

 if(isset($_POST) & !empty($_POST)){
	 $class = $database->sanitize($_POST['class_name']);
	 $res = $database->create_class($class);
	 print_r( $res );
	 if($res){
	 	header("location:class.php");
	 }else{
	 	echo "failed to insert data";
	 }
}
?>
<?php
require_once('header.php');
?>
 <div class="container-fluid">

	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3" name="insert">
			<h2>Create Class</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Class Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="class_name"  class="form-control" id="input1" placeholder="Class Name" / required="required">
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
          alert("Enter Class Name.");
          return false;
        }
      }
    </script>
<?php
require_once('footer.php');
?>