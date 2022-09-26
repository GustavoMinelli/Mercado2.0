$(function() {

    $('#theme-color-toggle').on('click', function() {

        var $navLink = $(this);
        var $icon = $navLink.find('i');

        var $nav = $('nav');
        var $body = $('body');
        var $dark = $('dark');

        if ($body.hasClass('dark')) {
            $nav.addClass('navbar-light')
            $nav.addClass('bg-light')
            $body.removeClass('dark');
            $body.css("background-color", "white");
            $icon.removeClass('fa-moon');
            $icon.addClass('fa-sun');


        } else {
            $nav.removeClass('navbar-light')
            $nav.removeClass('bg-light')
            $body.addClass('dark');
            $body.css("background-color", "#414141");
            $icon.removeClass('fa-sun');
            $icon.addClass('fa-moon');

        }

    });

});
