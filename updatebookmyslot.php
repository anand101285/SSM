<?php include('conn.php');

$slotid=$_POST['slotid'];
$userid=$_POST['userid'];
$status=$_POST['status'];
$record = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id='$userid'");

        
            $n = mysqli_fetch_array($record);
            $record1 = mysqli_query($conn, "SELECT * FROM tbl_slot WHERE slot_id='$slotid'");

        
            $n1 = mysqli_fetch_array($record1);
if($status == 2){

$note='Hi,'.$n['fname'].' you book a slot of date '.$n1['slotdate'].' and time '.$n1['slottime'].' has been approve';
}else{
  $note='Hi,'.$n['fname'].' you book a slot of date '.$n1['slotdate'].' and time '.$n1['slottime'].' has been cancel';
}
$sql = "INSERT INTO tbl_studentnotification (note,userid) VALUES ('".$note."','".$userid."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
    
    
if($status == 2){
    mysqli_query($conn, "UPDATE tbl_slot SET status='$status'  WHERE slot_id=$slotid");
  
    }else{
      mysqli_query($conn, "UPDATE tbl_slot SET status='$status' , user_id='0' WHERE slot_id=$slotid");
    }        

 ?>