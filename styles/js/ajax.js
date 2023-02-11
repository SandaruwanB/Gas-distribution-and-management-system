var returnnic;

$("#fname").focusout(function() {
    check_fname();
});

$("#resetnic").focusout(function() {
    restnic_check();
});

$("#lname").focusout(function() {
    check_lname();
});

$("#nic").focusout(function() {
    nic_check();
});

$("#role").focusout(function() {
    role_check();
});

$("#email").focusout(function() {
    email_check();
});

$("#address").focusout(function() {
    address_check();
});

$("#pass").focusout(function() {
    password_check();
});

$("#repass").focusout(function() {
    repass_check();
});

$("#size").focusout(function() {
    size_error();
});

function size_error() {
    var size = $("#size").val();

    if (size != "") {
        $(".size-error").hide();
        $("#size").css("border", "none");
    } else {
        $(".size-error").text("* Invalid Tank Size Entered");
        $("#size").css("border", "2px solid red");
    }
}

function password_check() {
    var password = $("#pass").val();

    if (password.length >= 6 && password != '') {
        $(".password-error1").hide();
        $("#pass").css("border", "none");
    } else {
        $(".password-error1").text("* Password Must be more than 6 Charactors.");
        $("#pass").css("border", "2px solid red");
    }
}

function repass_check() {
    var password = $("#pass").val();
    var repassword = $("#repass").val();

    if (password == repassword) {
        $("#repass").css("border", "none");
        $(".repassword-error").hide();
    } else {
        $("#repass").css("border", "2px solid red");
        $(".repassword-error").text("* Passwords doesn't Match.");
    }
}

function check_fname() {
    var pattern = /^[a-zA-Z]*$/;
    var fname = $("#fname").val();
    if (pattern.test(fname) && fname !== '') {
        $("#fname").css("border", "none");
        $(".fname-error").hide();
    } else {
        $("#fname").css("border", "2px solid red");
        $(".fname-error").text("* Enter Valid Name.");
    }
}

function check_lname() {
    var pattern = /^[a-zA-Z]*$/;
    var lname = $("#lname").val();
    if (pattern.test(lname) && lname !== '') {
        $("#lname").css("border", "none");
        $(".lname-error").hide();
    } else {
        $("#lname").css("border", "2px solid red");
        $(".lname-error").text("* Enter Valid Name.");
    }
}

function nic_check() {
    var pattern1 = /^[0-9]{9}[vVxX]$/;
    var pattern2 = /^[0-9]{7}[0][0-9]{4}$/;
    var nic = $("#nic").val();

    if (pattern1.test(nic) || pattern2.test(nic) && nic != '') {
        $("#nic").css("border", "none");
        $(".nic-error").hide();
    } else {
        $("#nic").css("border", "2px solid red");
        $(".nic-error").text("* Invalid NIC Number");
    }
}

function role_check() {
    var role = $("#role").val();
    if (role != "buy" || role != "sell") {
        $("#role").css("border", "2px solid red");
        $(".role-error").text("* Please Select Option");
    } else {
        $("#role").css("border", "none");
        $(".role-error").hide();
    }

}

function restnic_check() {
    var resetNic = $("#resetnic").val();
    var pattern1 = /^[0-9]{9}[vVxX]$/;
    var pattern2 = /^[0-9]{7}[0][0-9]{4}$/;
    if (pattern1.test(resetNic) || pattern2.test(resetNic) && resetNic != '') {
        $("#resetnic").css("border", "none");
        $(".resetnic-error").hide();
    } else {
        $("#resetnic").css("border", "2px solid red");
        $(".resetnic-error").text("* Invalid NIC Number");
    }
}

function email_check() {
    var gmailValid = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var gmail = $("#email").val();

    if (gmailValid.test(gmail) && gmail != '') {
        $("#email").css("border", "none");
        $(".email-error").hide();
    } else {
        $("#email").css("border", "2px solid red");
        $(".email-error").text("* Enter Valid email Address.");
    }
}

