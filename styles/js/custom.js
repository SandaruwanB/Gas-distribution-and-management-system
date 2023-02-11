//service section owl carousel
$(".service_owl-carousel").owlCarousel({
    autoplay: true,
    center: true,
    nav: true,
    loop: true,
    margin: 0,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 3,
        },
        991: {
            items: 3
        }
    }
});


// nice select
$(document).ready(function() {
    $('select').niceSelect();
});

// number increse animation
$('.count').each(function() {
    $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function(now) {
            $(this).text(Math.ceil(now));
        }
    });
});

const mobileNavToogleButton = document.querySelector('.mobile-nav-toggle');

if (mobileNavToogleButton) {
    mobileNavToogleButton.addEventListener('click', function(event) {
        event.preventDefault();
        mobileNavToogle();
    });
}

function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToogleButton.classList.toggle('bi-list');
    mobileNavToogleButton.classList.toggle('bi-x');
}

/**
 * Hide mobile nav on same-page/hash links
 */
document.querySelectorAll('#navbar a').forEach(navbarlink => {

    if (!navbarlink.hash) return;

    let section = document.querySelector(navbarlink.hash);
    if (!section) return;

    navbarlink.addEventListener('click', () => {
        $("#navbtn").removeClass("fa-times");
        $("#navbtn").addClass("fa-bars");
        if (document.querySelector('.mobile-nav-active')) {
            mobileNavToogle();
        }
    });
});

/**
 * Toggle mobile nav dropdowns
 */
const navDropdowns = document.querySelectorAll('.navbar .dropdown > a');

navDropdowns.forEach(el => {
    el.addEventListener('click', function(event) {
        if (document.querySelector('.mobile-nav-active')) {
            event.preventDefault();
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('dropdown-active');
        }
    })
});

$("#logout").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "dbworks/dbworks.php",
        data: {
            msg: "logout"
        },
        dataType: "text",
        success: function(response) {
            var value = $.trim(response);
            if (value == "ok") {
                location.replace("/");
            }
        }
    });
});

window.scroll = function() {
    var scroll = window.pageYOffset;
    if (scroll > 100) {
        document.getElementById("header").style.background = "rgba(0,0,0,0.8)";
    }
}

$(".dropdown-btn").click(function(e) {
    e.preventDefault();
    $(".dropdown-btn").css("color", "default");
});