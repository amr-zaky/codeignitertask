<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="<?= base_url('Usercontroller/do_upload');?>" enctype="multipart/form-data">

			<input type="text" name="name">
			<br>
			<br>
			<input type="text" name="status">
			<br>
			<br>
			<input type="date" name="date">
			<br>
			<br>
			<input type="file" name="img">
			<br>
			<br>

			<button type="submit" name="submit">Add</button>
	</form>
</body>
</html>