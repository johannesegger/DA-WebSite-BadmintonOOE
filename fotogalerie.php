<?php
    require("header.php");
    PageTitle("Fotogalerie");


     if(isset($_POST['add_album']))
     {
        $albumName = $_POST['album_name'];
        $albumUrl = SReplace($_POST['album_name']);
        $today = date("Y-m-d");
        $user = $_SESSION['user_id'];

        MySQLNonQuery("INSERT INTO fotogalerie (id, album_url, album_name, creation_date, author) VALUES ('','$albumUrl','$albumName','$today','$user')");

        $albID = Fetch("fotogalerie","id","album_name",$albumName);
        FileUpload("content/gallery/".$albumUrl."/", "images" ,"","","INSERT INTO gallery_images (id,album_id,image) VALUES ('','$albID','FNAME')");
    }


    if(isset($_GET['neu']))
    {
        echo '
            <h1 class="stagfade1">Fotogallerie</h1>
            <form action="'.ThisPage().'" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <br>
                <input type="text" placeholder="Album Name" name="album_name"/>
                <br>
                <br>
                <br>
                '.FileButton("images", "element-id", 1).'
                <br>
                <button type="submit" name="add_album" value="post-value">Album hinzuf&uuml;gen
           </form>
        ';
    }
    else if(isset($_GET['album']))
    {
        echo '<h1 class="stagfade1">'.Fetch("fotogalerie","album_name","album_url",$_GET['album']).'</h1>';

        $album_path = $_GET['album'];
        $album_name = Fetch("fotogalerie","album_name","album_url",$_GET['album']);

        echo '
            <div class="gallery_image_thumb">
                <img src="/content/gallery/'.$_GET['album'].'/ASMN6466.JPG" alt="" />
                <p>
                    Test-Galerie (1)
                    <br>
                    <span>ASMN6466.JPG</span>
                </p>
            </div>
        ';


    }
    else
    {
        echo '<h1 class="stagfade1">Fotogallerie</h1>';

        echo '
            <b><u>ToDo Fotogalerie:</u></b><br><br>
            <u>PHP-Form:</u><br>
            Checkbox "Herunterladen erlauben"<br>
            Textarea f&uuml;r Beschreibung (Tobi (JavaScript-Textarea))<br>
            Textfeld f&uuml;r Ort<br>
            Textfeld f&uuml;r Event-Datum<br>
            Tag-Funktion einf&uuml;gen (Tobi)<br>
            <br>
            <u>Fotogalerie: Alben:</u><br>
            Pager hinzuf&uuml;gen (Tobi)<br>
            CSS-Anpassen (Tobi)<br>
            <br>
            <u>Fotogalerie: Fotovorschau:</u><br>
            SQL-Abfrage f&uuml;r ausgew&auml;hltes Album erstellen<br>
            Fotos anzeigen lassen<br>
            Pager hinzuf&uuml;gen (Tobi)<br>
            Download-Button<br>
            Foto-Anzeige - [CSS-Target] (Tobi)

            <br><br><br>


        ';

        $entriesPerPage = 10;
        $offset = ((isset($_GET['page'])) ? $_GET['page']-1 : 0 ) * $entriesPerPage;

        $strSQL = "SELECT * FROM fotogalerie LIMIT $offset,$entriesPerPage";
        $rs=mysqli_query($link,$strSQL);
        while($row=mysqli_fetch_assoc($rs))
        {
            echo'
                <a href="/fotogalerie/album/'.$row['album_url'].'" style="text-decoration:none;">
                    <div class="gallery_album">
                        <div class="image_preview">
            ';


            $albumId = $row['id'];

            if(MySQLCount("SELECT id FROM gallery_images WHERE album_id = '$albumId'")>=9)
            {
                $i=1;
                $strSQLI = "SELECT * FROM gallery_images INNER JOIN fotogalerie ON gallery_images.album_id = fotogalerie.ID WHERE fotogalerie.ID = '$albumId' LIMIT 0,9";
                $rsI=mysqli_query($link,$strSQLI);
                while($rowI=mysqli_fetch_assoc($rsI)) { echo '<img src="/content/gallery/'.$row['album_url'].'/'.$rowI['image'].'" id="img'.$i++.'">'; }
            }
            else if(MySQLCount("SELECT id FROM gallery_images WHERE album_id = '$albumId'")>=4)
            {
                $i=1;
                $strSQLI = "SELECT * FROM gallery_images INNER JOIN fotogalerie ON gallery_images.album_id = fotogalerie.ID WHERE fotogalerie.ID = '$albumId' LIMIT 0,4";
                $rsI=mysqli_query($link,$strSQLI);
                while($rowI=mysqli_fetch_assoc($rsI)) { echo '<img src="/content/gallery/'.$row['album_url'].'/'.$rowI['image'].'" id="img'.$i++.'">'; }
            }
            else if(MySQLCount("SELECT id FROM gallery_images WHERE album_id = '$albumId'") < 4)
            {
                $strSQLI = "SELECT * FROM gallery_images INNER JOIN fotogalerie ON gallery_images.album_id = fotogalerie.ID WHERE fotogalerie.ID = '$albumId' LIMIT 0,1";
                $rsI=mysqli_query($link,$strSQLI);
                while($rowI=mysqli_fetch_assoc($rsI)) { echo '<img src="/content/gallery/'.$row['album_url'].'/'.$rowI['image'].'" id="img1">'; }
            }


            echo '
                        </div>
                        <div class="album_description">
                            <h3> '.$row['album_name'].'</h3>
                            <p>
                                '.$row['album_description'].'
                            </p>
                        </div>
                    </div>
                </a>
            ';
        }




        echo Pager("SELECT * FROM fotogalerie",$entriesPerPage);

    }


    include("footer.php");
?>