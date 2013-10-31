function hideLinks(){
    
    var stringsToHide = new Array ();
    stringsToHide[2] = new Array ("mul.missouri", "EW3DM6ND8C");
    stringsToHide[3] = new Array ("umkc", "PC8GA3QQ6A", "UMKC");
    stringsToHide[5] = new Array ("mst", "UM9MH3KU7S", "MS&T");
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