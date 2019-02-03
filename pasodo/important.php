
<!DOCTYPE html>
<html>
<body>

<?php
$xml=simplexml_load_file("note.xml") or die("Error: Cannot create object");
    foreach($xml->children() as $books){
    echo $books->title."<br>";
    echo $books->author."<br>";
    echo $books->year."<br>";
    echo $books->price."<br>";
}
?>

</body>
</html
