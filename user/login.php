<?php 

    include 'config.php';

    session_start();

    if (isset($_POST["submit"])){
        $email = mysqli_real_escape_string($conn , $_POST["email"]);
        $pass = mysqli_real_escape_string($conn , md5($_POST["password"]));

        $select = mysqli_query($conn , "SELECT * FROM user WHERE email = '$email' AND password = '$pass'") or die("erreur de query");

        if(mysqli_num_rows($select) > 0){   // client existe dans la base 
            $row = mysqli_fetch_assoc($select);
            $_SESSION['user_id'] = $row['id'];  // affecter le id dans la session php 
            $_SESSION['user_role'] = $row['role'];
            if($row['role'] == "utilisateur"){
                header('location:home.php');
            }else{
                header('location:../admin/index.php');
            }   
            
        }else{
            $message[] = 'mot de passe ou email est incorrect !';
        }
    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login user</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(28, 98, 250);
        }
        .form-container {
            margin-top: 200px;
            width: 450px;
            height: 350px;
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
    <div class="containerlogin">
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
                                        <p class="text-gray-500">cliquer ici pour quiter cette section</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div>';
            }
            
            ?>
        <div class="form-container">
            <p class="title">Connexion</p>
            <form class="form" method="post">
                <input type="email" name = "email" class="input" placeholder="Email" required>
                <input type="password" name="password" class="input" placeholder="Mot de passe" required>
                <input type="submit" name="submit" class="form-btn" value="connexion">
            </form>
            <p class="sign-up-label">
                vous n'avez pas de compte?<a href = "register.php" class="sign-up-link">creer un compte</a>
            </p>
        </div>        
    </div>  
</body>
</html>
