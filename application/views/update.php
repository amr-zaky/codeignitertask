<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php print_r($department); ?>
	<form method="POST" action="<?= base_url('Usercontroller/update');?>" enctype="multipart/form-data">


		 <input type="text" name="id" value="<?= $department->id ?>" style="display:none;">
		 <br>
		 <br>
		 <input type="text" name="name" value="<?= $department->name ?>" >
		 <br>
		 <br>
		 <input type="text" name="status" value="<?= $department->status ?>" >
		 <br>
		 <br>

		 <input type="file" name="img">
		 <br>
		 <br>


		 <input type="date" name="date" value="<?= $department->createdat ?>" >	
		 <br>
		 <br>
		 <button type="submit" name="submit">Edit</button>	
	</form>

</body>
</html>