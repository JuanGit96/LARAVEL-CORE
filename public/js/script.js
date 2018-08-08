/**
 * Transparencia nav al hacer scroll
 */

var scroll;

/*menú superior */
if(!document.getElementById('sideNav')){//si no existe menu lateral
    $('#body').scroll( function (){
        scroll = $('#body').scrollTop(); 
        if (scroll >= 100) {
            $('#menu').addClass("bg-transparent");
            $('#menu').removeClass("bg-dark");     
        } else {
            $('#menu').addClass("bg-dark");
            $('#menu').removeClass("bg-transparent");     
        }
    });
}