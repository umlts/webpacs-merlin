function hideLinks() {
    "use strict";
    var stringsToHide = [],
        scopeDropdown,
        k,
        l;
    stringsToHide[1] = ["mul.missouri", "EW3DM6ND8C", "mu", "MU"];
    stringsToHide[3] = ["umkc", "UMKC", "PC8GA3QQ6A"];
    stringsToHide[5] = ["mst", " MST", "UM9MH3KU7S", "MS&T", "Missouri S&T", "libproxy.mst"];
    stringsToHide[6] = ["umsl", "UMSL", "FN2VR5VT8L"];



    scopeDropdown = $("#searchscope").val();

    delete stringsToHide[scopeDropdown];
    
    if ($("table").is('.bibLinks')) {
        for (k in stringsToHide) {
            for (l in stringsToHide[k]) {
                $(".bibLinks a").each(function (index, element) {
                    if ($(element).parent().html().indexOf(stringsToHide[k][l]) > -1) {
                        $(element).parent().parent().hide();
                    }
                });
            }
  }
  if ($(".bibLinks tr[style*=none]").length < $(".bibLinks a").length){
      $(".bibLinks").show();
  }
    }
}

    function showLinks(){

    var stringsToShow = new Array ();
    stringsToShow[1] = new Array ("Freely available online", "MU, MST, UMKC, UMSL online access", "MU, MS&T, UMKC, UMSL online access");
    stringsToShow[3] = new Array ("Freely available online", "MU, MST, UMKC, UMSL online access", "MU, MS&T, UMKC, UMSL online access");
    stringsToShow[5] = new Array ("Freely available online", "MU, MST, UMKC, UMSL online access", "MU, MS&T, UMKC, UMSL online access");
    stringsToShow[6] = new Array ("Freely available online", "MU, MST, UMKC, UMSL online access", "MU, MS&T, UMKC, UMSL online access");



    var scopeDropdown = $("#searchscope").val();

    delete stringsToShow[scopeDropdown];

    if ($("table").is('.bibLinks')){
  for (var k in stringsToShow) {
      for (var l in stringsToShow[k]) {
    $(".bibLinks a").each(function(index, element) {
        if($(element).parent().html().indexOf(stringsToShow[k][l]) > -1) {
      $(element).parent().parent().show()
        }
    });
      }
  }
  if ($(".bibLinks tr[style*=none]").length < $(".bibLinks a").length){
      $(".bibLinks").show();
  }
    }
}
