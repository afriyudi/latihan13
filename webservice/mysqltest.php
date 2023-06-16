<?php
// Create connection
$conn = new mysqli("localhost","root","","belajar");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


   
$sql= "SELECT * FROM users";
   $myArray = array();
   if ($result = $conn->query($sql)) {
       $tempArray = array();
       while ($row = $result->fetch_object()) {
           $tempArray = $row;
           array_push($myArray, $tempArray);
       }
       echo json_encode($myArray);
   }
   else {   // jika error
        $MSG =  "Error: " . $sql . "<br>" . $conn->error;
	    $json = json_encode($MSG);
	 
	   // Echo the message.
	   echo $json ; 
    }

$conn->close();
?>

