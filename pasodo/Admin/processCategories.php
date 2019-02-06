<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("../include/sessions.php");
require_once("adminAuthentication.php");
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$catName = $_GET['catName'];
if (!$conn) {
    die('Could not connect: ' . mysqli_error($con));
} 
//check for client name
	$sql = "SELECT ID from category WHERE name = '$catName' ";
	$result = $conn->query($sql);
	$datarows = $result->fetch_assoc();
	$catID = $datarows["ID"];

$sql="SELECT * FROM client2 WHERE category_id = '$catID'";
$result = mysqli_query($conn,$sql);

echo "<div class=\"table-responsive\"> 
		<table class=\"table table-borderless table-dark\">
			<thead class=\"thead-light\">
				<th>ID NUMBER</th>
	    		<th>NAME</th>
	            <th>PHONE NUMBER</th>
	            <th>Date Added</th>
	            <th>Action</th>
			</thead>";
while($row = mysqli_fetch_array($result)) {
    echo "<tbody id=\"myTable\"> <tr>";  
	echo "<td>" . $row['clientID'] . "</td>";
    echo "<td>" . $row['firstName']." ". $row['lastName'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>" . $row['created_at'] . "</td>";
    echo "<td>" . 
    	"<a href=\"editClient.php?id=$row[ID]\"><span class=\"btn btn-info\">Edit</span></a>". 
    	"<a href=\"delete.php?id=$row[ID] \"><span class=\"btn btn-danger\">Delete</span></a>". 
    	"</td>";

    echo "</tr>";
    echo "</tbody>";
}
echo "</table>";
echo "</div>";
mysqli_close($conn);
?>
</body>
</html>

                            