<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<table>
		<thead>
			<th>Id</th>
			<th>Name</th>
			<th>Status</th>
			<th>Data</th>
		</thead>
		<tbody>

		 <?php foreach ($products as $item):?>
			 	<tr>
                <td><?= $item->id;?></td>
                <td><?= $item->name;?></td>
                <td><?= $item->status;?></td>
                <td><img src="<?=base_url();?><?= $item->imge ?>"></td>
                <td><?= $item->createdat;?></td>
                <td><a href="<?= base_url('Usercontroller/selectedid/');?><?= $item->id;?>">Edit</a></td>
                <td><a href="<?= base_url('Usercontroller/deleteitem/');?><?= $item->id;?>">Delete</a></td>
                </tr>
        <?php endforeach;?> 

        
		</tbody>
	</table>
</body>
</html>