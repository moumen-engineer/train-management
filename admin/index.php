<?php 
    session_start();

    include("../user/config.php");

    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['user_role'];

    if(!isset($user_id) || $user_role == "utilisateur"){               //verifier que le id est bien enregistré dans la session 
        header('location:../user/login.php');
    };

    if(isset($_GET['logout'])){   //si logout = true l'utilsateur clique sur le button de deconnexion 
        unset($user_id);
        unset($user_role);
        session_destroy();
        header('location:../user/login.php');
    };
    

    if (isset($_SESSION['message'])) {

        $message = [$_SESSION['message']];
        
        unset($_SESSION['message']);
    }

    if(isset($_POST["submit"])){
        $gare = mysqli_real_escape_string($conn , $_POST["gare"]);
        $B134 = mysqli_real_escape_string($conn , $_POST["B134"]);
        $B104 = mysqli_real_escape_string($conn , $_POST["B104"]);
        $B136 = mysqli_real_escape_string($conn , $_POST["B136"]);
        $B144 = mysqli_real_escape_string($conn , $_POST["B144"]);
        $B140 = mysqli_real_escape_string($conn , $_POST["B140"]);
        $direction = mysqli_real_escape_string($conn , $_POST["direction"]);

        $insert = "INSERT INTO emploi_temps (gare , B134 , B104 , B136 , B144 , B140 , direction) VALUES ('$gare' , '$B134' , '$B104' , '$B136' , '$B144' , '$B140' , '$direction')";

        if(mysqli_query($conn , $insert)){
            $_SESSION['message'] = "Trajet ajouté avec succès.";
        }  
        header("location:index.php");
        exit();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        header nav div {
            display: flex;
            flex-direction: row;
            gap: 26px;
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
        caption {
            margin-top: 60px;
            margin-bottom: 35px;
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        main {
            grid-area: main;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 90%;
            max-width: 900px;
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 120px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            min-width: 120px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0f3ea3;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        td {
            background-color: #f9f9f9;
            font-size: 13px;
            transition: background-color 0.3s ease;
        }

        tr td:first-child {
            font-weight: 600;
            background-color: #e6ecfa;
            color: #333;
        }

        tr:hover td {
            background-color:rgb(229, 236, 250);
        }

        footer {
            grid-area: footer;
        }

        main div{
            text-align: center;
        }
        main h2{
            margin-bottom: 40px;
            font-size: 30px;
            margin-top: 50px;
        }
        .form-container {
            margin-left: 195px;
            margin-top: 60px;
            width: 450px;
            height: 635px;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 10px;
            box-sizing: border-box;
            padding: 20px 30px;
        }

        .title {
            text-align: center;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                    "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
            margin: 10px 0 30px 0;
            font-size: 28px;
            font-weight: 800;
        }

        .form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-bottom: 15px;
        }

        .input {
            height: 42.5px;
            border-radius: 20px;
            border: 1px solid  #c0c0c0;
            outline: 0 !important;
            box-sizing: border-box;
            padding: 12px 15px;
        }

        .form-btn {
            padding: 10px 15px;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                    "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
            border-radius: 20px;
            border: 0 !important;
            outline: 0 !important;
            background: rgb(28, 98, 250);
            color: white;
            cursor: pointer;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .form-btn:active {
            box-shadow: none;
        }

        .modal {
            display: block; 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
            justify-content: center;
            align-items: center;
            z-index: 1000;
            overflow: auto;
        }

        .modal-content {
            padding-top: 30px;
            height: 280px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
            border-radius: 16px;
            box-shadow: 0 0 10px 2px rgb(36, 36, 36);
            overflow: hidden;
            background-color: #fff;
            margin: 270px auto;
            border-radius: 10px;
            width: 70%; 
            max-width: 400px;
            text-align: center;
        }
        .modal-actions{
            display: flex;
            justify-content: center;
            gap: 1rem; 
            margin-top: 5px;
        }
        .modal-fermer{
            margin-top: 30px;
        }
        .fermer {
            height: 33px;
            padding:5px;
            background-color: #eee;
            border: none;
            font-size: 0.9rem;
            font-weight: bold;
            width: 7.5em;
            border-radius: 1rem;
            color: rgb(236, 91, 91);
            box-shadow: 0 0 6px 1px rgb(201, 199, 199);
            cursor: pointer;
        }
        .supprimer{
            margin-right: 10px;
            color: rgb(255, 66, 41);
        }
        .fermer:active {
            color: white;
            box-shadow: 0 0.2rem #dfd9d9;
            transform: translateY(0.2rem);
        }

        .fermer:hover:not(:disabled) {
            background:rgb(236, 91, 91);
            color: white;
            transition: all 0.6s ;
        }

        .fermer:disabled {
            cursor: auto;
            color: grey;
        }
        .modal .modal-content p{
            margin-top: 10px;
        }
        .Btn {
            font-size: 15px;
            margin-left: 10px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 125px;
            height: 32px;
            border: none;
            padding: 0px 15px;
            color: white;
            font-weight: 500;
            background-color: rgb(28, 98, 250);
            cursor: pointer;
            border-radius: 10px;
            transition-duration: .3s;
        }

        .svg {
            width: 13px;
            position: absolute;
            right: 0;
            margin-right: 15px;
            fill: white;
            transition-duration: .3s;
        }
        #modifier:hover{
            color: transparent; 
            background-color: rgb(42, 136, 249);
        }

        .Btn:hover {
            color: transparent; 
            background-color: rgb(236, 91, 91);
        }

        .Btn:hover svg {
            right: 43%;
            margin: 0;
            padding: 0;
            border: none;
            transition-duration: .3s;
        }

        .Btn:active {
            transform: translate(3px , 3px);
            transition-duration: .3s;
            box-shadow: 2px 2px 0px rgb(140, 32, 212);
        }
        .home-icon:hover{
            color: #eee;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.09);
            transition: all 1s ease;
        }
        /* From Uiverse.io by micaelgomestavares */ 
        .formpass {
        display: flex;
        flex-direction: column;
        gap: 10px;
        background-color: #ffffff;
        padding: 30px;
        width: 450px;
        border-radius: 20px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        ::placeholder {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .formpass button {
        align-self: flex-end;
        }

        .flex-column > label {
        color: #151717;
        font-weight: 600;
        }

        .inputForm {
        border: 1.5px solid #ecedec;
        border-radius: 10px;
        height: 50px;
        display: flex;
        align-items: center;
        padding-left: 10px;
        transition: 0.2s ease-in-out;
        }

        .inputpass {
        margin-left: 10px;
        border-radius: 10px;
        border: none;
        width: 85%;
        height: 100%;
        }

        .inputpass:focus {
        outline: none;
        }

        .inputForm:focus-within {
        border: 1.5px solid #2d79f3;
        }

        .flex-row {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 10px;
        justify-content: space-between;
        }

        .flex-row > div > label {
        font-size: 14px;
        color: black;
        font-weight: 400;
        }

        .span {
        font-size: 14px;
        margin-left: 5px;
        color: #2d79f3;
        font-weight: 500;
        cursor: pointer;
        }

        .button-submit {
        margin: 10px 0 10px 0;
        background-color: #151717;
        border: none;
        color: white;
        font-size: 15px;
        font-weight: 500;
        border-radius: 10px;
        height: 50px;
        width: 100%;
        cursor: pointer;
        }

        .button-submit:hover {
        background-color:rgb(9, 61, 173);
        transition: all 0.3s ease;
        }
        #modalpass {
            display: none; 
            position: fixed;
            top: 0; left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
    
    

    </style>
</head>
<body>
    <header>
        <nav>
            <h1>Horaires des trains</h1>
            <div>
                <button class="home-icon" id = "btn-open-modal" title="changer le mot de passe">
                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="white" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg>
                </button>
                <a href="index.php?logout=true" onclick="return confirm('etes-vous sur de vouloir vous deconnecter le compte admin ?');" style="color: white; margin-right: 40px;" class="home-icon" title="Déconnexion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                </a>
            </div>
            
        </nav>
    </header>
             <div id="modalpass"> 
                <?php
                    $mssgtrue = false;
                    $mssgfalse = false;
                    $mssgconfirm = false;
                    if(isset($_POST['updatepass'])){                        //updatepass le nom du button de type submit
                        $currentpass = mysqli_real_escape_string($conn , md5($_POST['currentpass']));
                        $newpass = mysqli_real_escape_string($conn , md5($_POST['newpass']));
                        $confirmnewpass = mysqli_real_escape_string($conn , md5($_POST['confirmnewpass']));

                        $sql = "SELECT password FROM user WHERE id = $user_id";
                        $result = mysqli_query($conn ,$sql);

                        $row = mysqli_fetch_assoc($result);

                        if($newpass == $confirmnewpass){

                            if($row['password'] == $currentpass){
                                $sqli = "UPDATE user SET password = '$newpass' WHERE id = $user_id";
                                if(mysqli_query($conn, $sqli)){
                                    $mssgtrue = true;
                                }
                            }else{
                                $mssgfalse = true;
                            }
                        }else{
                            $mssgconfirm =true;
                        }
                        
                    }
                ?>
                <form class="formpass" method="post" action="">
                    <button id="closeBtn" type="button" style="font-size: 30px;">&times;</button>
                    <?php
                        if ($mssgtrue) {
                            echo '<p style="color: white; background-color: green; padding: 10px; text-align: center;" onclick = "this.remove();">le mot de passe a été modifié avec succès</p>';
                            
                        }
                        if($mssgfalse){
                            echo '<p style="color: white; background-color: red; padding: 10px; text-align: center;" onclick = "this.remove();">le mot de passe courant est incorrect !</p>';
                        }
                        if($mssgconfirm){
                            echo '<p style="color: white; background-color: orange; padding: 10px; text-align: center;" onclick = "this.remove();">la confirmation du mot de passe est incorrect !</p>';
                        }
                    ?>
                    <div class="flex-column">
                    
                        <div class="flex-column" style="margin-bottom: 7px;">
                            <label >Mot de passe courant </label></div>
                        <div class="inputForm">
                            <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path><path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path></svg>        
                            <input type="password" class="inputpass" name="currentpass" placeholder="mot de passe courant" required minlength = "8" maxlength="20" id="password">
                            <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" id="togglePassword"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                        </div>
                        <br>
                        <div class="flex-column" style="margin-bottom: 7px;">
                            <label >Nouveau mot de passe </label></div>
                        <div class="inputForm">
                            <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path><path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path></svg>        
                            <input type="password" class="inputpass" name="newpass" placeholder=" nouveau mot de passe" required minlength = "8" maxlength="20" id="password">
                            <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" id="togglePassword"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                        </div>
                        <br>
                        <div style="margin-bottom: 7px;" class="flex-column">
                            <label >confirmation du nouveau mot de passe </label></div>
                        <div class="inputForm" style="margin-bottom: 20px;">
                            <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path><path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path></svg>        
                            <input type="password" class="inputpass" name="confirmnewpass" placeholder="confirmer le nouveau mot de passe" required minlength = "8" maxlength="20" id="password">
                            <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" id="togglePassword"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                        </div>
                        
                        <button class="button-submit" type = "submit" name="updatepass">Confirmer</button>
                    </div>
                </form>
            </div>
    <main>
        <div>
            <?php 
                if (isset($message)) {
                    echo '<div class="w-full flex justify-center mt-4">';
                    foreach($message as $message){
                        echo ' 
                            <div class="flex flex-col gap-2 w-60 sm:w-72 text-[10px] sm:text-xs z-50" onclick = "this.remove();">
                                <div class="succsess-alert cursor-default flex items-center justify-between w-full h-12 sm:h-14 rounded-lg bg-[#232531] px-[10px]">
                                    <div class="flex gap-2">
                                        <div class="text-[#2b9875] bg-white/5 backdrop-blur-xl p-1 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white">' . $message . '</p>
                                            <p class="text-gray-500">cliquer ici pour quiter cette section</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                    echo '</div>';
                }
            ?>
            <img src="../assets/images/SNTF.svg.png" alt="le logo n'est pas visible" style="margin-left: 337px; margin-top: 50px;" width="160px" height="160px">
            <h2>panneau de controle administrateur </h2>
            <div class="form-container">
                <p class="title">ajouter un traget</p>
                <form class="form" method="post">
                    <input type="text" name = "gare" class="input" placeholder="nom de la gare" required>
                    <label style="font-size: 15px; text-align: start; color: gray; margin-left: 7px;">l'heure d'arrivée et de départ :</label>
                    <input type="text" name="B134" class="input" placeholder="train B134">
                    <input type="text" name="B104" class="input" placeholder="train 104">
                    <input type="text" name="B136" class="input" placeholder="train B136">
                    <input type="text" name="B144" class="input" placeholder="train B144">
                    <input type="text" name="B140" class="input" placeholder="train B140">
                    <select class="input" name="direction" required>
                        <option value="" disabled selected hidden>Choisissez la direction</option>
                        <option value="aller">aller</option>
                        <option value="retour">retour</option>
                    </select>
                    <input type="submit" name="submit" class="form-btn" value="ajouter">
                </form>
            </div>
              
            <table>
                <caption>gestion d'emploi de temps</caption>
                <tr id="modal">
                    <th>gares</th>
                    <th>B134</th>
                    <th>104</th>
                    <th>B136</th>
                    <th>B144</th>
                    <th>B140</th>
                    <th>direction</th>
                </tr>
                <?php 
                    $result = mysqli_query($conn , "SELECT * FROM emploi_temps ORDER BY B134 , B104 , B136 , B144 , B140 ");
                    while($row = mysqli_fetch_array($result)){

                        $B134 =  substr($row['B134'], 0, 5 /*nombre de caractere ex: 13:45  = 5 */);  //   fonction pour extraire une sous chaine de caractere [ substr(string $string, int $start, int $length): string ]
                        $B104 =  substr($row['B104'], 0, 5);
                        $B136 =  substr($row['B136'], 0, 5);
                        $B144 =  substr($row['B144'], 0, 5);
                        $B140 =  substr($row['B140'], 0, 5);

                        echo "
                            <tr id='table' onclick=\"window.location.href='index.php?show=gares&id={$row['id']}#modal'\" style='cursor: pointer';>
                                    <td>{$row['gare']}</td>
                                    <td>$B134</td>
                                    <td>$B104</td>
                                    <td>$B136</td>
                                    <td>$B144</td>
                                    <td>$B140</td>
                                    <td>{$row['direction']}</td>
                            </tr>
                        ";
                    } 
                    if(isset($_GET["show"]) && $_GET["show"] == 'gares' && isset($_GET["id"])) {

                        $id = $_GET["id"];
                        $query = "SELECT id , gare , direction FROM emploi_temps WHERE id = '$id'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="modal">';
                            $row = mysqli_fetch_assoc($result);
                            if ($row) {
                                echo "<div class='modal-content'>";
                                echo "<p style='font-weight: bold;'> mise à jour des gares</p>";
                                echo "<p>La gare : "  . $row['gare'] . "</p>";
                                echo "<p>La direction : "  . $row['direction'] . "</p>";
                                echo "<br>";
                                echo "<div class = 'modal-actions'>";
                                echo "<a href='delete.php?id={$row['id']}#table'><button class='Btn'>supprimer<svg class='svg' xmlns='http://www.w3.org/2000/svg' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'><path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/></svg></button></a>";
                                echo "<a href='update.php?id={$row['id']}#table'> <button class='Btn' id='modifier'>modifier<svg class='svg' viewBox='0 0 512 512'><path d='M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z'></path></svg></button>
                                    </a>";
                                echo "</div>";
                                echo "<div class = 'modal-fermer'>";
                                echo "<a href='index.php#table'><button class='fermer'>fermer</button></a>";
                                echo "</div>";
                            }
                            echo "</div>";
                        }
                    }   
                    
                ?>
            </table>
        </div>
    </main>
    <footer>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const openBtn = document.getElementById('btn-open-modal');
            const closeBtn = document.getElementById('closeBtn');

            openBtn.addEventListener('click', () => {
                modalpass.style.display = 'flex';
            });

            closeBtn?.addEventListener('click', () => {
                modalpass.style.display = 'none';
            });
        });
        <?php if($mssgfalse || $mssgtrue || $mssgconfirm){?>
            document.addEventListener("DOMContentLoaded", () => {
                const modal = document.getElementById("modalpass");
                if (modal) {
                    modal.style.display = "flex";
                }
            });
        <?php } ?>
        const passwordField = document.getElementById("password");  // recuperer le id de input type=password
        const toggleIcon = document.getElementById("togglePassword");  //icon d'oeil recuperer le id 

        toggleIcon.addEventListener("click", function () { //lorsque on clique sur l'oeil
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";  // recuperer la valeur de l'attribut type et l'affecte soit passsword or text
            passwordField.setAttribute("type", type);  //set la valeur de type dans l'atribut de input type = password
        });
    </script>
</body>
</html>