function address_check() {
    var valid = /^[a-zA-Z]*$/;
    var address = $("#address").val();

    if (valid.test(address) && address != '') {
        $(".addres-error").hide();
        $("#address").css("border", "none");;
    } else {
        $(".addres-error").text("* Enter Valid Address.");
        $("#address").css("border", "2px solid red");
    }
}
// ajax registration and login
$(document).ready(function() {
    $("#next").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/database/register.php",
            data: $("#form1").serialize(),
            dataType: "text",
            success: function(response) {
                var value = $.trim(response);
                if (value == "av") {
                    $("#accAv").text("Account Already Exists. Please Login.");
                    $("#accAv").css("display", "block");
                } else if (value == "require") {
                    $("#accAv").text("Please Fill Missed Parts in the Form.");
                    $("#accAv").css("display", "block");
                } else if (value == "pass") {
                    $("#repass").css("border", "2px solid red");
                    $(".repassword-error").text("* Passwords doesn't Match.");
                } else if (value == "doneSeller") {
                    window.location.replace("pannels/dealer/dhome.php?time=1");
                } else if (value == "doneBuyer") {
                    window.location.replace("pannels/customer/chome.php?time=1");
                }
            }
        });
    });

    $("#sign-btn").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/database/login.php",
            data: $("#login-form").serialize(),
            dataType: "text",
            success: function(response) {
                var value = $.trim(response);
                if (value == "noAcc") {
                    $("#loginerr").text("No Account Found Please Register.");
                    $("#loginerr").css("display", "block");
                } else if (value == "passMatch") {
                    $("#loginerr").text("Wrong Password. Please Check Again.");
                    $("#loginerr").css("display", "block");
                } else if (value == "d") {
                    window.location.replace("pannels/dealer/dhome.php");
                } else if (value == "b") {

                    window.location.replace("pannels/customer/chome.php");
                } else {
                    window.location.replace("pannels/admin/dashboard.php");
                }
            }
        });
    });
});

$("#resetBtn").click(function(e) {
    e.preventDefault();
    $("#resetNic-error").css("display", "none");
    $("#rloader").removeClass("d-none");
    $("#rname").addClass("d-none");
    $("#resetBtn").addClass("pl-5");
    $("#resetBtn").addClass("pr-5");
    $.ajax({
        type: "post",
        url: "/database/others.php",
        data: $("#resetForm1").serialize(),
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "noAcc") {
                $("#resetNic-error").css("display", "block");
                $("#resetNic-error").text("No Account Found Check Your NIC Before Submit.");
                $("#rloader").addClass("d-none");
                $("#rname").removeClass("d-none");
                $("#resetBtn").removeClass("pl-5");
                $("#resetBtn").removeClass("pr-5");
            } else {
                returnnic = value;
                $("#form1-in").removeClass("d-block");
                $("#form1-in").addClass("d-none");

                $("#form2-in").removeClass("d-none");
                $("#form2-in").addClass("d-block");
            }
        }
    });
});


$("#resetBtn2").click(function(e) {
    e.preventDefault();
    var verification = $("#verify").val();
    $.ajax({
        type: "post",
        url: "/database/others.php",
        data: {
            verCode: verification,
            changeNic: returnnic
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "success") {
                console.log(response);
                $("#form2-in").removeClass("d-block");
                $("#form2-in").addClass("d-none");


                $("#form3-in").removeClass("d-none");
                $("#form3-in").addClass("d-block");
            } else {
                $("#resetver-error").css("display", "block");
                $("#resetver-error").text("Wrong Verification Key.Please Check it Again.");
                console.log(response);
            }
        }
    });
});

$("#resetBtn3").click(function(e) {
    e.preventDefault();
    var password = $("#pass").val();
    var repassword = $("#repass").val();

    console.log(password);

    $.ajax({
        type: "post",
        url: "/database/others.php",
        data: {
            pass: password,
            repass: repassword,
            changeNic: returnnic
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "success") {
                $("#form3-in").removeClass("d-block");
                $("#form3-in").addClass("d-none");


                $("#form4-in").removeClass("d-none");
                $("#form4-in").addClass("d-block");
            } else if (value == "notMatch") {
                $("#pass-error").css("display", "block");
                $("#pass-error").text("Passwords Miss Matched.Please Check Again.");
            } else {
                $("#pass-error").css("display", "block");
                $("#pass-error").text("Please Fill Before Submit");
            }
        }
    });

});