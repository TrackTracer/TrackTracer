$(window).scroll(function () { 
    if($(window).scrollTop() > 30) {
        $("nav.botonera").addClass("fixbotonera");
    } else {
        $("nav.botonera").removeClass("fixbotonera");
    }
});