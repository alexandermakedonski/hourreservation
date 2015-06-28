$(document).ready(function () {
    var h = window.innerHeight;
    if($('body').height() < h){
        h = h-$('body').height();
        $('.container-default').css({'min-height':h+'px'});
    }


});