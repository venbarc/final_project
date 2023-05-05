<?php

$conn = mysqli_connect('localhost', 'root', '', 'final_project');

if(!$conn)
{
    die("Connection failed: ". mysqli_connect_error());
}
else
{
    // echo "Successfully Connected !";
}
?>