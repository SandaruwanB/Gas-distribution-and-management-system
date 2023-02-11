(function() {
    "use strict";
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach(e => e.addEventListener(type, listener))
        } else {
            select(el, all).addEventListener(type, listener)
        }
    }

    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }

    if (select('.toggle-sidebar-btn')) {
        on('click', '.toggle-sidebar-btn', function(e) {
            select('body').classList.toggle('toggle-sidebar')
        })
    }

    if (select('.search-bar-toggle')) {
        on('click', '.search-bar-toggle', function(e) {
            select('.search-bar').classList.toggle('search-bar-show')
        })
    }


    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
        })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)


    let selectHeader = select('#header')
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add('header-scrolled')
            } else {
                selectHeader.classList.remove('header-scrolled')
            }
        }
        window.addEventListener('load', headerScrolled)
        onscroll(document, headerScrolled)
    }


    let backtotop = select('.back-to-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    if (select('.quill-editor-default')) {
        new Quill('.quill-editor-default', {
            theme: 'snow'
        });
    }

    if (select('.quill-editor-bubble')) {
        new Quill('.quill-editor-bubble', {
            theme: 'bubble'
        });
    }

    if (select('.quill-editor-full')) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ["bold", "italic", "underline", "strike"],
                    [{
                            color: []
                        },
                        {
                            background: []
                        }
                    ],
                    [{
                            script: "super"
                        },
                        {
                            script: "sub"
                        }
                    ],
                    [{
                            list: "ordered"
                        },
                        {
                            list: "bullet"
                        },
                        {
                            indent: "-1"
                        },
                        {
                            indent: "+1"
                        }
                    ],
                    ["direction", {
                        align: []
                    }],
                    ["link", "image", "video"],
                    ["clean"]
                ]
            },
            theme: "snow"
        });
    }


    const datatables = select('.datatable', true)
    datatables.forEach(datatable => {
        new simpleDatatables.DataTable(datatable);
    })

    const mainContainer = select('#main');
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function() {
                select('.echart', true).forEach(getEchart => {
                    echarts.getInstanceByDom(getEchart).resize();
                })
            }).observe(mainContainer);
        }, 200);
    }

})();

function logOutAdmin() {
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            logout: "yes"
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

$(document).ready(function() {
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            getMessageCount: "yes"
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);

            if (value == "no") {
                $("#messagePrint1").text("");
                $("#messageCount").text("");
                $(".messageCountPrint").text("You Don't Have new messages");
            } else {
                $("#messagePrint1").text(value);
                $("#messageCount").text(value);
            }

        }
    });
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            getNotifications: "yes"
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "no") {
                $(".notificCountPrint").text("You Don't Have new Notifications");
                $("#notific2").text("");
            } else {
                $("#notific").text(value);
                $("#notific2").text(value);
            }
        }
    });
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            getMessageContent: "yes"
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "no") {
                $("#msgesContent").html("");
            } else {
                $("#msgesContent").html(value);
            }
        }
    });

    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            getNotificationContent: "yes"
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "no") {
                $(".notificContent").html("");
            } else {
                $(".notificContent").html(value);
            }
        }
    });
});

$("#drmove-btn").click(function(e) {
    e.preventDefault();
    var nic = $("#drmove-btn").val();
    if (confirm("Are You Sure ?") == true) {
        $.ajax({
            type: "post",
            url: "database/dbworks.php",
            data: {
                deleteId: nic
            },
            dataType: "text",
            success: function(response) {
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
        });
    }
});

$("#stoc-view").click(function(e) {
    e.preventDefault();
    var nic = $("#stoc-view").val();
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            stockViewId: nic
        },
        dataType: "text",
        success: function(response) {
            $(".all-data").addClass("d-none");
            $(".stock-data").removeClass("d-none");
            $(".cont").html(response);
        }
    });
});

function comMark(id) {
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            dComMarkId: id
        },
        dataType: "text",
        success: function(response) {
            location.reload();
        }
    });
}

function deleteDComplain(id) {
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            dComDId: id
        },
        dataType: "text",
        success: function(response) {
            location.reload();
        }
    });
}

function viewCom(id) {
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            viewCom: id
        },
        dataType: "text",
        success: function(response) {
            console.log(response);
            $(".all-data").addClass("d-none");
            $(".clicked-data").html(response);
        }
    });
}

function viewDetails(id) {
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            userDetailsId: id
        },
        dataType: "text",
        success: function(response) {
            $(".alluser-data").addClass("d-none");
            $(".userD-data").removeClass("d-none");
            $(".cont").html(response);
        }
    });
}

function delBuyer(id) {
    if (confirm("Are You Sure ?") == true) {
        $.ajax({
            type: "post",
            url: "database/dbworks.php",
            data: {
                deleteId: id
            },
            dataType: "text",
            success: function(response) {
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 5000);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        });
    }
}

$("#newAdmin").click(function(e) {
    e.preventDefault();
    $(".aaccounts-view").addClass("d-none");
    $(".add-admin").removeClass("d-none");
});

function editAdmin(id) {
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            adminEditId: id
        },
        dataType: "text",
        success: function(response) {
            $(".aaccounts-view").addClass("d-none");
            $(".edit-admin").removeClass("d-none");
            $(".editdata").html(response);
        }
    });
}

function showAdPw() {
    var pass = document.getElementById("adadPW");
    var repass = document.getElementById("adReadPW");

    if (pass.type == "password" && repass.type == "password") {
        pass.type = "text";
        repass.type = "text";
    } else {
        pass.type = "password";
        repass.type = "password";
    }
}

