<?php

require_once('database.php');

$res = $database->reads();
?>

   
<?php
require_once('header.php');
?>
 <div class="container-fluid">
  <a href="add.php" class="btn btn-primary">Add Subject</a>
    			
	<div class="row">
		<table class="table">
			<tr>
				
				<th>Subject Name</th>
				<th>Class</th>
				<th>Extras</th>
			</tr>
			<?php 
			while($r = mysqli_fetch_assoc($res)){
			?>
			<tr>
				
				<td><?php echo $r['subject_name']; ?></td>
				<td><?php echo $r['class_name']; ?></td>
				<td><a href="update.php?id=<?php echo $r['subject_id']; ?>">Edit</a> <a href="delete.php?id=<?php echo $r['subject_id']; ?>">Delete</a></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<?php
require_once('footer.php');
?>