<?php 
    include 'config.php';

    session_start();

    if(isset($_POST["submit"])){

        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $adresse = mysqli_real_escape_string($conn , $_POST['adresse']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));   //md5() pour chiffré le mot passe en appliquant la focntion de hachage h(x)

        $select = mysqli_query($conn , "SELECT * FROM user WHERE email = '$email' AND password = '$pass'") or die('erreur de query');

        if(mysqli_num_rows($select) > 0){
            $message[] = "l'utilisateur exist déjà ! ";    
        }else{
                
            if($pass == $cpass){
                mysqli_query($conn, "INSERT INTO user (nom , adresse , email , password) VALUES('$name' , '$adresse', '$email' , '$pass')" ) or die("ereur de query");
                $message[] = 'la connection a été effectué avec succès!';
                header('location:login.php');
            }else{
                $message[] = "confirmation incorrect !";
            }
           
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(28, 98, 250);
        }
        .form-container {
            margin-top: 100px;
            width: 450px;
            height: 590px;
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
        border-radius: 20px;
        border: 1px solid #c0c0c0;
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

        .sign-up-label {
        margin-top: 30px;
        font-size: 12px;
        color: #747474;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        }

        .sign-up-link {
        margin-left: 1px;
        font-size: 13px;
        text-decoration: underline;
        text-decoration-color: teal;
        color: rgb(28, 98, 250);
        cursor: pointer;
        font-weight: 800;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        }

        .buttons-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        margin-top: 20px;
        gap: 15px;
        }
    </style>
</head>
<body>
    <div class="form_mssg">
        <br>
        <?php
            if (isset($message)) {
                echo '<div class="w-full flex justify-center mt-4">';
                foreach ($message as $message) {
                    echo ' 
                        <div class="flex flex-col gap-2 w-60 sm:w-72 text-[10px] sm:text-xs z-50" onclick = "this.remove();">
                            <div class="succsess-alert cursor-default flex items-center justify-between w-full h-12 sm:h-14 rounded-lg bg-[#232531] px-[10px]">
                                <div class="flex gap-2">
                                    <div class="text-[#2b9875] bg-white/5 backdrop-blur-xl p-1 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white">' . $message . '</p>
                                        <p class="text-gray-500">Section de description</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div>';
            }
            ?>
        <div class="form-container">
            <p class="title">création du nouveau compte</p>
            <form class="form" method="post">
                <input type="text" name = "name" class="input" placeholder="Nom">
                <input type="email" name = "email" class="input" placeholder="Email">
                <input type="text" name = "adresse" class="input" placeholder="Adresse">
                <input type="password" name="password" class="input" placeholder="Mot de passe" minlength ="8" maxlength="20">
                <input type="password" name = "cpassword" class="input" placeholder="Confirmation du mot de passe" minlength ="8" maxlength="20">
                <input type="submit" name="submit" class="form-btn" value="enregistrement du compte">
            </form>
            <p class="sign-up-label">
                avez vous déjà un compte?<a href = "login.php" class="sign-up-link">connexion</a>
            </p>
        </div> 
        
    </div>
</body>
</html>



