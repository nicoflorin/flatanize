/* Zeigt die linke Navigation an */
$(document).ready(function() {
    $('#leftMenuBtn').click(function() {
        $('#leftNav').toggleClass('showLeftMenu');
        $('#rightContent').toggleClass('moveRight');
        $('#leftMenuIcon').toggleClass('fa-chevron-right');
        $('#leftMenuIcon').toggleClass('fa-chevron-left');
    });
});