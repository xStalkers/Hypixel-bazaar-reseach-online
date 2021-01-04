<head>

	<title> Hypixel Bazaar Reseach Online </title>
	<link rel="stylesheet" href="style-bazaar.css">
	<meta charset="utf-8" />

</head>

<body>

	<form action="bazaar.php" method="POST">

		<input type="text" name="keyAPI" id="keyAPI" placeholder="Enter your API key here">

		<select name="selectItem">

			<option value="">-- Please select an item --</option>
			<?php
				
				$jsonItem = file_get_contents('https://api.hypixel.net/skyblock/bazaar');
				$dataItem = json_decode($jsonItem);

				foreach ($dataItem->products as $key => $value) {
					echo "<option value='$key'>$key</option>";
				}

			?>

		</select>

		<button type="submit">Validate</button>

	<form>

</body>

<?php

	if (isset($_POST['keyAPI']) && isset($_POST['selectItem'])) {

		$key=$_POST['keyAPI'];
	        $item=$_POST['selectItem'];

        	$json = file_get_contents('https://api.hypixel.net/skyblock/bazaar/product?key='. $key .'&productId='. $item);
        	$data = json_decode($json);

		echo "<table>";
		echo "<caption>Item : {$item}</caption>";
		echo "<tr><th>Buy price</th><th>Sell price</th></tr>";
		echo "<tr><td>{$data->product_info->quick_status->buyPrice}</td><td>{$data->product_info->quick_status->sellPrice}</td></tr>";
		echo "</table>";

	}

?>

