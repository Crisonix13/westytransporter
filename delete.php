<?php

session_start();

$host="localhost";
$user="root";
$password= "";
$db="westyproject";

$data=mysqli_connect($host,$user,$password,$db);

if($_GET['ID'])
{ 
    $cliName=$_GET['ID'];

    $sql="DELETE FROM clientdata WHERE ID='$cliName' ";

    $result=mysqli_query($data,$sql);

    if($result)
    {
        $_SESSION['message']='Deleted Successfully';
        header("location:client.php");
    }
}

?>