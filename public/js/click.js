$("#button-nav").click( function () {
    $("#mega-menu-full").toggle();
});

$("#mega-menu-full-dropdown").toggle();

$("#mega-menu-full-dropdown-button").click( function () {
    $("#mega-menu-full-dropdown").toggle();
})

// open profile user
$(document).ready(function() {
    var check = true;
    $("#user-dropdown").hide();
    $("#profileUser").click(
        function( ) {
            if ( check ) {
                $("#user-dropdown").show();
            } else {
                $("#user-dropdown").hide();
            }
            check = !check;
        }
    )
})
