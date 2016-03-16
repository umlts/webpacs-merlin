function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

$(document).ready( function() {
  // Need to know that the scope cookie is here. Everything will break
  // from here on out if it isn't. If this fails all links will continue to show
  var scope = parseInt(getCookie("SESSION_SCOPE"));

  // Don't bother running this on the unscoped catalog. All links should show.
  if (scope && scope != 8) {
    // Grab all the 856 links
    var resource_links = $('div.bibDisplayUrls a');
    // scope_strings keys are strings that may exist in any of the link hrefs,
    // values are the scope numbers for which those strings are valid
    // (i.e. should be shown)
    var scope_strings = {
      "EW3DM6ND8C": [1,2],
      "proxy.mul.missouri.edu": [1,2],
      "PC8GA3QQ6A": [3,4],
      "proxy.library.umkc.edu": [3,4],
      "UM9MH3KU7S": [5],
      "libproxy.mst.edu": [5],
      "FN2VR5VT8L": [6],
      "ezproxy.umsl.edu": [6]
    };

    // roll through the list of links. If the href doesn't contain one of our
    // strings from above, just move on, otherwise, check to see if the current
    // scope is valid for the string. If it isn't valid, hide it.
    $.each( resource_links, function() {
      current_link = $(this);
      url = $(this).attr('href');
      $.each( scope_strings, function( key, value) {
        if ( url.indexOf(key) >= 0 ) {
          if (!(value.indexOf(scope) >= 0)) {
            $(current_link).parent().hide();
          }
        }
      });
    });
    // If we've hidden all of the links, display a message explaining this
    // rather than just leaving a blank space.
    if($('div.bibDisplayUrls td:visible').length == 0) {
       $('div.bibDisplayUrls').html("<p>This electronic resource is not available \
                                      at your location.</p>");
    }
  }
});
