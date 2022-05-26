<?php include('header.php');
  if(isset($_SESSION) && $_SESSION['status']==1){

}else{
 echo 'You are on wrong page!';
 die();
}
$sql2 = "SELECT * FROM tbl_slot WHERE user_id!='-1' AND authorid=".$_SESSION['user_id']." ORDER BY slot_id DESC";
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
                    <th>User</th>
                    <th>Action</th>
                </tr>
                <?php 
if ($result2->num_rows > 0) {
    $i=1;
                while($row = $result2->fetch_assoc()) {
                    $uid=$row["user_id"];
                    $record = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id='$uid'");

        
            $n = mysqli_fetch_array($record);
                    ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['slotdate'] ?></td>
                    <td><?php echo $row['slottime'] ?></td>
                    <td><?php echo $n['fname'] ?></td>
                    <td>
                        <?php if($row['status'] == 2){
                echo 'Approve';
              }else{
                ?>
                        <button onclick="updatebookslot(<?= $row['slot_id'] ?>,<?= $row['user_id'] ?>)">Approve</button>
                        <?php
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