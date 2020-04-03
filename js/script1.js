$(document).ready(function() {
    $(".menu-icon").on("click", function() {
        $("nav ul").toggleClass("showing");
    });
});

// Scrolling Effect

$(window).on("scroll", function() {
    if($(window).scrollTop()) {
        $('nav').addClass('black');
    }

    else {
        $('nav').removeClass('black');
    }
});



function RemoveItem(id) {
    $.post('script-to-remove.php',
        { ItemID: id },
        function(data) {
            if(data==='success') {
                //Remove item from DOM
            } else alert("There was an error!"); //If you want error handling
        }
    );
}