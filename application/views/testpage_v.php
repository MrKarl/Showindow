<html>
<head></head>
<body>
	<?php 
		// $data = json_decode($data);

		// var_dump($data); echo "<br/>";

		// echo "userid = ".$data->userid;
		// echo "<br/>";
		// echo "<br/>";
	
		foreach($data as $element){
			echo "item = ".$element['item']."<br/>";
			echo "item rating = ".$element['rating']."<br/>";
			echo "<br/>";
		}

	
		



	?>
	<br/>
</body>
</html>