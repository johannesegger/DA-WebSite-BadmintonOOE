<?php
    require("header.php");
    PageTitle("Jahresberichte");

    echo '<h1 class="stagfade1">Jahresberichte</h1>

    <p>
       '.PageContent('1',CheckPermission("ChangeContent")).'
    </p>



    ';

    include("footer.php");
?>