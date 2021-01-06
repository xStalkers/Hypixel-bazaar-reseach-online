<!DOCTYPE html>
<html>

	<head>

		<title> Hypixel Bazaar Reseach Online </title>
		<link rel="stylesheet" href="style-bazaar.css">
		<meta charset="utf-8" />

	</head>

	<body>

		<div class="form-body">
		
			<form action="bazaar.php" method="POST">
					
				<input type="text" name="keyAPI" maxlength="36" size="50" id="keyAPI" class="form-input-text" placeholder="Enter your API key here" required="required">

				<select name="selectItem" class="form-select">

					<option value="">-- Please select an item --</option>
					<?php
							
						$jsonItem = file_get_contents('https://api.hypixel.net/skyblock/bazaar');
						$dataItem = json_decode($jsonItem);

						foreach ($dataItem->products as $key => $value) {
							echo "<option value='$key'>$key</option>";
						}

					?>

				</select>
					
				<button type="submit" class="form-button-submit">Validate</button>

			<form>
			
		</div>
		
		<?php 
			
			if (isset($_POST['keyAPI']) && empty($_POST['selectItem'])) {
				echo "<p class='p-error'>Warning, you did not select an item.</p>";
			} else if (isset($_POST['keyAPI']) && isset($_POST['selectItem'])) {
				
				$key=$_POST['keyAPI'];
				$item=$_POST['selectItem'];

				$json = file_get_contents('https://api.hypixel.net/skyblock/bazaar/product?key='. $key .'&productId='. $item);
				$data = json_decode($json);

				if (!$data->success) {
					echo "<p class='p-error'>Warning, the API key entered is not valid.</p>";
				} else {
					echo "<div class='table-select'>";
					echo "<table class='table-select-table'>";
					echo "<caption class='caption-title'>Item : {$item}</caption>";
					echo "<tr><th>Buy price</th><th>Sell price</th></tr>";
					echo "<tr><td>{$data->product_info->quick_status->buyPrice}</td><td>{$data->product_info->quick_status->sellPrice}</td></tr>";
					echo "</table>";
					echo "</div>";	
				}
			}
		 
		?>

	</body>

	<footer>
		
		<p class="p-footer"><a href="https://github.com/xStalkers/Hypixel-bazaar-reseach-online">Github</a> | <a href="https://twitter.com/xstalkers_">Twitter</a></p>

	</footer>

</html>

