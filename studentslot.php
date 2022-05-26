<?php include('header.php');
function getSlots($conn,$author_id)
{
    $slots=[];
    $slots_query = "SELECT * FROM tbl_slot WHERE status=0 AND authorid=".$author_id;
    $result = $conn->query($slots_query);
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
              array_push($slots,$row);
         }
    }
    return $slots;

}

function getSlotsPending($conn,$author_id)
{
    $slots=[];
    $slots_query = "SELECT * FROM tbl_slot WHERE status=1 AND authorid=".$author_id;
    $result = $conn->query($slots_query);
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
              array_push($slots,$row);
         }
    }
    return $slots;
}
 if(isset($_SESSION) && $_SESSION['status']==0){
    
    $slots=[];
    $slots_pending=[];
    if (isset($_GET['submit'])) {
        $slots = getSlots($conn,$_GET['author']);
        $slots_pending = getSlotsPending($conn,$_GET['author']);
    }
    
}else{
 echo 'You are on wrong page!';
 die();
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
    <br>
    <div class="d-sm-flex align-items-center justify-content-between mb-12">
        <h1 class="h3 mb-12 text-gray-800" style="display:block;">Choose Author</h1>
        <br>
        <br>

    </div>
    <div>
        <form action="#" method="GET" id="select_author">

            <input type="submit" name="submit" id="submit_author" hidden />

            <select name="author" class="form-control" aria-label="Select Author">
                <?php 
                $sql2 = "SELECT * FROM tbl_user WHERE status=1";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    $i=1;
                    if(!isset($_GET['author']))
                    {
                        echo "<option selected> Select Author</i></option>";
                    }
                    while ($row = $result2->fetch_assoc()) {
                        if(isset($_GET['author']) && $row['id']==$_GET['author'])
                        {
                            echo "<option selected onclick='$(`#submit_author`).click();' value='".$row['id']."'>".$row['fname']." ".$row['lname']."</option>";
                        }
                        else
                            echo "<option onclick='$(`#submit_author`).click();' value='".$row['id']."'>".$row['fname']." ".$row['lname']."</option>";
                    }
                }
                    ?>

            </select>
        </form>
    </div>
    <br>
    <br>
    <br>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Slot</h1>
        <div class="row">
            <span>Slot Empty</span><button class="btn-success"></button>&nbsp;&nbsp;
            <span>Slot Bocked</span><button class="btn-danger"></button>&nbsp;&nbsp;
            <span>Slot Approval is pending</span><button class="btn-warning"></button>&nbsp;&nbsp;
        </div>
    </div>

    <br>
    <div class="row">

        <div class="col-lg-12">


            <div class="form-group">
                <label for="email">Select date for view time slot</label>
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

            <div class="datedata">
            </div>



        </div>



    </div>
</div>
<!-- /.container-fluid -->

</div>
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
    var user_id = <?php echo $_SESSION["user_id"]; ?>;
    for (var i = 0; i < slots_free_in_db.length; i++) {

        dates = new Date(slots_free_in_db[i].slotdate);
        newdate = new Date(date.join("/"));
        var slot_date = slots_free_in_db[i].slotdate.split("/");

        if (dates.getTime() == newdate.getTime()) {
            if (time == slots_free_in_db[i].slottime) {
                return "" + slots_free_in_db[i].slot_id + "," + user_id;
            }
        }
    }
    return undefined;

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

            let data = check_aval_slot(date, arr[i]);
            if (data != undefined) {
                row += "<td name='" + data + "' class='btn-success'>";
            } else if (check_pending_slot(date, arr[i])) {
                row += "<td name='' class='btn-warning'>";
            } else {
                row += "<td name='' class='btn-danger'>";
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
        bookslot(to_add[0], to_add[1]);
        window.location.reload();

    }


});
</script>
<!-- End of Main Content -->

<?php include('footer.php') ?>