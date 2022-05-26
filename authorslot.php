<?php include('header.php');
    

    function getSlots($conn)
    {
        $slots=[];
        $slots_query = "SELECT * FROM tbl_slot WHERE status=0 AND authorid=".$_SESSION['user_id'];
        $result = $conn->query($slots_query);
        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                  array_push($slots,$row);
             }
        }
        return $slots;

    }
    
function getSlotsPending($conn)
{
    $slots=[];
    $slots_query = "SELECT * FROM tbl_slot WHERE status=1 AND authorid=".$_SESSION['user_id'];
    $result = $conn->query($slots_query);
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
              array_push($slots,$row);
         }
    }
    return $slots;
}
 if(isset($_SESSION) && $_SESSION['status']==1){

     $slots = getSlots($conn);
     $slots_pending = getSlotsPending($conn);

     
}else{
 echo 'You are on wrong page!';
 die();
}
if (isset($_POST['submit'])) {
    $date=$_POST['date'];
    $time=$_POST['time'];

    $record = mysqli_query($conn, "SELECT * FROM tbl_slot WHERE slotdate='".$date."' AND slottime='".$time."' AND authorid='".$_SESSION["user_id"]."'");
            $n = mysqli_fetch_array($record);
            if (empty($n) ) {
    $sql = "INSERT INTO  tbl_slot (slotdate, slottime,authorid) VALUES ('".$_POST['date']."', '".$_POST['time']."','".$_SESSION['user_id']."')";

if ($conn->query($sql) === TRUE) {
  $msz= "Slot created successfully";
  $slots = getSlots($conn);
  $slots_pending = getSlotsPending($conn);

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
 }else{
     $msz= "Slot already in our system";
 }
}
 ?>

<style>
#calender th,
#calender td {
    padding: 10px;
    text-align: center;
    width: 100px;
    height: 30px;
    border: 1px solid black;

}

#calender {
    margin-top: 40px;
    margin-left: auto;
    margin-right: auto;
}

#calender td {
    cursor: pointer;
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <span class="text-info"><?= (isset($msz)?$msz:'') ?></span>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Slot</h1>
        <div class="row">
            <span>Slot Empty</span><button class="btn-success"></button>&nbsp;&nbsp;
            <span>Slot Bocked</span><button class="btn-danger"></button>&nbsp;&nbsp;
            <span>Slot Approval is pending</span><button class="btn-warning"></button>&nbsp;&nbsp;
        </div>
    </div>


    <div class="row">

        <div class="col-lg-12">

            <!-- Default Card Example -->
            <form action="" method="post" id="form_slot">
                <div class="form-group">
                    <label for="email">Date</label>
                    <input type="text" class="form-control datepicker" id="date_form" name="date" required=""
                        placeholder="Ex:2021-01-31" autocomplete="off" hidden>
                    <input class="form-control datepicker" id="chosen_date" type="text" onchange="choosedate();"
                        placeholder="Ex:2021-01-31" autocomplete="off">
                    <table border="1" id="calender">
                        <thead>
                            <tr>
                                <th colspan="8">
                                    <p id="date_month">Month</p>
                                    <p id="date_year">Year</p>
                                </th>
                            </tr>

                            <tr>
                                <th></th>
                                <th>Monday <br>
                                    <p id="day0"></p>
                                </th>
                                <th>Tuesday <br>
                                    <p id="day1"></p>
                                </th>
                                <th>Wednesday <br>
                                    <p id="day2"></p>
                                </th>
                                <th>Thursday <br>
                                    <p id="day3"></p>
                                </th>
                                <th>Friday <br>
                                    <p id="day4"></p>
                                </th>
                                <th>Saturday <br>
                                    <p id="day5"></p>
                                </th>
                                <th>Sunday <br>
                                    <p id="day6"></p>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="slot_data">

                        </tbody>

                    </table>
                </div>
                <div class="form-group" hidden>
                    <label for="pwd">Time:</label>
                    <select class="form-control" name="time" required="">
                        <option id="time" value="">Select Time</option>
                        <option>8 AM</option>
                        <option>9 AM</option>
                        <option>10 AM</option>
                        <option>11 AM</option>
                        <option>12 PM</option>
                        <option>1 PM</option>
                        <option>2 PM</option>
                        <option>3 PM</option>
                        <option>4 PM</option>
                        <option>5 PM</option>
                        <option>6 PM</option>
                        <option>7 PM</option>
                        <option>8 PM</option>
                        <option>9 PM</option>
                    </select>
                </div>

                <input type="submit" name="submit" id="submit_form" hidden>
            </form>

        </div>



    </div>
    <br>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
