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
			<th>Imgs</th>
		</thead>
		<tbody>

		 <?php foreach ($products as $item):?>
			 	<tr>
                <td><?= $item->id;?></td>
                <td><?= $item->name;?></td>
                <td id="<?= $item->id;?>"><?php if($item->status ==0) echo "Deactive"; else {echo "Active";} ?></td>
                <td><?= $item->createdat;?></td>
                <?php 
                		
                		$array = explode('*',$item->imgs);
                		$count=count($array);

                	?>
                	<?php foreach ($array as $img):?>

                <td> 
                	<?= $img?>

                </td>
                	<?php endforeach;?> 
                <td><a href="<?= base_url('Productcontroller/selectedid/');?><?= $item->id;?>">Edit</a></td>
                <td><a href="<?= base_url('Productcontroller/deleteitem/');?><?= $item->id;?>">Delete</a></td>

                <td>
                	<button onclick="Active(<?= $item->id;?>)">Active</button>
                </td>
                </tr>
        <?php endforeach;?> 

        
		</tbody>
	</table>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	<script>
		
		function Active(id) {
			$.ajax({
				type:"POST",
				url:"<?= base_url('Productcontroller/activechange/');?>",
				data:{id:id},
				success:function(data)
				{
					alert(data);
					$("#"+data).empty();
					$("#"+data).append("Active");
				},
				fail:function(data)
				{
					alert("Errors");
				}
			});
		}
	</script>
</body>
</html>