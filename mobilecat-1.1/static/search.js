var MORE_LINK;

function create_show_details(bibid) {
    return function () {
        // Before we do anything, disable the click event so we don't
        // get multiple loads
        $("#bhead" + bibid).unbind("click");
        
        $("#bhead" + bibid).click(function () {
            $("#det" + bibid).toggle();
            return false;
        });
       
        $.getJSON("record", { "bibid" : bibid },
            function (json) {
	        $("#det" + bibid).append(json['record_html']);
                $("#det" + bibid).show();
                
                return false;
        });
	return false;
    }
}

function populate_results(json) {

    $("#morespinner").hide();
    $("#searchspinner").hide();

    if (json.oneres == true) {
        $("#results").append(json['results_html']);

    } else if (json.results.length > 0) {
        // Show the HTML for all results
        $("#results").append(json['results_html']);

        // For each result, put in an onclick handler
        var i;
        for (i = 0; i < json.results.length; i++) {
            var result = json.results[i];
            var bibid = result.bibid;
            $("#bhead" + result.bibid).click( 
                create_show_details(bibid)
            )

            var rowtype = "oddrow";
            if (i % 2 == 0) {
                rowtype = "evenrow";
            }
            $("#bres" + result.bibid).addClass(rowtype);
        }
    }

    // If this is the first time the search is being run, and not just a "more"
    // click, then update the results header.
    if (json.searcharg) {
        if (json.num == 1) {
            $("#resultshead").html(json.num + " result for <b>" + json.searcharg + "</b>");
        } else {
            $("#resultshead").html(json.num + " results for <b>" + json.searcharg + "</b>");
        }
    }

    if (json.next) {
        MORE_LINK = json.next;
        $("#more").show()

    } else {
        MORE_LINK = null;
        $("#more").hide();
        $("#nomore").show();
    }
   

}

function get_initial_results() {
    $("#results").html("");
    $("#more").hide();
    
    $.getJSON("browse", {
            "searcharg" : $("#searcharg").val(),
            "scope" : $("#scope").val()
        },
        populate_results
    );

    return false;
}

function get_more_results() {
    $("#morespinner").show();
    $("#more").hide();

    $.getJSON("browse", {
            "url" : MORE_LINK
        },
        populate_results
    );

    return false;
}

function generic_error(event, request, settings) {
    $(this).html("An error occurred while retreiving results." + settings.url);
}

$(document).ready(function () {
    // Set up some visuals and error handling
    $("#more").hide();
    $("#results").ajaxError(generic_error); 

    // Clicking on more adds more links, by retrieving the results of clicking
    // on the "next" button.
    $("#more").click(get_more_results);

    get_initial_results();
});

