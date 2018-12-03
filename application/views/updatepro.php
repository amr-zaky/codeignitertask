<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="<?= base_url('Productcontroller/update');?>">

			<input type="text" name="id" value="<?= $department->id?>" style="display:none;">
			<input type="text" name="name" placeholder="Name" value="<?= $department->name ?>">
			<br>
			<br>
			<select name="dep_id" >

				<?php foreach ($products as $item):?>
					<option value="<?= $item->id?>"><?= $item->name?></option>
				<?php endforeach;?> 
			</select>
			<br>
			<br>
			<select name="status">
					<option value="1">Active</option>
					<option value="0">Deactive</option>
			</select>
			<br>
			<br>
			<input type="text" name="price" value="<?= $department->price ?>"  placeholder="Price" >
			<br>
			<br>

			<input type="date" value="<?= $department->createdat ?>"  name="date">
			<br>
			<br>
			<button type="submit" name="submit">Edit</button>
	</form>


</body>
</html>