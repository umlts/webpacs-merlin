/**
 *  Copyright © 2009
 *  Rob Manson, Sean McCarthy and http://MOBusiness.com.au
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see .
 *
 *  Javascript Not-Device Detection Function
 *  Find out what type of device this is
 *  returns string - either pc, pom or iphone
 */
function _not_device_detection() {
    var ua = navigator.userAgent;
    var qs = window.location.search.substring(1);
    var agent = "error";
    var re = {
        "pcswitch" : new RegExp("pc", "i"),
        "pomswitch" : new RegExp("pom", "i"),
        "iphoneswitch" : new RegExp("iphone", "i"),
        "iphone" : new RegExp("iP(hone|od)(;|\s)", "i"),
        "winmo" : new RegExp("Windows\s+CE", "i"),
        "linux" : new RegExp("Linux", "i"),
        "windows" : new RegExp("Windows", "i"),
        "mac" : new RegExp("OS\s+(X|9)", "i"),
        "solaris" : new RegExp("Solaris", "i"),
        "bsd" : new RegExp("BSD", "i")
    };
    if (qs.match(re.pcswitch)) {
        /* This assumes you have a single query string value of "pc" */
        agent = "pc";
    } else if (qs.match(re.pomswitch)) {
        /* This assumes you have a single query string value of "pom" */
        agent = "pom";
    } else if (qs.match(re.iphoneswitch)) {
        /* This assumes you have a single query string value of "iphone" */
        agent = "iphone";
    } else if (ua.match(re.iphone)) {
        /* This user agent should be an iPhone/iPod */
        agent = "iphone";
    } else if (ua.match(re.winmo)) {
        /* This user agent should be a Windows Mobile device - you may want a special class for this and possibly high-end Symbian too */
        agent = "pom";
    } else if (
        (!ua.match(re.linux)) &&
        (!ua.match(re.windows)) &&
        (!ua.match(re.mac)) &&
        (!ua.match(re.solaris)) &&
        (!ua.match(re.bsd))
    ) {
        /* This user agent is not Linux, Windows, a Mac, Solaris or BSD */
        agent = "pom";
    } else {
        /* Otherwise assume it's a PC */
        agent = "pc";
    }
    return agent;
}