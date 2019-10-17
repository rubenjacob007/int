<?php

require_once('database.php');

$res = $database->read_class();
?>


<?php
require_once('header.php');
?>

 <div class="container-fluid">
 <a href="add_class.php" class="btn btn-primary">Add Class</a>
    			</h1>
	<div class="row">
		<table class="table">
			<tr>
				
				<th>Class Name</th>	
				<th>Action </th>
			</tr>
			<?php 
			while($r = mysqli_fetch_assoc($res)){
			?>
			<tr>			
				<td><?php echo $r['class_name']; ?></td>
				<td><a href="update_class.php?id=<?php echo $r['class_id']; ?>">Edit</a> <a href="delete_class.php?id=<?php echo $r['class_id']; ?>">Delete</a></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>


<?php
require_once('footer.php');
?>