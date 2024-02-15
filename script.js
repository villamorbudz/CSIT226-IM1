let isLoggedin = true;

if (!isLoggedin) {
    $('#loginModal').modal('show');
}

$(document).ready(function(){
    function updateFooter() {
        $('#footer-names').text('Giles Anthony II I. Villamor');
    }

    function resetFooter() {
        $('#footer-names').text('Fiel Louis L. Omas-as & Giles Anthony II I. Villamor');
    }
});