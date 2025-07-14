<?php

include 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){               //verifier que le id est bien enregistré dans la session 
        header('location:login.php');
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>l'itinéraire</title>
    <link rel="stylesheet" href="\EmploiDeTemps\assets\CSS\style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            display: grid;
            grid-template-columns: 3fr;
            grid-template-rows: auto 1fr auto;
            grid-template-areas:
                "header header header"
                "main main main"
                "footer footer footer";
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        main .maindisplay {
            grid-area: main;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top:30px;
        }

        header {
            grid-area: header;
            background-color: #05318f;
            height: 100px;
            width: 100%;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 0;
        }

        header nav h1 {
            margin: 20px;
            font-size: 36px;
            color: white;
            font-weight: 600;
        }
        .nav-icons{
            display: flex;
            align-items: center;
        }
        .compteicon{
            color: white; 
            margin-right: 30px;
        }
        .compteicon:hover{
            color: #eee;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.15);
            transition: all 1s ease;
        }
        .InputContainer {
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            padding-left: 15px;
            box-shadow: 4px 8px 12px rgba(0, 0, 0, 0.075);
            margin-top: 40px;
        }

        .input {
            width: 320px;
            height: 100%;
            border: none;
            outline: none;
            font-size: 0.9em;
            caret-color: rgb(255, 81, 0);
        }

        .labelforsearch {
            cursor: text;
            padding: 0px 12px;
        }

        .searchIcon {
            width: 13px;
        }

        .border {
            height: 40%;
            width: 1.3px;
            background-color: rgb(223, 223, 223);
        }

        .micIcon {
            width: 12px;
        }

        .micButton {
            padding: 0px 15px 0px 12px;
            border: none;
            background-color: transparent;
            height: 40px;
            cursor: pointer;
            transition-duration: .3s;
        }

        .searchIcon path {
            fill: rgb(114, 114, 114);
        }

        .micIcon path {
            fill: rgb(255, 81, 0);
        }

        .micButton:hover {
            background-color: rgb(255, 230, 230);
            transition-duration: .3s;
        }
        .valider {
            margin-left: 153px;
            margin-top: 30px;
            --primary-color:rgb(15, 74, 201);
            --secondary-color: #fff;
            --hover-color: #111;
            --arrow-width: 10px;
            --arrow-stroke: 2px;
            box-sizing: border-box;
            border: 0;
            border-radius: 20px;
            color: var(--secondary-color);
            padding: 1em 1.8em;
            background: var(--primary-color);
            display: flex;
            transition: 0.2s ;
            align-items: center;
            gap: 0.6em;
            font-weight: bold;
            box-shadow: 4px 9px 20px rgba(0, 0, 0, 0.075);
        }

        .valider .arrow-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .valider .arrow {
            margin-top: 1px;
            width: var(--arrow-width);
            background: var(--primary-color);
            height: var(--arrow-stroke);
            position: relative;
            transition: 0.2s;
        }

        .valider .arrow::before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            border: solid var(--secondary-color);
            border-width: 0 var(--arrow-stroke) var(--arrow-stroke) 0;
            display: inline-block;
            top: -3px;
            right: 3px;
            transition: 0.2s;
            padding: 3px;
            transform: rotate(-45deg);
        }

        .valider:hover {
            background-color: var(--hover-color);
        }

        .valider:hover .arrow {
            background: var(--secondary-color);
        }

        .valider:hover .arrow:before {
            right: 0;
        }
        fieldset{
            margin-top: 30px;
            padding: 40px;
            border-radius: 15px;
            border-color: rgb(214, 214, 214);
            border-style: solid ;
            border-width: 0.1px;
            box-shadow: 4px 12px 20px rgba(0, 0, 0, 0.075);
        }

        .ui-checkbox {
            --primary-color: #1677ff;
            --secondary-color: #fff;
            --primary-hover-color: #4096ff;
            
            --checkbox-diameter: 20px;
            --checkbox-border-radius: 5px;
            --checkbox-border-color: #1677ff;
            --checkbox-border-width: 1px;
            --checkbox-border-style: solid;
            --checkmark-size: 1.2;
        }

        .ui-checkbox, 
        .ui-checkbox *, 
        .ui-checkbox *::before, 
        .ui-checkbox *::after {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .ui-checkbox {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: var(--checkbox-diameter);
            height: var(--checkbox-diameter);
            border-radius: var(--checkbox-border-radius);
            background: var(--secondary-color);
            border: var(--checkbox-border-width) var(--checkbox-border-style) var(--checkbox-border-color);
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
        }

        .ui-checkbox::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            -webkit-box-shadow: 0 0 0 calc(var(--checkbox-diameter) / 2.5) var(--primary-color);
            box-shadow: 0 0 0 calc(var(--checkbox-diameter) / 2.5) var(--primary-color);
            border-radius: inherit;
            opacity: 0;
            -webkit-transition: all 0.5s cubic-bezier(0.12, 0.4, 0.29, 1.46);
            -o-transition: all 0.5s cubic-bezier(0.12, 0.4, 0.29, 1.46);
            transition: all 0.5s cubic-bezier(0.12, 0.4, 0.29, 1.46);
        }

        .ui-checkbox::before {
            top: 40%;
            left: 50%;
            content: "";
            position: absolute;
            width: 4px;
            height: 7px;
            border-right: 2px solid var(--secondary-color);
            border-bottom: 2px solid var(--secondary-color);
            -webkit-transform: translate(-50%, -50%) rotate(45deg) scale(0);
            -ms-transform: translate(-50%, -50%) rotate(45deg) scale(0);
            transform: translate(-50%, -50%) rotate(45deg) scale(0);
            opacity: 0;
            -webkit-transition: all 0.1s cubic-bezier(0.71, -0.46, 0.88, 0.6),opacity 0.1s;
            -o-transition: all 0.1s cubic-bezier(0.71, -0.46, 0.88, 0.6),opacity 0.1s;
            transition: all 0.1s cubic-bezier(0.71, -0.46, 0.88, 0.6),opacity 0.1s;
        }

        

        .ui-checkbox:hover {
            border-color: var(--primary-color);
        }

        .ui-checkbox:checked {
            background: var(--primary-color);
            border-color: transparent;
        }

        .ui-checkbox:checked::before {
            opacity: 1;
            -webkit-transform: translate(-50%, -50%) rotate(45deg) scale(var(--checkmark-size));
            -ms-transform: translate(-50%, -50%) rotate(45deg) scale(var(--checkmark-size));
            transform: translate(-50%, -50%) rotate(45deg) scale(var(--checkmark-size));
            -webkit-transition: all 0.2s cubic-bezier(0.12, 0.4, 0.29, 1.46) 0.1s;
            -o-transition: all 0.2s cubic-bezier(0.12, 0.4, 0.29, 1.46) 0.1s;
            transition: all 0.2s cubic-bezier(0.12, 0.4, 0.29, 1.46) 0.1s;
        }

        .ui-checkbox:active:not(:checked)::after {
            -webkit-transition: none;
            -o-transition: none;
            -webkit-box-shadow: none;
            box-shadow: none;
            transition: none;
            opacity: 1;
        }
        .checkboxdiv{
            display: flex;
            flex-direction: row;
            padding-top: 30px;
            padding-left: 45px;
            gap: 10px;  
        }
        table{
            margin-bottom: 100px;
        }
        .home-icon{
            display: flex; 
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }
        .home-icon:hover{
            color: #eee;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.09);
            transition: all 1s ease;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <h1>Horaires des trains</h1>
                <div style = "margin-right: 20px; margin-top: 20px;">
                    <a href="home.php" class="home-icon" style="color: white; margin-right: 30px;">
                        <svg   xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                        </svg>
                        <p style="margin-top: 0px; margin-right: 0px; color: white; padding: 0px;">Accueil</p>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="maindisplay">
            <img src="../assets/images/SNTF.svg.png" alt="le logo n'est pas visible" style="margin-bottom: 50px;" width="152px" height="95px">

            <form style="margin-bottom: 40px;" action="route.php" method="GET">
                <fieldset>
                    <div class="InputContainer">
                        <input type="text" name="search_depart" class="input" id="input_depart" placeholder="gare de départ" required>
                        
                        <label for="input" class="labelforsearch">
                            <svg viewBox="0 0 512 512" class="searchIcon"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path></svg>
                        </label>
                        <div class="border"></div>

                        <button class="micButton" onclick="startDictation('input_depart')"><svg viewBox="0 0 384 512" class="micIcon"><path d="M192 0C139 0 96 43 96 96V256c0 53 43 96 96 96s96-43 96-96V96c0-53-43-96-96-96zM64 216c0-13.3-10.7-24-24-24s-24 10.7-24 24v40c0 89.1 66.2 162.7 152 174.4V464H120c-13.3 0-24 10.7-24 24s10.7 24 24 24h72 72c13.3 0 24-10.7 24-24s-10.7-24-24-24H216V430.4c85.8-11.7 152-85.3 152-174.4V216c0-13.3-10.7-24-24-24s-24 10.7-24 24v40c0 70.7-57.3 128-128 128s-128-57.3-128-128V216z"></path></svg>
                        </button>

                    </div>
                    <div class="InputContainer">
                        <input type="text" name="search_destination" class="input" id="input_destination" placeholder="gare de destination">
                        
                        <label for="input" class="labelforsearch">
                            <svg viewBox="0 0 512 512" class="searchIcon"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path></svg>
                        </label>
                        <div class="border"></div>

                        <button class="micButton" onclick="startDictation('input_destination')"><svg viewBox="0 0 384 512" class="micIcon"><path d="M192 0C139 0 96 43 96 96V256c0 53 43 96 96 96s96-43 96-96V96c0-53-43-96-96-96zM64 216c0-13.3-10.7-24-24-24s-24 10.7-24 24v40c0 89.1 66.2 162.7 152 174.4V464H120c-13.3 0-24 10.7-24 24s10.7 24 24 24h72 72c13.3 0 24-10.7 24-24s-10.7-24-24-24H216V430.4c85.8-11.7 152-85.3 152-174.4V216c0-13.3-10.7-24-24-24s-24 10.7-24 24v40c0 70.7-57.3 128-128 128s-128-57.3-128-128V216z"></path></svg>
                        </button>

                    </div>
                    <div class="checkboxdiv">
                        <input type="radio" name="checkbox" value="thenia" class="ui-checkbox">
                        <label style="margin-right: 55px;">vers Tizi Ouzou</label>
                        <input type="radio" name="checkbox" value="alger" class="ui-checkbox" checked>
                        <label>vers Alger</label>
                    </div>
                    <button type="submit" name="submit" class="valider">
                        Valider
                        <div class="arrow-wrapper">
                            <div class="arrow"></div>
                        </div>
                    </button>
                </fieldset>
            </form>
            
            <?php
                include("../user/config.php");

                if(isset($_GET["search_depart"]) && isset($_GET["search_destination"]) && isset($_GET["checkbox"]) && isset($_GET["submit"]) && !empty($_GET["search_depart"]) && !empty($_GET["search_destination"])){

                    $search_depart = trim(mysqli_real_escape_string($conn , $_GET["search_depart"]));
                    $search_destination = trim(mysqli_real_escape_string($conn , $_GET["search_destination"]));
                    $check_direction = mysqli_real_escape_string($conn  , $_GET["checkbox"]);

                    if($check_direction == "alger"){

                        $sql = "SELECT * FROM emploi_temps WHERE direction='aller' ORDER BY B134 , B104 , B136 , B144 , B140";

                        $result = mysqli_query($conn , $sql);

                        $start_found = false;
                        $montant = 0;

                        if(mysqli_num_rows($result) > 0){
                        ?>
                            <table>
                                <caption>l'itinéraire</caption>
                                <tr>
                                    <th>gares</th>
                                    <th>B134</th>
                                    <th>104</th>
                                    <th>B136</th>
                                    <th>B144</th>
                                    <th>B140</th>
                                </tr>
                        <?php

                            while($row = mysqli_fetch_array($result)){

                                if(!$start_found){

                                    if(strcasecmp(trim($row["gare"]), $search_depart) == 0){

                                        $start_found = true;
                                        $montant += 10;

                                        $B134_d =  substr($row['B134'], 0, 5);  
                                        $B104_d =  substr($row['B104'], 0, 5);
                                        $B136_d =  substr($row['B136'], 0, 5);
                                        $B144_d =  substr($row['B144'], 0, 5);
                                        $B140_d =  substr($row['B140'], 0, 5);

                                        echo "<tr>
                                                <td>{$row['gare']}</td>
                                                <td>$B134_d</td>
                                                <td>$B104_d</td>
                                                <td>$B136_d</td>
                                                <td>$B144_d</td>
                                                <td>$B140_d</td>
                                            </tr>";

                                    }
                                }else{
                                    if($start_found){
                                        $montant += 15;
                                        echo "<tr>
                                                <td>{$row['gare']}</td>
                                                <td>" . substr($row['B134'], 0, 5) . "</td>
                                                <td>" . substr($row['B104'], 0, 5) . "</td>
                                                <td>" . substr($row['B136'], 0, 5) . "</td>
                                                <td>" . substr($row['B144'], 0, 5) . "</td>
                                                <td>" . substr($row['B140'], 0, 5) . "</td>
                                            </tr>";

                                    }
                                }

                                if(strcasecmp(trim($row["gare"]), $search_destination) == 0){
                                        $B134_f =  substr($row['B134'], 0, 5);  
                                        $B104_f =  substr($row['B104'], 0, 5);
                                        $B136_f =  substr($row['B136'], 0, 5);
                                        $B144_f =  substr($row['B144'], 0, 5);
                                        $B140_f =  substr($row['B140'], 0, 5);

                                    break;
                                }
                            }
                            ?>
                                <tr style="color:rgb(0, 86, 245);">
                                    <td>la durée du traget</td>
                                    <td><?php echo (strtotime($B134_f) - strtotime($B134_d)) / 60 . " min"; ?></td>
                                    <td><?php echo (strtotime($B104_f) - strtotime($B104_d)) / 60 . " min"; ?></td>
                                    <td><?php echo (strtotime($B136_f) - strtotime($B136_d)) / 60 . " min"; ?></td>
                                    <td><?php echo (strtotime($B144_f) - strtotime($B144_d)) / 60 . " min"; ?></td>
                                    <td><?php echo (strtotime($B140_f) - strtotime($B140_d)) / 60 . " min"; ?></td>
                                </tr>
                                <tr>
                                    <td>montant du voyage</td>
                                    <td colspan="5"><?php echo $montant. " DA"; ?></td>
                                </tr>
                            
                            </table>
                    <?php

                        }
                    }
                    if($check_direction == "thenia"){

                        $sql = "SELECT * FROM emploi_temps WHERE direction='retour' ORDER BY B134 , B104 , B136 , B144 , B140";

                        $result = mysqli_query($conn , $sql);

                        $start_found = false;

                        if(mysqli_num_rows($result) > 0){
                        ?>
                            <table>
                                <caption>l'itinéraire</caption>
                                <tr>
                                    <th>gares</th>
                                    <th>B134</th>
                                    <th>104</th>
                                    <th>B136</th>
                                    <th>B144</th>
                                    <th>B140</th>
                                </tr>
                        <?php

                            while($row = mysqli_fetch_assoc($result)){

                                if(!$start_found){

                                    if(strcasecmp(trim($row["gare"]), $search_depart) == 0){

                                        $start_found = true;

                                        echo "<tr>
                                                <td>{$row['gare']}</td>
                                                <td>" . substr($row['B134'], 0, 5) . "</td>
                                                <td>" . substr($row['B104'], 0, 5) . "</td>
                                                <td>" . substr($row['B136'], 0, 5) . "</td>
                                                <td>" . substr($row['B144'], 0, 5) . "</td>
                                                <td>" . substr($row['B140'], 0, 5) . "</td>
                                            </tr>";

                                    }
                                }
                                if($start_found){
                                    echo "<tr>
                                            <td>{$row['gare']}</td>
                                            <td>" . substr($row['B134'], 0, 5) . "</td>
                                            <td>" . substr($row['B104'], 0, 5) . "</td>
                                            <td>" . substr($row['B136'], 0, 5) . "</td>
                                            <td>" . substr($row['B144'], 0, 5) . "</td>
                                            <td>" . substr($row['B140'], 0, 5) . "</td>
                                        </tr>";

                                }

                                if(strcasecmp(trim($row["gare"]), $search_destination) == 0){
                                    break;
                                }
                            }
                            ?>
                                </table>
                            <?php
                        }
                    }
                }
            ?>
            
        </div>
    </main>
    <script>
        function startDictation(inputId) {
            if (!('webkitSpeechRecognition' in window)) {
                alert("La reconnaissance vocale n'est pas prise en charge dans ce navigateur.");
                return;
            }

            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'fr-FR'; 
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                document.getElementById(inputId).value = transcript;
            };

            recognition.onerror = function(event) {
                console.error("Erreur de reconnaissance vocale :", event.error);
            };

            recognition.start();
        }
    </script>
</body>
</html>