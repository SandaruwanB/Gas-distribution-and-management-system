$("#logoutC").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            logoutC: "yes"
        },
        dataType: "text",
        success: function(response) {
            var val = $.trim(response);
            if (val == "ok") {
                location.replace("/");
            }
        }
    });
});

$("#dealerComplain").click(function(e) {
    e.preventDefault();
    var subject = $("#subject").val();
    var reason = $("#reason").val();
    var message = $("#message").val();

    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            subject: subject,
            reason: reason,
            message: message
        },
        dataType: "text",
        success: function(response) {
            var val = $.trim(response);
            if (val == "noVal") {
                $("#errorSpace").removeClass("d-none");
                $("#errorSpace").text("All Fields are Requierd");
            } else {
                $("#errorSpace").addClass("d-none");
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 3000);
                $("#subject").val("");
                $("#reason").val("");
                $("#message").val("");
            }
        }
    });
});

$("#closeAlert").click(function() {
    $(".alertz").removeClass("show");
    $(".alertz").addClass("hide");
});

$("#cleanName").click(function() {
    $("#fname").val("");
    $("#lname").val("");
});

$("#clearPW").click(function() {
    $("#oldPw").val("");
    $("#newPw").val("");
    $("#rnewPw").val("");
});

function showPW() {
    var oldp = document.getElementById("oldPw");
    var newp = document.getElementById("newPw");
    var rnewp = document.getElementById("rnewPw");

    if (oldp.type == "password" && newp.type == "password" && rnewp.type == "password") {
        oldp.type = "text";
        newp.type = "text";
        rnewp.type = "text";
    } else {
        oldp.type = "password";
        newp.type = "password";
        rnewp.type = "password";
    }
}

$("#changeName").click(function(e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    if (fname == "" || lname == "") {
        $("#pErrPrint2").removeClass("d-none");
        $("#pErrPrint2").text("All Fields are Required.");
    } else {
        $("#pErrPrint2").addClass("d-none");
        $.ajax({
            type: "post",
            url: "dbworks/dbworks.php",
            data: {
                nameChange: "yes",
                fname: fname,
                lname: lname,
            },
            dataType: "text",
            success: function(response) {
                console.log(response);
                var val = $.trim(response);
                if (val == "success") {
                    $(".alertz").removeClass("hide");
                    $(".alertz").addClass("show");
                    setTimeout(function() {
                        $(".alertz").removeClass("show");
                        $(".alertz").addClass("hide");
                    }, 3000);
                    setTimeout(function() {
                        location.reload()
                    }, 3000);
                }
            }
        });
    }
});

$("#txtSave").click(function(e) {
    e.preventDefault();
    var type = $("#gtype").val();
    var size = $("#gsize").val();
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            typeChange: "yes",
            type: type,
            size: size
        },
        dataType: "text",
        success: function(response) {
            var val = $.trim(response);
            if (val == "equel") {
                $("#pErrPrint3").removeClass("d-none");
                $("#pErrPrint3").text("You Already Using this Type and Size.");
            } else {
                $("#pErrPrint3").addClass("d-none");
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 3000);
                setTimeout(function() {
                    location.reload()
                }, 3000);
            }
        }
    });
});

$("#changePw").click(function(e) {
    e.preventDefault();

});


$("#newPw").focusout(function() {
    newpCheck();
});

$("#rnewPw").focusout(function() {
    repaCheck();
});

function newpCheck() {
    var pw = $("#newPw").val();
    if (pw.length < 6) {
        $("#password-error").text("* Password Must be More Than 6 Charactors");
    } else {
        $("#password-error").text("");
    }
}

function repaCheck() {
    var pw = $("#newPw").val();
    var rpw = $("#rnewPw").val();

    if (pw != rpw) {
        $("#password-error2").text("* Passwords are Not Matching");
    } else {
        $("#password-error2").text("");
    }
}

$("#changePw").click(function(e) {
    e.preventDefault();
    var oldp = $("#oldPw").val();
    var newp = $("#newPw").val();
    var newrp = $("#rnewPw").val();

    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            oldp: oldp,
            newp: newp,
            newrp: newrp
        },
        dataType: "text",
        success: function(response) {
            console.log(response);
            var val = $.trim(response);
            if (val == "empty") {
                $("#pErrPrint").text("All Fields are Required");
                $("#pErrPrint").removeClass("d-none");
            } else if (val == "no") {
                $("#pErrPrint").text("Your Old Password is Wrong.Please Check Again.");
                $("#pErrPrint").removeClass("d-none");
            } else if (val == "pass") {
                $("#pErrPrint").text("New Password and Re-Entered Password are not Equal.");
                $("#pErrPrint").removeClass("d-none");
            } else {
                $("#pErrPrint").addClass("d-none");
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 3000);
                setTimeout(function() {
                    location.reload()
                }, 3000);
            }
        }
    });
});


$(document).ready(function () {
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            getNotificCount: "yes"
        },
        dataType: "text",
        success: function (response) {
            var value = $.trim(response);
            if(value < 9 && value > 0){
                $("#nots").text(value);
                $("#notsd").removeClass("d-none");
            }
            else if(value == 0){
                $("#notsd").addClass("d-none");
            }
            else{
                $("#nots").text("9+");
                $("#notsd").removeClass("d-none");
            }
        }
    });
});

function markAsReadFunc(id){
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            notificationsReadMarkId: id
        },
        dataType: "text",
        success: function (response) {
            location.reload();
        }
    });
}

function deleteNotific(id){
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            notificationDeleteId: id
        },
        dataType: "text",
        success: function (response) {
            location.reload();
        }
    });
}