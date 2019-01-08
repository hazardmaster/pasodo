<?php 
	if(isset($_POST["submit"])){
		$value = $_POST["value"];
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action="" method="post" onsubmit="return confirmSubmit(this)">
 	<input type="number" name="value">
 	<input type="submit" name="submit">	
 	</form>
 	
 	<p id="displayValue"></p>

 	<script type="text/javascript">
 		function confirmSubmit(){
 			return confirm('Do you really want to submit?');
 		}
 		var value = "<?php echo $value ?>";
 		document.getElementById("displayValue").innerHTML = value;
 	</script>
 </body>
 </html>
	<p></p>