months = ["January", "Feburary", "March", "April", "May", "June", "July", "August", "September", "Octuber", "November",
    "December"
]
$(function() {
    $("#chosen_date").datepicker({
        changeMonth: true,
        changeYear: true
    });
});


function check_aval_slot(date, time) {

    var slots_free_in_db = <?php echo json_encode($slots); ?>;
    for (var i = 0; i < slots_free_in_db.length; i++) {

        dates = new Date(slots_free_in_db[i].slotdate);
        newdate = new Date(date.join("/"));
        var slot_date = slots_free_in_db[i].slotdate.split("/");

        if (dates.getTime() == newdate.getTime()) {
            if (time == slots_free_in_db[i].slottime) {
                return true;
            }
        }
    }
    return false;

}

function check_pending_slot(date, time) {

    var slots_free_in_db = <?php echo json_encode($slots_pending); ?>;
    for (var i = 0; i < slots_free_in_db.length; i++) {

        dates = new Date(slots_free_in_db[i].slotdate);
        newdate = new Date(date.join("/"));
        var slot_date = slots_free_in_db[i].slotdate.split("/");

        if (dates.getTime() == newdate.getTime()) {
            if (time == slots_free_in_db[i].slottime) {
                return true;
            }
        }
    }
    return false;

}

function create_row(week_arr) {
    $("#slot_data").empty();


    arr = ["8am", "9am", "10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm", "6pm", "7pm", "8pm"];

    for (var i = 0; i < arr.length; i++) {
        var row = ""
        row += "<tr>"
        row += "<td>" + arr[i] + "</td>"
        for (var j = 0; j < week_arr.length; j++) {
            if (i == 0) {
                $("#day" + j).text(week_arr[j].getDate())
            }

            var date = week_arr[j].toLocaleDateString().split("/");
            //changing of color here
            //viewing data and setting event


            if (check_aval_slot(date, arr[i])) {
                row += "<td name='" + arr[i] + "," + week_arr[j].toLocaleDateString() +
                    " ' class='btn-success'>";
            } else if (check_pending_slot(date, arr[i])) {
                row += "<td name='' class='btn-warning'>";
            } else {
                row += "<td name='" + arr[i] + "," + week_arr[j].toLocaleDateString() +
                    "' class='btn-danger'>";
            }
            row += "</td>"
        }
        row += "</tr>";
        $("#slot_data").append(row);
    }

}

function choosedate() {

    arr = new Array(7);
    index_curr = 0
    var jsDate = $('#chosen_date').datepicker('getDate');
    $("#date_year").text(jsDate.getFullYear());
    $("#date_month").text(months[jsDate.getMonth()])
    if (jsDate !== null) {
        index_curr = jsDate.getUTCDay()
        arr[index_curr] = jsDate;
    }



    for (var i = index_curr + 1; i < arr.length; i++) {

        selected_date = new Date(arr[i - 1]);
        nextdate = new Date(selected_date)
        nextdate.setDate(selected_date.getDate() + 1);
        arr[i] = nextdate;
    }

    for (var i = index_curr - 1; i >= 0; i--) {

        selected_date = new Date(arr[i + 1]);
        nextdate = new Date(selected_date)
        nextdate.setDate(selected_date.getDate() - 1);
        arr[i] = nextdate;
    }

    create_row(arr);
}


$("#calender").on("click", "td", function() {
    var to_add = $(this).attr("name").split(",");
    console.log(to_add);
    if (to_add.length > 1) {

        $("#date_form").val(to_add[1]);
        $("#time").val(to_add[0]);
        if (confirm("Are you sure you want to add slot for " + to_add[1] + " at " + to_add[0])) {
            $("#submit_form").click();
        }

    }


});
</script>


<?php include('footer.php') ?>