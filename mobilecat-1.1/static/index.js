$(document).ready(function () {
    var searchboxClicked = false;
    var searchbox = $(".searchbox");

    if (!$(searchbox).val()) {
        $(searchbox).val("Enter keywords...");
        $(searchbox).addClass("searchboxgray");
    
        $(searchbox).click(function () {
            searchboxClicked = true;
            $(searchbox).removeClass("searchboxgray");
            $(searchbox).val("");
        });
    }

    $("#searchform").submit(function () {
        if (searchboxClicked == false) {
            $(searchbox).val("");
        }

        return true;
    });

});
