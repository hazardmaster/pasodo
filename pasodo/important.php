<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "pasodo");

$result = $conn->query("SELECT clientID, firstName, lastName FROM client2");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"clientID":"'  . $rs["clientID"] . '",';
  $outp .= '"firstName":"'   . $rs["firstName"]        . '",';
  $outp .= '"lastName":"'. $rs["lastName"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>