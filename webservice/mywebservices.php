<?php
// Create connection
$conn = new mysqli("localhost","root","","belajar");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Storing the received JSON in $json.
$json = file_get_contents('php://input');
 
// Decode the received JSON and store into $obj
$obj = json_decode($json,true);

$tanda=$obj['tanda'];
$iddata=$obj['iddata'];
$name=$obj['name'];
$email=$obj['email'];
$age=$obj['age'];


if($tanda=='3')
{  
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
 }
else
{
if($tanda=="0")   //ok
{
  $sql = "INSERT INTO Users (name, email, age) VALUES ('$name','$email','$age')";
  $MSG = "New record created successfully".$sql;
}
if($tanda=="1")  //ok
{
  $sql = "UPDATE Users SET name='$name', email='$email', age='$age' WHERE id='$iddata'";
  $MSG = "record has been updated successfully".$sql;
 // echo " testing";
}
if($tanda=="2") //ok
{   
  $sql= "DELETE FROM Users WHERE id=\"$iddata\"";
  $MSG = "record has been deleted successfully".$sql;

}

  if ($conn->query($sql)==TRUE) {
    // Converting the message into JSON format.
  	$json = json_encode($MSG);
  	 
  	// Echo the message.
  	 echo $json ;
  } else {   /// jika error
  $MSG =  "Error: " . $sql . "<br>" . $conn->error;
	$json = json_encode($MSG);
	 
	// Echo the message.
	 echo $json ;
  }

}


$conn->close();
?>

