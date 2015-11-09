<?php
require 'vendor/autoload.php';
$rds = new Aws\Rds\RdsClient([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);
$result = $rds->describeDBInstances([
    'DBInstanceIdentifier' => 'mp1-rca',
]);
$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
print "============\n". $endpoint . "================\n";
$link = mysqli_connect($endpoint,"et-itmo-444","letmein","etdb") or die("Error " . mysqli_error($link)); 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
//conection: 
//echo "Hello world"; 
//echo "Here is the result: " . $link;
$sql = "CREATE TABLE User
(
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
uname Varchar(20),
email Varchar(20),
phone Varchar(20),
S3URL Varchar(20),
FS3URL Varchar(20),
jpgfilename Varchar(20),
state TinyInt(3),
date Timestamp 
date TIMESTAMP)";
if (mysqli_query($link, $sql)){
    echo "Table persons created successfully";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
