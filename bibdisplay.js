/*
*  Rel 2009B Example Set
*  This File Last Changed: 12 Dec 2009
*/

// Dean Edwards/Matthias Miller/John Resig

function init() {
    // quit if this function has already been called
    if (arguments.callee.done) return;

    // flag this function so we don't do the same thing twice
    arguments.callee.done = true;

    // kill the timer
    if (_timer) clearInterval(_timer);
    if (!document.getElementById) return false;
	stripeTables();
	highlightRows();
	stripeSubjectTables();
	stripeBrowseTables();

};

/* for Mozilla/Opera9 */
if (document.addEventListener) {
    document.addEventListener("DOMContentLoaded", init, false);
}


/* for Safari */
if (/WebKit/i.test(navigator.userAgent)) { // sniff
    var _timer = setInterval(function() {
        if (/loaded|complete/.test(document.readyState)) {
            init(); // call the onload handler
        }
    }, 10);
}

/* for other browsers */
window.onload = init;


function addLoadEvent(func) {
var oldonload = window.onload;
 if (typeof window.onload != 'function') {
   window.onload = func;
  } else {
  window.onload = function() {
  oldonload();
     func();
      }
   }
}

function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}


function addClass(element,value) {
  if (!element.className) {
    element.className = value;
  } else {
    newClassName = element.className;
    newClassName+= " ";
    newClassName+= value;
    element.className = newClassName;
  }
}

function stripeTables() {
    if (!document.getElementsByTagName) return false;
    var rows = getElemByClass(document , "td" , "briefcitCell" );
    var odd = false;
    for (var j=0; j<rows.length; j++) {
      if (odd == true) {
        addClass(rows[j],"odd");
        odd = false;
      } else {
        odd = true;
      }
    }

}

function highlightRows() {
  if (!document.getElementsByTagName) return false;
  var rows = getElemByClass(document , "td" , "briefcitCell" );
  for (var i=0; i<rows.length; i++) {
    rows[i].oldClassName = rows[i].className
    rows[i].onmouseover = function() {
      addClass(this,"highlight");
    }
    rows[i].onmouseout = function() {
      this.className = this.oldClassName
    }
  }
}

function stripeSubjectTables() {
    if (!document.getElementsByTagName) return false;
    var rows = getElemByClass(document , "tr" , "briefcitCell" );
    if(!rows[0]) return false;
    var odd = false;
    for (var j=0; j<rows.length; j++) {
      if (odd == true) {
         addClass(rows[j],"odd");
         odd = false;
      } else {
         odd = true;
      }
 }
}

function stripeBrowseTables(){
	var yours = getElemByClass(document, "tr" , "yourEntryWouldBeHere");
	var myTR = document.getElementsByTagName('tr');
    if (!yours[0]){
		stripeBrowse();
       	for (var i=0;i<myTR.length;i++) {
			if(myTR[i].className =="browseEntry odd" || myTR[i].className=="browseEntry marked odd"){
				var spaner = myTR[i].getElementsByTagName("TD");
				var num = spaner[0].getAttribute("ROWSPAN");
				for(j=1;j<num;j++){
					addClass(myTR[i+j],"odd");
				}
			}
		}
	}else{
    	var tds = yours[0].getElementsByTagName("TD");
    	if(document.attachEvent){
        	if(yours[0].nextSibling.className == "browseEntry" || yours[0].nextSibling.className=="browseEntry marked"){
           		stripeBrowse();
           		for(i=0;i<tds.length;i++){
               		addClass(tds[i],"outline");
               			if(i==0){addClass(tds[i],"leftCap");}
               			if(i == (tds.length - 1 )){addClass(tds[i],"rightCap");}
               	}
        }else{
        	stripeBrowse();
       		for (var i=0;i<myTR.length;i++) {
				if(myTR[i].className =="browseEntry odd" || myTR[i].className=="browseEntry marked odd"){
					var spaner = myTR[i].getElementsByTagName("TD");
					if(spaner[0]){
						if(spaner[0].getAttribute("ROWSPAN")){
							var num = spaner[0].getAttribute("ROWSPAN");
							for(j=1;j<num;j++){
								addClass(myTR[i+j],"odd");
							}
						}
					}
				}
				else if(myTR[i].className =="yourEntryWouldBeHere"){
					var spaner = myTR[i].getElementsByTagName("TD");
					if(spaner[0]){
						if(spaner[0].getAttribute("ROWSPAN")){
							var num = spaner[0].getAttribute("ROWSPAN");
							for(j=0;j<spaner.length;j++){
         						addClass(spaner[j],"topLine");
         						if(j==0){addClass(spaner[j],"leftCap");}
         						if(j == (spaner.length - 1 )){addClass(spaner[j],"rightTopCap");}
							}
							for(k=1;k<num;k++){
								var subs = myTR[i+k].getElementsByTagName("TD");
								if(k==(num-1)){
									for(l=0;l<subs.length;l++){
										addClass(subs[l],"botLine");
										if(l == (subs.length - 1 )){addClass(subs[l],"rightBotCap");}
									}
								}else{
									for(l=0;l<subs.length;l++){
										if(l == (subs.length - 1 )){addClass(subs[l],"rightSide");}
									}
								}
							}
						}
					}
				}
			}
		}

    	}else{
        	if(yours[0].nextSibling.nextSibling.className == "browseEntry" || yours[0].nextSibling.nextSibling.className=="browseEntry marked"){
        		stripeBrowse();
        		for(i=0;i<tds.length;i++){
            		addClass(tds[i],"outline");
            		if(i==0){addClass(tds[i],"leftCap");}
            		if(i == (tds.length - 1 )){addClass(tds[i],"rightCap");}
        		}
       		}else{
				stripeBrowse();
       			for (var i=0;i<myTR.length;i++) {
					if(myTR[i].className =="browseEntry odd" || myTR[i].className=="browseEntry marked odd"){
						var spaner = myTR[i].getElementsByTagName("TD");
						if(spaner[0]){
							if(spaner[0].getAttribute("ROWSPAN")){
								var num = spaner[0].getAttribute("ROWSPAN");
								for(j=1;j<num;j++){
									addClass(myTR[i+j],"odd");
								}
							}
						}
					}
					else if(myTR[i].className =="yourEntryWouldBeHere"){
						var spaner = myTR[i].getElementsByTagName("TD");
						if(spaner[0]){
							if(spaner[0].getAttribute("ROWSPAN")){
								var num = spaner[0].getAttribute("ROWSPAN");
									for(j=0;j<spaner.length;j++){
         								addClass(spaner[j],"topLine");
         								if(j==0){addClass(spaner[j],"leftCap");}
         								if(j == (spaner.length - 1 )){addClass(spaner[j],"rightTopCap");}
									}
									for(k=1;k<num;k++){
										var subs = myTR[i+k].getElementsByTagName("TD");
										if(k==(num-1)){
											for(l=0;l<subs.length;l++){
												addClass(subs[l],"botLine");
												if(l == (subs.length - 1 )){addClass(subs[l],"rightBotCap");}
											}
										}else{
											for(l=0;l<subs.length;l++){
												if(l == (subs.length - 1 )){addClass(subs[l],"rightSide");}
											}
										}
									}
								}
							}
						}
					}

        	}
    	}
  	}
}

