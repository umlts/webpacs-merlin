function hideLinks(){
    
    var stringsToHide = new Array ();
    stringsToHide[1] = new Array ("mul.missouri", "EW3DM6ND8C", "mu", "MU");
    stringsToHide[3] = new Array ("umkc", "UMKC", "PC8GA3QQ6A");
    stringsToHide[5] = new Array ("mst", " MST", "UM9MH3KU7S", "MS&T", "Missouri S&T", "libproxy.mst");
    stringsToHide[6] = new Array ("umsl", "UMSL", "FN2VR5VT8L");
    


    var scopeDropdown = $("#searchscope").val();
    
    delete stringsToHide[scopeDropdown];
	
    if ($("table").is('.bibLinks')){
	for (var k in stringsToHide) {
	    for (var l in stringsToHide[k]) {
		$(".bibLinks a").each(function(index, element) {
		    if($(element).parent().html().indexOf(stringsToHide[k][l]) > -1) {
			$(element).parent().parent().hide()
		    }    
		});
	    }
	}
	if ($(".bibLinks tr[style*=none]").length < $(".bibLinks a").length){
	    $(".bibLinks").show();       
	}
    }  
}
    
    
    $(document).ready(function () {
	hideLinks();
});
    function showLinks(){
    
    var stringsToShow = new Array ();
    stringsToShow[1] = new Array ("Freely available online", "MU, MST, UMKC, UMSL online access", "MU, MS&T, UMKC, UMSL online access via
MOBIUS Sage eBook Collection");
    stringsToShow[3] = new Array ("Freely available online", "MU, MST, UMKC, UMSL online access", "MU, MS&T, UMKC, UMSL online access via
MOBIUS Sage eBook Collection");
    stringsToShow[5] = new Array ("Freely available online", "MU, MST, UMKC, UMSL online access", "MU, MS&T, UMKC, UMSL online access via
MOBIUS Sage eBook Collection");
    stringsToShow[6] = new Array ("Freely available online", "MU, MST, UMKC, UMSL online access", "MU, MS&T, UMKC, UMSL online access via
MOBIUS Sage eBook Collection");
    


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
    
    
    $(document).ready(function () {
	showLinks();
});