<?php include('conn.php');

$slotid=$_POST['slotid'];
$userid=$_POST['userid'];
$record = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id='$userid'");

        
$n = mysqli_fetch_array($record);
$record1 = mysqli_query($conn, "SELECT * FROM tbl_slot WHERE slot_id='$slotid'");

$n1 = mysqli_fetch_array($record1);
$note='Hi,'.$n['fname'].' book a slot of date '.$n1['slotdate'].' and time '.$n1['slottime'].'';
$sql = "INSERT INTO tbl_authernotification (note) VALUES ('".$note."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
    
    

    mysqli_query($conn, "UPDATE tbl_slot SET status=1, user_id='$userid' WHERE slot_id=$slotid");
  
            

 ?>