<?php 

    session_start(); 
    
    include("../user/config.php");
    
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['user_role'];

    if(!isset($user_id) || $user_role == "utilisateur"){               //verifier que le id est bien enregistré dans la session 
        header('location:../user/login.php');
    };

    
    if (isset($_SESSION['message']) && isset($_SESSION['situation'])) {
        $message = [$_SESSION['message']];
        $situation = $_SESSION['situation'];
        
        unset($_SESSION['message']);
        unset($_SESSION['situation']);
    }

    $ID = $_GET['id'];
    $up = mysqli_query($conn ,"SELECT * FROM emploi_temps WHERE id=$ID");
    $data = mysqli_fetch_array($up);

    if(isset($_POST['submit'])){

        $gare = mysqli_real_escape_string($conn , $_POST['gare']);
        $B134 = mysqli_real_escape_string($conn , $_POST['B134']);
        $B104 = mysqli_real_escape_string($conn , $_POST['B104']);
        $B136 = mysqli_real_escape_string($conn , $_POST['B136']);
        $B144 = mysqli_real_escape_string($conn , $_POST['B144']);
        $B140 = mysqli_real_escape_string($conn , $_POST['B140']);
        $direction = mysqli_real_escape_string($conn , $_POST['direction']);

        $update = "UPDATE emploi_temps SET gare = '$gare' , B134 = '$B134' , B104 = '$B104' , B136 = '$B136' , B144 = '$B144' , B140 = '$B140' , direction = '$direction' WHERE id = '$ID' ";

        if(mysqli_query($conn , $update)){
            $_SESSION['message'] = "la modification a été effectuée avec succès";
            $_SESSION['situation'] = true;
        } else {
            $_SESSION['message'] = "la modification n'a pas été effectuée !";
            $_SESSION['situation'] = false;
        }

        header("Location: update.php?id=$ID");
        exit();
    }
   





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mise à jour</title>
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
        main {
            grid-area: main;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        footer {
            grid-area: footer;
        }

        main div{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center; 
            text-align: center;
        }
        .form-container {
            margin-top: 60px;
            width: 450px;
            height: 625px;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 10px;
            box-sizing: border-box;
            padding: 20px 30px;
            margin-bottom: 100px;
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
        .home-icon{
            display: flex; 
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .home-icon:hover{
            color: #eee;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.09);
            transition: all 1s ease;
        }
        .div-message{
            display: flex;
            flex-direction: column;
        }

    </style>
</head>
<body>
    <header>
        <nav>
            <h1>Horaires des trains</h1>
            <div style = "margin-right: 20px;">
                <a href="index.php" class="home-icon" style="color: white; margin-right: 30px;">
                    <svg   xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                    </svg>
                
                    <p style="margin_top: 0px; margin-right: 0px; color: white;">Accueil</p>
                </a>
            </div>
            
        </nav>
    </header>
    <main>
        <div>
            <?php 
                if (isset($message)) {
                    if($situation == true){
                        echo '<div class="w-full flex justify-center mt-4">';
                        foreach($message as $message){
                            echo ' 
                                <div class="flex flex-col gap-2 w-60 sm:w-72 text-[10px] sm:text-xs z-50" onclick = "this.remove();" style="width:332px;">
                                    <div class="succsess-alert cursor-default flex items-center justify-between w-full h-12 sm:h-14 rounded-lg bg-[#232531] px-[10px]">
                                        <div class="flex gap-2" style="display: flex; flex-direction: row; padding-top: 12px;" >
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
                    }else{
                        echo '<div class="w-full flex justify-center mt-4">';
                        foreach ($message as $message) {
                            echo ' 
                                <div class="flex flex-col gap-2 w-60 sm:w-72 text-[10px] sm:text-xs z-50" onclick = "this.remove();">
                                    <div class="succsess-alert cursor-default flex items-center justify-between w-full h-12 sm:h-14 rounded-lg bg-[#232531] px-[10px]">
                                        <div class="flex gap-2">
                                            <div class="text-[#2b9875] bg-white/5 backdrop-blur-xl p-1 rounded-lg">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-6 h-6"
                                                    >
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" ></path>
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
                }
                
            ?>
            <img src="../assets/images/SNTF.svg.png" alt="le logo n'est pas visible" style="margin-top: 40px;" width="160px" height="100px">
            <div class="form-container">
                <p class="title">modification du traget</p>
                <form class="form" method="post">
                    <input type="text" name = "gare" class="input" placeholder="nom de la gare" required value=<?php echo $data['gare'];?>>
                    <label style="font-size: 15px; text-align: start; color: gray; margin-left: 7px;">l'heure d'arrivée et de départ :</label>
                    <input type="text" name="B134" class="input" placeholder="train B134" value=<?php echo substr($data['B134'], 0, 5);?>>
                    <input type="text" name="B104" class="input" placeholder="train 104" value=<?php echo substr($data['B104'], 0, 5);?>>
                    <input type="text" name="B136" class="input" placeholder="train B136" value=<?php echo substr($data['B136'], 0, 5);?>>
                    <input type="text" name="B144" class="input" placeholder="train B144" value=<?php echo substr($data['B144'], 0, 5);?>>
                    <input type="text" name="B140" class="input" placeholder="train B140" value=<?php echo substr($data['B140'], 0, 5);?>>
                    <select class="input" name="direction" required>
                        <option value="" disabled selected hidden>Choisissez la direction</option>
                        <option value="aller">aller</option>
                        <option value="retour">retour</option>
                    </select>
                    <input type="submit" name="submit" class="form-btn" value="modifier">
                </form>
            </div>
        </div>
    </main>
</body>
</html>