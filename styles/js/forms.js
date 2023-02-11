var loginBox = document.getElementById('loginPass');
var closeBtn = document.querySelector('.close');
var openBtn = document.querySelector('.open');

function loginhide(){
    openBtn.style.display = "inline-block";
    closeBtn.style.display = "none";
    loginBox.type = "password";
}

function loginshow(){
    openBtn.style.display = "none";
    closeBtn.style.display = "inline-block";
    loginBox.type = "text";
}

function passopen(){
    document.querySelector('.passopen').style.display = "none";
    document.querySelector('.passclose').style.display = "inline-block";
    document.getElementById('pass').type = "text";
}

function passclose(){
    document.querySelector('.passopen').style.display = "inline-block";
    document.querySelector('.passclose').style.display = "none";
    document.getElementById('pass').type = "password";
}

function repassopen(){
    document.querySelector('.repassopen').style.display = "none";
    document.querySelector('.repassclose').style.display = "inline-block";
    document.getElementById('repass').type = "text";
}

function repassclose(){
    document.querySelector('.repassopen').style.display = "inline-block";
    document.querySelector('.repassclose').style.display = "none";
    document.getElementById('repass').type = "password";
}

function roleFunc(){
    var val = $("#role").val();
    if(val == "sell"){
        $("#scontent-com").css("display", "flex");
        $("#scontent-brand").css("display", "flex");
        $("#bcontent").css("display", "none");
    }
    else if(val == "buy"){
        $("#bcontent").css("display", "flex");
        $("#scontent-com").css("display", "none");
        $("#scontent-brand").css("display", "none");
    }
    else{
        $("#bcontent").css("display", "none");
        $("#scontent-com").css("display", "none");
        $("#scontent-brand").css("display", "none");
    }
}