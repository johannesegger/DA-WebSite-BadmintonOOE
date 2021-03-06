<?php

    $revision = 3001;

    echo '
        <!-- Own links -->
            <link rel="stylesheet" type="text/css" href="/css/style.css?'.$revision.'">
            <link rel="stylesheet" type="text/css" href="/css/layout_modern.css">
            <link rel="stylesheet" type="text/css" href="/css/menu.css?'.$revision.'">
            <link rel="stylesheet" type="text/css" href="/css/slide.css?'.$revision.'" />
            <link href="/content/favicon.png" rel="icon" type="image/x-icon" />
        <!-- End own links -->


        <!-- Own Scripts -->
            <script src="/js/source.js?'.$revision.'"></script>
        <!-- End of Own Scripts -->


        <!-- External Links/Scripts -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- End of External Links/Scripts -->


        <!-- Froala-Texteditor -->
            <link rel="stylesheet" href="/css/froala/froala_editor.css">
            <link rel="stylesheet" href="/css/froala/froala_style.css">
            <link rel="stylesheet" href="/css/froala/plugins/code_view.css">
            <link rel="stylesheet" href="/css/froala/plugins/colors.css">
            <link rel="stylesheet" href="/css/froala/plugins/emoticons.css">
            <link rel="stylesheet" href="/css/froala/plugins/image_manager.css">
            <link rel="stylesheet" href="/css/froala/plugins/image.css">
            <link rel="stylesheet" href="/css/froala/plugins/line_breaker.css">
            <link rel="stylesheet" href="/css/froala/plugins/table.css">
            <link rel="stylesheet" href="/css/froala/plugins/char_counter.css">
            <link rel="stylesheet" href="/css/froala/plugins/video.css">
            <link rel="stylesheet" href="/css/froala/plugins/fullscreen.css">
            <link rel="stylesheet" href="/css/froala/plugins/file.css">
            <link rel="stylesheet" href="/css/froala/plugins/quick_insert.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
        <!-- End of Froala -->

        <!-- jsColor-->
            <script src="/js/jscolor.js"></script>
        <!-- End of jsColor -->

        <!-- HTML2Canvas-->
            <script src="/js/html2canvas.js"></script>
        <!-- End of HTML2Canvas -->

        <!-- File Buttons -->
            <!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
            <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
        <!-- End of File Buttons -->


        <!-- Header-Parallax -->
            <script>
                window.addEventListener("scroll", function(e) {
                    var scrOffset = (window.scrollY/3) + 360;
                    document.getElementById("htmlheader").style.backgroundPosition = "0px " + (scrOffset) + "px";
                });
            </script>
        <!-- End of Header-Parallax -->


    ';

?>