<?php include('header.php');
if(isset($_SESSION) && $_SESSION['status']==0){

}else{
 echo 'You are on wrong page!';
 die();
}
 $muid=$_SESSION['user_id'];

$sql2 = "SELECT * FROM tbl_slot WHERE user_id='$muid' ORDER BY slot_id DESC";
                            $result2 = $conn->query($sql2);
 ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <br>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notification List</h1>

    </div>

    <br>
    <div class="row">

        <div class="col-lg-12">


            <table class="table">
                <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Time</th>

                    <th>Action</th>
                </tr>
                <?php 
if ($result2->num_rows > 0) {
    $i=1;
                while($row = $result2->fetch_assoc()) {
                    
                    ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['slotdate'] ?></td>
                    <td><?php echo $row['slottime'] ?></td>

                    <td>
                        <?php if($row['status'] == 2){
                echo 'Approve';
              }else if($row['status'] == 1){
               
               echo 'Approval Pending';
                
              }else{
                echo '';
              } ?>
                    </td>

                </tr>
                <?php
                }
            }
                ?>
            </table>



        </div>



    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include('footer.php') ?>