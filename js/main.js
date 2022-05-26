function getdate(sel) {
  //alert(sel.value);
  var date = sel.value;

  $.ajax({
    url: "getslotbydate.php",
    type: "post",
    data: {
      slotdate: date,
    },

    success: function (data) {
      console.log(data);
      $(".datedata").html(data);
    },
    error: function (hrx, ajaxOption, errorThrow) {
      alert(ajaxOption + "\n" + errorThrow);
    },
  });
}
function studentgetslot(sel) {
  //alert(sel.value);
  var date = sel.value;

  $.ajax({
    url: "studentgetslot.php",
    type: "post",
    data: {
      slotdate: date,
    },

    success: function (data) {
      console.log(data);
      $(".datedata").html(data);
    },
    error: function (hrx, ajaxOption, errorThrow) {
      alert(ajaxOption + "\n" + errorThrow);
    },
  });
}
function bookslot(slotid, userid) {
  if (confirm("Are you sure you want to Book this slot?")) {
    $.ajax({
      url: "bookmyslot.php",
      type: "post",
      data: {
        slotid: slotid,
        userid: userid,
      },

      success: function (data) {
        alert("your slot is going to approval.We will notify you soon!");
      },
      error: function (hrx, ajaxOption, errorThrow) {
        alert(ajaxOption + "\n" + errorThrow);
      },
    });
  } else {
    // Do nothing!
  }
}

function updatebookslot(slotid, userid) {
  if (confirm("Are you sure you want to approve this Booking?")) {
    $.ajax({
      url: "updatebookmyslot.php",
      type: "post",
      data: {
        slotid: slotid,
        userid: userid,
        status: 2,
      },

      success: function (data) {
        alert("your approve the slot!");
        window.location.reload();
      },
      error: function (hrx, ajaxOption, errorThrow) {
        alert(ajaxOption + "\n" + errorThrow);
      },
    });
  } else {
    $.ajax({
      url: "updatebookmyslot.php",
      type: "post",
      data: {
        slotid: slotid,
        userid: userid,
        status: 0,
      },

      success: function (data) {
        alert("your cancel this slot!");
      },
      error: function (hrx, ajaxOption, errorThrow) {
        alert(ajaxOption + "\n" + errorThrow);
      },
    });
  }
}
