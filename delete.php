<?php
    //get id
    $index = $_GET['index'];
    
    //fetch data from json
    $data = file_get_contents('member.json');
    $data = json_decode($data,true);
 
    //delete the row with the index
    unset($data[$index]);
 
    //encode back to json
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('member.json', $data);
 
    header('location: admin.php');
?>