$(document).ready(function () {
    
    // Pop-up Twitter
    $('#twitter-popup').click(function (event) {
        var width  = 600,
            height = 450,
            left   = ($(window).width()  - width)  / 2,
            top    = ($(window).height() - height) / 2,
            url    = this.href,
            opts   = 'status=1' +
                ',width='  + width  +
                ',height=' + height +
                ',top='    + top    +
                ',left='   + left;
        window.open(url, 'Dame la patita en Twitter', opts);
        return false;
    });
    
    // Pop-up Facebook
    $('#facebook-popup').click(function (event) {
        var opts = 'toolbar=0' +
            ',status=0' +
            ',width=650' +
            ',height=450';
        window.open(this.href, 'Dame la patita en Facebook', opts);
        return false;
    });
    
    // Pop-up Google+
    $('#plus-popup').click(function (event) {
        var opts = 'menubar=no' +
            ',toolbar=no' +
            ',resizable=yes' +
            ',scrollbars=yes' +
            ',height=600' +
            ',width=600';
        window.open(this.href, 'Dame la patita en Google+', opts);
        return false;
    });
});