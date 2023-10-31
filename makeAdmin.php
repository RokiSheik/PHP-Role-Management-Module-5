<?php
    //get id
    $index = $_GET['index'];
    //fetch data from json
    $data = file_get_contents('member.json');
    $data_array = json_decode($data,true);
 //delete the row with the index
    
  
     
    $data_array[$index]['Role'] = "Admin";
    //  var_dump($row['Role']);
    file_put_contents('member.json', json_encode($data_array, JSON_PRETTY_PRINT));
    // //encode back to json
    // $data = json_encode($row, JSON_PRETTY_PRINT);
    // file_put_contents('member.json', $data);
 
     header('location: admin.php');
?>