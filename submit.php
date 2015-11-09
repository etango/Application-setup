<?php
$error ="";
$uname = $_POST['uname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$allowed =  array('gif','png' ,'jpg');
$filename = $_FILES['file']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
function in_arrayi($needle, $haystack)
{
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
}
if(empty($uname) || empty($email) || empty($phone)){
        $error = "Field(s) are missing";
        header("Location: index.php?error=".$error);
}
elseif (!in_arrayi($ext,$allowed)){
        $error = "Image is in wrong format";
        header("Location: index.php?error=".$error);
}
else{
date_default_timezone_set('America/Chicago');
// Start the session
session_start();
echo $_POST['email'];
$uploaddir = '/tmp/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);
echo '<pre>';
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";
require 'vendor/autoload.php';
#use Aws\S3\S3Client;
#$client = S3Client::factory();
$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);
$bucket = uniqid("php-mh-",false);
//createing a bucket
$result = $s3->createBucket([
    'ACL' => 'public-read',
    'Bucket' => $bucket
]);
//wait until bucket exists
$s3->waitUntil('BucketExists',[
	'Bucket' => $bucket
]);
//uploading a file
$result = $s3->putObject([
    'ACL' => 'public-read',
    'Bucket' => $bucket,
   'Key' => $bucket,
   'SourceFile' => $uploadfile
]);  
$url = $result['ObjectURL'];
echo $url;
$rds = new Aws\Rds\RdsClient([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);
$result = $rds->describeDBInstances([
    'DBInstanceIdentifier' => 'mh-db'
]);
$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
    echo "============". $endpoint . "================";
	
//echo "begin database";
$link = mysqli_connect($endpoint,"et-itmo-444","letmein","et-db") or die("Error " . mysqli_error($link));
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
/* Prepared statement, stage 1: prepare */
if (!($stmt = $link->prepare("INSERT INTO users (uname, email,phone,S3url,FS3url,jpgfilename,state,date) VALUES (?,?,?,?,?,?,?,?)"))) {
    echo "Prepare failed: (" . $link->errno . ") " . $link->error;
}
$uname = $_POST['uname'];
$email = $_POST['email'];
$_SESSION["email"] = $email;
$phone  = $_POST['phone'];
$s3url = $url; //  $result['ObjectURL']; from above
$jpgfilename = basename($_FILES['file']['name']);
$state= "none";
$status =0;
$date = date("d M Y - h:i:s A");
$stmt->bind_param("ssssssis",$uname,$email,$phone,$s3url,$fs3url,$filename,$status,$date);
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
printf("%d Row inserted.\n", $stmt->affected_rows);
/* explicit close recommended */
$stmt->close();
$link->real_query("SELECT * FROM users");
$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {
    echo $row['id'] . " " . $row['uname'] . " " . $row['email']. " " . $row['phone'];
}
$link->close();
header("Location: gallery.php");
}
//add code to detect if subscribed to SNS topic 
//if not subscribed then subscribe the user and UPDATE the column in the database with a new value 0 to 1 so that then each time you don't have to resubscribe them
// add code to generate SQS Message with a value of the ID returned from the most recent inserted piece of work
//  Add code to update database to UPDATE status column to 1 (in progress)
?>