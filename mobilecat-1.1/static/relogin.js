$(document).ready(function () {
    var d = new Date();
    window.parent.$("#loginfooter").load(BASEURL + "loginfooter?" + d.getTime());
});