$("#addAdmin").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: $("#addForm").serialize(),
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "noData") {
                $(".admnaddAlert").removeClass("d-none");
                $(".addAlert").text("All Fields are Required");
            } else if (value == "pass") {
                $(".admnaddAlert").removeClass("d-none");
                $(".addAlert").text("Passwords are not Matched");
            } else if (value == "exist") {
                $(".admnaddAlert").removeClass("d-none");
                $(".addAlert").text("Account Already Exists");
            } else {
                $(".admnaddAlert").addClass("d-none");
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 5000);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        }
    });
});

function editAdminData(id) {
    var fname = $("#firstName").val();
    var lname = $("#lastName").val();
    var uname = $("#nic").val();
    var address = $("#address").val();
    var prevelige = $("#edinputState").val();

    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            editAdminData: id,
            fname: fname,
            lname: lname,
            uname: uname,
            address: address,
            prevelige: prevelige
        },
        dataType: "text",
        success: function(response) {
            $(".alertz").removeClass("hide");
            $(".alertz").addClass("show");
            setTimeout(function() {
                $(".alertz").removeClass("show");
                $(".alertz").addClass("hide");
            }, 5000);
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    });
}

function deleteAdmin(id) {
    if (confirm("Are you Sure ?", true)) {
        $.ajax({
            type: "post",
            url: "database/dbworks.php",
            data: {
                adminDelId: id
            },
            dataType: "text",
            success: function(response) {
                location.reload();
            }
        });
    }
}

$("#update-stock").click(function(e) {
    e.preventDefault();
    $(".stock-view").addClass("d-none");
    $(".stock-add").removeClass("d-none");
});

$("#view-all-requests").click(function(e) {
    e.preventDefault();
    location.replace("gasRequests.php");
});

$("#updateStock").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: $("#stockupForm").serialize(),
        dataType: "text",
        success: function(response) {
            console.log(response);
            $(".alertz").removeClass("hide");
            $(".alertz").addClass("show");
            setTimeout(function() {
                $(".alertz").removeClass("show");
                $(".alertz").addClass("hide");
            }, 5000);
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    });
});

var reqLotId
$("#issueLot").click(function(e) {
    e.preventDefault();
    reqLotId = $("#issueLot").val();
    $(".issueLotcon").val(reqLotId);
    $(".request-view").addClass("d-none");
    $(".issue-add").removeClass("d-none");

});

function rejectLot(id) {
    reqLotId = id;
}

function issueTanks(){
    var recdate = $("#recDate").val();
    var issuecount = $("#issueCount").val();
    var issueMessage = $("#messageD").val();

    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            gasRequireId: reqLotId,
            recdate: recdate,
            issuecount: issuecount,
            issueMessage: issueMessage
        },
        dataType: "text",
        success: function (response) {
            var value = $.trim(response);
            if(value == "ferror"){
                $(".admnaddAlert").removeClass("d-none");
                $(".addAlert").text("Fields are Required");
            }
            else{
                console.log(value);
                $(".alertz").removeClass("hide");
                $(".alertz").addClass("show");
                setTimeout(function() {
                    $(".alertz").removeClass("show");
                    $(".alertz").addClass("hide");
                }, 5000);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        }
    });
}

$("#rejectConfirmation").click(function (e) { 
    var reason = $("#rejectReason").val();
    if(reason == ""){
        $(".rejectAlert").removeClass("d-none");
        $(".rejectAlert").text("please fill before submit");
    }
    else{
        $(".rejectAlert").addClass("d-none");
        $.ajax({
            type: "post",
            url: "database/dbworks.php",
            data: {
                rejectId: reqLotId,
                reason: reason
            },
            dataType: "text",
            success: function (response) {
                location.reload();
            }
        });
    }
});

function deleteMessage(id){
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            delMessageId: id
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            location.reload();
        }
    });
}

function messageMark(id){
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            markMessageId: id
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            location.reload();
        }
    });
}

function viewMessage(id){
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            getMessageDataId: id
        },
        dataType: "text",
        success: function (response) {
            $(".allMsgs-view").addClass("d-none");
            $(".msg-view").removeClass("d-none");
            $("#msgBodyContent").html(response);
        }
    });
}

function replyMail(id){
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            replyMailId: id
        },
        dataType: "text",
        success: function (response) {
            $(".allMsgs-view").addClass("d-none");
            $(".rply-mail").removeClass("d-none");
            $(".msg-email").val(response);
            $("#mailSend").val(id);
        }
    });
}

$("#mailSend").click(function (e) { 
    e.preventDefault();
    $("#mailSend").addClass("d-none");
    $("#mail-loader").removeClass("d-none");

    var msgId = $("#mailSend").val();
    var message = $("#floatingTextarea").val();
    var gmail = $("#floatingInput").val();
    var subject = $("#floatingPassword").val();

    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            postMailId: msgId,
            subject: subject,
            gmail: gmail,
            message: message
        },
        dataType: "text",
        success: function (response) {
            $("#floatingTextarea").text("");
            $("#floatingPassword").text("");
            $("#mail-loader").addClass("d-none");
            $("#mailSend").removeClass("d-none");
            $(".alertz").removeClass("hide");
            $(".alertz").addClass("show");
            setTimeout(function() {
                $(".alertz").removeClass("show");
                $(".alertz").addClass("hide");
            }, 5000);
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    });
});

function openNotific(id){
    location.replace("gasRequests.php");
}

function notificMark(id){
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            notificIdMark: id
        },
        dataType: "text",
        success: function (response) {
            location.reload();
        }
    });
}

function removeRLot(id){
    $.ajax({
        type: "post",
        url: "database/dbworks.php",
        data: {
            lotRequestRemoveId: id
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            location.reload();
        }
    });
}