<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="<?= base_url('Productcontroller/store');?>"  enctype="multipart/form-data">
			<input type="text" name="name" placeholder="Name">
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
			<input type="text" name="price" placeholder="Price">
			<br>
			<br>
			<input type="file" name="imgs[]" multiple>
			<br>
			<br>

			<input type="date" name="date">
			<br>
			<br>
			<button type="submit" name="submit">Add</button>
	</form>


</body>
</html>