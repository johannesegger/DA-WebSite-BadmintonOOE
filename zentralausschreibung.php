<?php
    require("header.php");
    PageTitle("Zentralausschreibungen");

    if(isset($_POST['updateZA']))
    {
        $kategorie = $_POST['kategorie'];

        $title1 = $_POST['title1'];
        $title2 = $_POST['title2'];

        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        $chTimespan = (isset($_POST['ch_timespan']) ? 1 : 0 );

        $chVerein = (isset($_POST['ch_verein']) ? 1 : 0 );
        $chUhrzeit = (isset($_POST['ch_uhrzeit']) ? 1 : 0 );
        $chAuslosung = (isset($_POST['ch_auslosung']) ? 1 : 0 );
        $chHallenname = (isset($_POST['ch_hallenname']) ? 1 : 0 );
        $chAnschriftHalle = (isset($_POST['ch_anschrift_halle']) ? 1 : 0 );
        $chAnzahlFelder = (isset($_POST['ch_anzahl_felder']) ? 1 : 0 );
        $chTurnierverantwortlicher = (isset($_POST['ch_turnierverantwortlicher']) ? 1 : 0 );
        $chOberschiedsrichter = (isset($_POST['ch_oberschiedsrichter']) ? 1 : 0 );
        $chTelefon = (isset($_POST['ch_telefon']) ? 1 : 0 );
        $chAnmeldungOnline = (isset($_POST['ch_anmeldung_online']) ? 1 : 0 );
        $chAnmeldungEmail = (isset($_POST['ch_anmeldung_email']) ? 1 : 0 );
        $chNennungenEmail = (isset($_POST['ch_nennungen_email']) ? 1 : 0 );
        $chNennschluss = (isset($_POST['ch_nennschluss']) ? 1 : 0 );
        $chZusatzangaben = (isset($_POST['ch_zusatzangaben']) ? 1 : 0 );

        $Verein = $_POST['verein'];
        $Uhrzeit = $_POST['uhrzeit'];
        $Auslosung = $_POST['auslosung'];
        $Hallenname = $_POST['hallenname'];
        $AnschriftHalle = $_POST['anschrift_halle'];
        $AnzahlFelder = $_POST['anzahl_felder'];
        $Turnierverantwortlicher = $_POST['turnierverantwortlicher'];
        $Oberschiedsrichter = $_POST['oberschiedsrichter'];
        $Telefon = $_POST['telefon'];
        $AnmeldungOnline = $_POST['anmeldung_online'];
        $AnmeldungEmail = $_POST['anmeldung_email'];
        $NennungenEmail = $_POST['nennungen_email'];
        $Nennschluss = $_POST['nennschluss'];
        $Zusatzangaben = $_POST['zusatzangaben'];

        $Location = $_POST['location'];

        if($_POST['postType']=="new")
        {
            MySQLNonQuery("INSERT INTO zentralausschreibungen (id,kategorie) VALUES ('','newfield')");
            $zaID = Fetch("zentralausschreibungen","id","kategorie","newfield");
        }
        else $zaID = $_POST['updateZA'];

        $updateSQL = "
            UPDATE zentralausschreibungen SET
            kategorie = '$kategorie',
            title_line1 = '$title1',
            title_line2 = '$title2',
            date_begin = '$date1',
            date_end = '$date2',
            act_timespan = '$chTimespan',
            act_verein = '$chVerein',
            verein = '$Verein',
            act_uhrzeit = '$chUhrzeit',
            uhrzeit = '$Uhrzeit',
            act_auslosung = '$chAuslosung',
            auslosung = '$Auslosung',
            act_hallenname = '$chHallenname',
            hallenname = '$Hallenname',
            act_anschrift_halle = '$chAnschriftHalle',
            anschrift_halle = '$AnschriftHalle',
            act_anzahl_felder = '$chAnzahlFelder',
            anzahl_felder = '$AnzahlFelder',
            act_turnierverantwortlicher = '$chTurnierverantwortlicher',
            turnierverantwortlicher = '$Turnierverantwortlicher',
            act_oberschiedsrichter = '$chOberschiedsrichter',
            oberschiedsrichter = '$Oberschiedsrichter',
            act_telefon = '$chTelefon',
            telefon = '$Telefon',
            act_anmeldung_online = '$chAnmeldungOnline',
            anmeldung_online = '$AnmeldungOnline',
            act_anmeldung_email = '$chAnmeldungEmail',
            anmeldung_email = '$AnmeldungEmail',
            act_nennungen_email = '$chNennungenEmail',
            nennungen_email = '$NennungenEmail',
            act_nennschluss = '$chNennschluss',
            nennschluss = '$Nennschluss',
            act_zusatzangaben = '$chZusatzangaben',
            zusatzangaben = '$Zusatzangaben',
            location = '$Location'
            WHERE id = '$zaID';
        ";
        MySQLNonQuery($updateSQL);

        Redirect(ThisPage());
        die();
    }


    if(isset($_GET['neu']))
    {
        if(CheckPermission("AddZA"))
        {
            echo EditZA();
        }
    }
    else
    {
        echo '<h1 class="stagfade1">Zentralausschreibungen</h1>';

        if(CheckPermission("AddZA"))
        {
            echo AddButton(ThisPage("!editSC","!#edit","+neu"));
        }


        $monthNames = array(
            "J&auml;nner", "Februar", "M&auml;rz",
            "April", "Mai", "Juni", "Juli",
            "August", "September", "Oktober",
            "November", "Dezember"
        );

        $monthNamesS = array(
            "Jan", "Feb", "M&auml;r",
            "Apr", "Mai", "Jun", "Jul",
            "Aug", "Sep", "Okt",
            "Nov", "Dez"
        );

        $dayNames = array(
            "Sonntag","Montag","Dienstag","Mittwoch",
            "Donnerstag","Freitag","Samstag"
        );

        $dayNamesS = array(
            "So","Mo","Di","Mi","Do","Fr","Sa"
        );

        echo '<br><center>';
        $first = true;
        $strSQL = "SELECT DISTINCT SUBSTRING(date_begin, 1, 7) AS date FROM zentralausschreibungen ORDER BY date_begin ASC";
        $rs=mysqli_query($link,$strSQL);
        while($row=mysqli_fetch_assoc($rs))
        {
            if($first) echo '<a href="#'.$row['date'].'">'.str_replace('�','&auml;',strftime("%B %Y",strtotime($row['date']))).'</a>';
            else echo ' | <a href="#'.$row['date'].'">'.str_replace('�','&auml;',strftime("%B %Y",strtotime($row['date']))).'</a>';
            $first=false;
        }
        echo '</center><br>';


        echo PageContent("1",CheckPermission("ChangeContent"));


        $strSQLt = "SELECT DISTINCT SUBSTRING(date_begin, 1, 7) AS date FROM zentralausschreibungen ORDER BY date_begin ASC";
        $rst=mysqli_query($link,$strSQLt);
        while($rowt=mysqli_fetch_assoc($rst))
        {
            $date = $rowt['date'];
            echo '<a name="'.$date.'"></a>';

            $strSQL = "SELECT * FROM zentralausschreibungen WHERE date_begin LIKE '$date%' ORDER BY date_begin ASC";
            $rs=mysqli_query($link,$strSQL);
            while($row=mysqli_fetch_assoc($rs))
            {
                $dayIndex1 = date("w",strtotime($row['date_begin']));
                $dayIndex2 = date("w",strtotime($row['date_end']));
                $day1 = date("d",strtotime($row['date_begin']));
                $day2 = date("d",strtotime($row['date_end']));
                $monthIndex1 = date("n",strtotime($row['date_begin'])) - 1;
                $monthIndex2 = date("n",strtotime($row['date_end'])) - 1;
                $year = date("Y",strtotime($row['date_begin']));

                if($row['act_timespan'])
                {
                    if($day1 == $day2-1) $dateStr = $dayNamesS[$dayIndex1].'/'.$dayNamesS[$dayIndex2].', '.$day1.'./'.$day2.'. '.$monthNames[$monthIndex1].' '.$year;
                    else
                    {
                        if($monthIndex1 == $monthIndex2) $dateStr = $dayNamesS[$dayIndex1].' '.$day1.'. - '.$dayNamesS[$dayIndex2].' '.$day2.'. '.$monthNames[$monthIndex1].' '.$year;
                        else $dateStr = $dayNamesS[$dayIndex1].' '.$day1.'. '.$monthNames[$monthIndex1].' - '.$dayNamesS[$dayIndex2].' '.$day2.'. '.$monthNames[$monthIndex2].' '.$year;
                    }
                }
                else $dateStr = $dayNames[$dayIndex1].', '.$day1.'. '.$monthNames[$monthIndex1].' '.$year;

                if(isset($_GET['editSC']) AND $_GET['editSC']==$row['id'])
                {
                    echo '<a name="edit"></a>';
                    echo EditZA($row['id']);
                }
                else
                {
                    if($row['size']=='full')
                    {
                        echo '
                            <div class="za_box">
                                <div class="za_title">
                                    <h1 style="color: '.GetProperty("Color".$row['kategorie']).'">'.$row['title_line1'].'<br>'.$row['title_line2'].'</h1>
                                    <h2><span style="color: #000000">'.$dateStr.'</span></h2>
                                </div>
                                <div class="za_data">
                                    <table>
                        ';

                        if($row['act_verein'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r"><b>Verein:</b></td>
                                    <td class="ta_l"><b>'.$row['verein'].'</b></td>
                                </tr>
                            ';
                        }
                        if($row['act_uhrzeit'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Uhrzeit:</td>
                                    <td class="ta_l">'.$row['uhrzeit'].'</td>
                                </tr>
                            ';
                        }
                        if($row['act_auslosung'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Auslosung:</td>
                                    <td class="ta_l">'.$row['auslosung'].'</td>
                                </tr>
                            ';
                        }
                        if($row['act_hallenname'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Hallenname:</td>
                                    <td class="ta_l">'.$row['hallenname'].'</td>
                                </tr>
                            ';
                        }
                        if($row['act_anschrift_halle'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Anschrift Halle:</td>
                                    <td class="ta_l">'.$row['anschrift_halle'].'</td>
                                </tr>
                            ';
                        }
                        if($row['act_anzahl_felder'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Anzahl Felder:</td>
                                    <td class="ta_l">'.$row['anzahl_felder'].'</td>
                                </tr>
                            ';
                        }
                        if($row['act_turnierverantwortlicher'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Turnierverantwortlicher:</td>
                                    <td class="ta_l">'.$row['turnierverantwortlicher'].'</td>
                                </tr>
                            ';
                        }
                        if($row['act_oberschiedsrichter'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Oberschiedsrichter:</td>
                                    <td class="ta_l">'.$row['oberschiedsrichter'].'</td>
                                </tr>
                            ';
                        }
                        if($row['act_telefon'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Telefon:</td>
                                    <td class="ta_l">'.$row['telefon'].'</td>
                                </tr>
                            ';
                        }
                        if($row['act_anmeldung_online'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Anmeldung Online:</td>
                                    <td class="ta_l"><a href="'.$row['anmeldung_online'].'" target="_blank"><b><i>Online-Anmeldung</i></b></a></td>
                                </tr>
                            ';
                        }
                        if($row['act_anmeldung_email'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Anmeldung E-Mail:</td>
                                    <td class="ta_l"><a href="mailto: '.$row['anmeldung_email'].'">'.$row['anmeldung_email'].'</a></td>
                                </tr>
                            ';
                        }
                        if($row['act_nennungen_email'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Nennungen E-Mail:</td>
                                    <td class="ta_l"><a href="mailto: '.$row['nennungen_email'].'">'.$row['nennungen_email'].'</a></td>
                                </tr>
                            ';
                        }
                        if($row['act_nennschluss'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Nennschluss:</td>
                                    <td class="ta_l">'.str_replace('�','&auml;',strftime("%A, %d. %B %Y",strtotime($row['nennschluss']))).'</td>
                                </tr>
                            ';
                        }
                        if($row['act_zusatzangaben'])
                        {
                            echo '
                                <tr>
                                    <td class="ta_r">Zusatzangaben:</td>
                                    <td class="ta_l">'.$row['zusatzangaben'].'</td>
                                </tr>
                            ';
                        }

                        echo '
                                    </table>

                        ';

                        if(CheckPermission("EditZA"))
                        {
                            echo '<span style="float: right;"> '.EditButton(ThisPage("!editContent","!editSC","+editSC=".$row['id'],"#edit")).' </span>';
                        }

                        if(CheckPermission("DeleteZA"))
                        {
                            echo '<span style="float: right;"> '.DeleteButton("ZA","zentralausschreibungen",$row['id']).' </span>';
                        }

                        echo '
                                </div>
                            </div>
                        ';

                    }
                    else
                    {
                        echo '
                            <div class="za_box">
                                <div class="za_title">
                                    <h3 style="color: '.GetProperty("Color".$row['kategorie']).'">'.$row['title_line1'].'</h3>

                                </div>
                                <div class="za_data">
                                    <table>
                                        <tr>
                                            <td>Datum:</td>
                                            <td>'.$dateStr.'</td>
                                        </tr>
                                        <tr>
                                            <td>Ort:</td>
                                            <td>'.$row['location'].'</td>
                                        </tr>
                                    </table>
                                    ';

                                    if(CheckPermission("EditZA"))
                                    {
                                        echo '<span style="float: right;"> '.EditButton(ThisPage("!editContent","!editSC","+editSC=".$row['id'],"#edit")).' </span>';
                                    }

                                    if(CheckPermission("DeleteZA"))
                                    {
                                        echo '<span style="float: right;"> '.DeleteButton("ZA","zentralausschreibungen",$row['id']).' </span>';
                                    }

                                     echo '
                                </div>
                            </div>
                        ';
                    }
                }
            }
        }
    }



    include("footer.php");
?>