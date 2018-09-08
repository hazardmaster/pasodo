<select class="form-control" id="categoryselect" name="category">
    <?php 
        global $connection;
        $sql = "SELECT * FROM category ORDER BY datetime desc";
        $execute = mysqli_query($connection, $sql);
        while($Datarows=mysqli_fetch_array($execute)){
            $id = Datarows["id"];
            $categoryname = $datarows["name"];
    ?>
        <option><?php echo $categoryname?></option>
        
       <?php } ?>  
    

</select>

<!-- uploading a file-->
if(isset($_FILES["file"]["type"])){
$validextensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/JPG") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 10000000)//Approx. 100000=100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else{
    $target=$_FILES["image"]["name];
    $sourcepath = $FILES["image"]["tmp_name"];
    move_uploaded_file($sourcepath, $target;
    }
$responseBooked = $conn->query("SELECT bed FROM tbl_booked WHERE roomId='$roomiD' AND bed='$i'");