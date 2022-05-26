<?php include('conn.php');

$date=$_POST['slotdate'];
echo $date;

  
            $sql1 = "SELECT * FROM tbl_slot WHERE slotdate='$date'";
$result = $conn->query($sql1);
$html ='';
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($row['status'] == 0){
                        $myclass="btn btn-success";
                        $myonclick='onclick="bookslot('.$row['slot_id'].','.$_SESSION["user_id"].')"';
                    }else if($row['status'] == 1){
$myclass="btn btn-warning";
$myonclick='';
                    }else{
$myclass="btn btn-danger";
$myonclick='';
                    }
$html.='<span class="'.$myclass.'" '.$myonclick.'>'.$row['slottime'].'</span>&nbsp;';
                 } 
                 echo $html;
            }else{
 echo '<span class="btn btn-warning" >No Slot on this date!</span>';
            }

 ?>