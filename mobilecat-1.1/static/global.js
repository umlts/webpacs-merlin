// Add something to the save list
function save_list(bibid) {
    return load_to_iframe(BASEURL + "save?bibid=" + bibid, bibid);
}

// Remove something from the save list
function delete_list(bibid, anchor) {
    return load_to_iframe(BASEURL + "delete?bibid=" + bibid, bibid);
}

function show_details(bhead_div) {
    $(bhead_div).siblings(".det").toggle();
    return false;
}

// Show the next element, and hide ourself
function show_diag(anchor) {
    $(anchor).hide();
    $(anchor).next().show();

    return false;
}

function load_to_iframe(url, bibid) {
   var frame = $("iframe#frame" + bibid);
    
    $(frame).attr('src', url);
    $(frame).show();
    $(frame).unbind('load');
    
    $(frame).load(function () {
        setTimeout(function () {
            $(frame).css("height", $(frame).contents().find("body span.formheight").height());
        }, 
        0);
    });
    
    return false;
}    

