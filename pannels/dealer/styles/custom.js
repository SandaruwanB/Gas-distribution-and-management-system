

$("#newPw").focusout(function() {
    passCheck();
});
$("#rnewPw").focusout(function() {
    rpassCheck();
});


function passCheck() {
    var pw = $("#newPw").val();
    if (pw.length < 6 || pw == "") {
        $("#password-error").text("* Password Must be more than 6 Charactors.");
    } else {
        $("#password-error").text("");
    }
}

function rpassCheck() {
    var pw = $("#newPw").val();
    var rpw = $("#rnewPw").val();
    if (pw != rpw) {
        $("#password-error2").text("* Passwords Doesn't Match.");
    } else {
        $("#password-error2").text("");
    }
}

$("#delAcc").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            deleteAcc: "yes"
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value === "success") {
                $.ajax({
                    type: "post",
                    url: "dbworks/dbworks.php",
                    data: {
                        dead: "logout"
                    },
                    dataType: "text",
                    success: function(response) {
                        var val = $.trim(response);
                        if (val == "ok") {
                            location.replace("/");
                        }
                    }
                });
            }
        }
    });

});

$("#changePw").click(function(e) {
    e.preventDefault();
    var oldpw = $("#oldPw").val();
    var newpw = $("#newPw").val();
    var rnewpw = $("#rnewPw").val();
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            changePw: "yes",
            oldpw: oldpw,
            newpw: newpw,
            rnewpw: rnewpw
        },
        dataType: "text",
        success: function(response) {
            var val = $.trim(response);
            if (val == "nodata") {
                $("#pErrPrint").text("Please Fill All Fields Before Press Button");
                $("#pErrPrint").removeClass("d-none");
            } else if (val == "notmatch") {
                $("#pErrPrint").text("New Password and Re-Enterd Password Doesn't Match");
                $("#pErrPrint").removeClass("d-none");
            } else if (val == "verifyFail") {
                $("#pErrPrint").text("Old Password is Not Matched");
                $("#pErrPrint").removeClass("d-none");
            } else {
                $("#pErrPrint").addClass("d-none");
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 5000);
                setTimeout(function() {
                    location.reload();
                }, 4000);
            }
        }
    });
});

function showPW() {
    var old = document.getElementById("oldPw");
    var newP = document.getElementById("newPw");
    var rnewP = document.getElementById("rnewPw");
    if (old.type == "password" && newP.type == "password" && rnewP.type == "password") {
        old.type = "text";
        newP.type = "text";
        rnewP.type = "text";
    } else {
        old.type = "password";
        newP.type = "password";
        rnewP.type = "password";
    }
}

$("#cancelUN").click(function() {
    var type = "<?php echo $gasType; ?>";
    $("#shopNo").val("");
    $("#type").val(type);
});
$("#clearPW").click(function() {
    $("#oldPw").val("");
    $("#newPw").val("");
    $("#rnewPw").val("");
});
$("#cleanName").click(function() {
    $("#fname").val("");
    $("#lname").val("");
});

$("#txtSave").click(function(e) {
    e.preventDefault();
    var type = $("#type").val();
    var comid = $("#shopNo").val();
    var twokg = $("#twoTanks").val();
    var fivekg = $("#fiveTanks").val();
    var twelve = $("#twelveT").val();


    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            changeType: "yes",
            type: type,
            comid: comid,
            twokg: twokg,
            fivekg: fivekg,
            twelve: twelve
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value === "no") {
                $("#pErrPrint3").removeClass("d-none");
                $("#pErrPrint3").text("Please Fill Your Changes Before Submit.");
            } else if (value === "typec") {
                $("#pErrPrint3").removeClass("d-none");
                $("#pErrPrint3").text("If You are Change Gas Type Please Fill Shop Registration ID and Other Details.");
            } else {
                $("#pErrPrint3").addClass("d-none");
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 5000);
                setTimeout(function() {
                    location.reload();
                }, 4000);
            }
        }
    });
});

$("#changeName").click(function(e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();

    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            changeName: "yes",
            fname: fname,
            lname: lname
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "no") {
                $("#pErrPrint2").removeClass("d-none");
                $("#pErrPrint2").text("Please Fill Fields Before Submit.");
            } else {
                $("#pErrPrint2").addClass("d-none");
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 5000);
                setTimeout(function() {
                    location.reload();
                }, 4000);
            }
        }
    });
});


function typeChanged(value) {
    var finVal = $.trim(value);
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            changedVal: finVal
        },
        dataType: "text",
        success: function(response) {
            //console.log(response);
            var value = $.trim(response);
            if (value == "equal") {
                $("#alertSetter").addClass("d-none");
                $("#lot-taker").addClass("d-none");
            } else if (value == "litro") {
                //console.log(value);
                $("#lot-taker").removeClass("d-none");
                $("#alertSetter").removeClass("d-none");
            } else if (value == "laughfs") {
                //console.log(value);
                $("#lot-taker").removeClass("d-none");
                $("#alertSetter").removeClass("d-none");
            } else {
                //console.log(value);
                $("#lot-taker").addClass("d-none");
                $("#alertSetter").addClass("d-none");
            }
            console.log(response);
        }
    });

}

$("#closeAlert").click(function() {
    $(".alertz").removeClass("show");
    $(".alertz").addClass("hide");
});