function stripeBrowse() {
    if (!document.getElementsByTagName) return false;
    var rows = getElemByClass(document , "tr" , "browseEntry" );
    if(!rows[0])return false;
    var odd = false;
    for (var j=0; j<rows.length; j++) {
      if (odd == true) {
        addClass(rows[j],"odd");
        odd = false;
      } else {
        odd = true;
      }
    }

}

// Robert Nyman

function getElemByClass(oElm, strTagName, strClassName){
    var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
    var arrReturnElements = new Array();
    strClassName = strClassName.replace(/\-/g, "\\-");
    var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
    var oElement;
    for(var i=0; i<arrElements.length; i++){
        oElement = arrElements[i];
        if(oRegExp.test(oElement.className)){
            arrReturnElements.push(oElement);
        }
    }
    return (arrReturnElements)
}

function asrsModal() {
  // Create modal dialog for requesting journals
    if($("#bib_items td:contains('Periodical')").size() > 0 && $("#bib_items td:contains('RooBot')").size() > 0) {

      // This is a periodical.

      var journalTitle = encodeURIComponent($("td.bibInfoLabel:contains('Title')").first().next("td").text());
      journalTitle = journalTitle.replace(/\s/g, '+');
      console.log(journalTitle);
      var journalIssn = $("td.bibInfoLabel:contains('ISSN')").first().next("td").text();
      journalIssn = journalIssn.replace(/\-/g,"");
      console.log(journalIssn);
      // alert(link);

      $("#bib_items").find("tr").find("td:first").find("a").click(function(e) {
      e.preventDefault();
      var link = $(this).attr("href"); // Get the URL of the ASRS request

      // Insert a modal dialog box to direct users to Document Delivery
      $("body").append('<div class="modal-box"><div class="close-button">[x]</div><p><strong>Are you looking for a specific article?</strong> <a href="http://library.umkc.edu/ill">Interlibrary loan</a> can send an electronic copy to you, free of charge.</p><p>Need the whole journal? We can put it on hold for you.</p><div class="line"><a href="https://ill.library.umkc.edu/illiad/illiad.dll/OpenURL?sid=&genre=article&aulast=&aufirst=&issn=' + journalIssn + '&title=' + journalTitle + '&atitle=&volume=&part=&issue=&spage=&epage=&date=" class="btn btn-primary btn-lg">Request an Article</a> -or - <a href="' + link + '" class="btn btn-default btn-lg">Request the Journal</a></div></div>');

      $(".close-button").click(function() {
        $(".modal-box").hide();
      });
      });
      // Close modal dialogs

    }
}
