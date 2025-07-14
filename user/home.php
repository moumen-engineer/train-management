<?php

include 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){               //verifier que le id est bien enregistré dans la session 
        header('location:login.php');
    };

    if(isset($_GET['logout'])){   //si logout = true l'utilsateur clique sur le button de deconnexion 
        unset($user_id);
        session_destroy();
        header('location:login.php');
    };

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page</title>
    <link rel="stylesheet" href="\EmploiDeTemps\assets\CSS\style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
            margin-bottom: 35px;
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        main div {
            grid-area: main;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;và-
            margin-top:20px;
            margin-bottom: 50px;
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 98%;
            max-width: 900px;
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 2 10px 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: center;
            min-width: 100px;
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
            background-color:rgb(231, 239, 255);
        }

        footer {
            grid-area: footer;
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
            gap:20px;
            padding-top: 30px;
            height: 283px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
            border-radius: 16px;
            box-shadow: 0 0 10px 2px rgb(36, 36, 36);
            overflow: hidden;
            background-color: #fff;
            margin: 20px auto;
            border-radius: 10px;
            width: 90%; 
            max-width: 400px;
            text-align: center;
        }
        .card-description {
            display: flex;
            position: absolute;
            gap: .5em;
            flex-direction: column;
            background-color: #05318f;
            color: #eee;
            height: 80%;
            bottom: 0;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            transition: all 1s cubic-bezier(0.645, 0.045, 0.355, 1);
            padding: 1rem;
        }

        .text-title {
            font-size: 1.4rem;
            font-weight: 700;
        }

        .text-body {
            font-size: 0.9rem;
            line-height: 130%;
        }
        
        .modal-content:hover .card-description {
            transform: translateY(100%);
        }
        .modal .modal-content button {
            height: 37px;
            padding: 0px;
            margin-top: 20px;
            background-color: #eee;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            width: 7em;
            border-radius: 1rem;
            color: rgb(236, 91, 91);
            box-shadow: 0 0 6px 1px rgb(201, 199, 199);
            cursor: pointer;
        }

        .modal .modal-content button:active {
            color: white;
            box-shadow: 0 0.2rem #dfd9d9;
            transform: translateY(0.2rem);
        }

        .modal .modal-content button:hover:not(:disabled) {
            background:rgb(236, 91, 91);
            color: white;
            transition: all 0.6s ;
        }

        .modal .modal-content button:disabled {
            cursor: auto;
            color: grey;
        }
        .modal .modal-content .paragraph{
            margin: 15px;
        }
        

        #checkbox {
            display: none;
        }

        .toggle {
            margin-right: 30px;
            position: relative;
            width: 37px;
            height: 31px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8.5px;
            transition-duration: .3s;
        }

        .bars {
            width: 100%;
            height: 4px;
            background-color: rgb(253, 255, 243);
            border-radius: 5px;
            transition-duration: .3s;
        }

        #checkbox:checked + .toggle #bar2 {
            transform: translateY(14px) rotate(60deg);
            margin-left: 0;
            transform-origin: right;
            transition-duration: .3s;
            z-index: 2;
        }

        #checkbox:checked + .toggle #bar1 {
            transform: translateY(28px) rotate(-60deg);
            transition-duration: .3s;
            transform-origin: left;
            z-index: 1;
        }

        #checkbox:checked + .toggle {
            transform: rotate(-90deg);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <h1>Horaires des trains</h1>
            <div class = "nav-icons">
                <?php 
                    if(isset($_GET["show"]) && $_GET["show"] == 'info') {
                        $query = "SELECT * FROM user WHERE id = '$user_id'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<div id="modal" class="modal">';
                            $row = mysqli_fetch_assoc($result);
                            if ($row) {
                                echo "<div class='modal-content'>";
                                echo "<p class='paragraph'>Nom : " . $row['nom'] . "</p>";
                                echo "<p class='paragraph'>Vous êtres : " . $row['role'] . "</p>";
                                echo "<p class='paragraph'>Email :  " . $row['email'] . "</p>";
                                echo "<p class='paragraph'>Adresse :  " . $row['adresse'] . "</p>";
                                echo "<a href='home.php'><button>fermer</button></a>";
                                echo "<div class='card-description'>
                                            <p class='text-title'> afficher mes informations personnelles</p>
                                            <p class='text-body'>Survolez cette zone avec la souris pour consulter vos informations personnelles.</p>
                                        </div> ";
                                echo "</div>";
                            }
                            echo "</div>";
                        }
                    }   
                ?>
                <?php
                    $select_user = mysqli_query($conn, "SELECT nom FROM `user` WHERE id = '$user_id'") or die('erreur de query');
                    if(mysqli_num_rows($select_user) > 0){
                        $row_user = mysqli_fetch_assoc($select_user);
                    };                
                ?>

                <input id="checkbox" type="checkbox">
                <label class="toggle" for="checkbox">
                    <div id="bar1" class="bars"></div>
                    <div id="bar2" class="bars"></div>
                    <div id="bar3" class="bars"></div>
                </label>
                <div id="sideMenu" class="hidden fixed top-[80px] right-4 z-50 bg-white rounded-xl shadow-lg border border-gray-200 w-72"> 
                    <div style="height: 260px;"
                    class="max-w-xs w-full bg-white border border-gray-200 rounded-xl overflow-hidden shadow-[0_10px_25px_-5px_rgba(0,0,0,0.05),0_8px_10px_-6px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_25px_-5px_rgba(0,0,0,0.08),0_15px_15px_-6px_rgba(0,0,0,0.06)] transition-all duration-300"
                    >
                    <div
                        class="px-4 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-700 to-blue-600"
                    >
                        <p class="text-xs font-medium text-blue-200 uppercase tracking-wider">
                        Session active :
                        </p>
                        <div class="flex items-center mt-1">
                        <div
                            class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center mr-2"
                        >
                            <svg
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            class="h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                clip-rule="evenodd"
                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                fill-rule="evenodd"
                            ></path>
                            </svg>
                        </div>
                        <p
                            class="text-sm font-medium text-white truncate hover:after:w-full relative after:absolute after:bottom-[-2px] after:left-0 after:w-0 after:h-px after:bg-[#2b6cb0] after:transition-all after:duration-300"
                        >
                        <?php 
                            echo $row_user["nom"];
                        ?>
                            
                        </p>
                        </div>
                    </div>

                    <div class="py-1.5">
                        <a
                        href="home.php?show=info" 
                        class="group relative flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 transition-all duration-200"
                        >
                        <div
                            class="absolute left-0 top-0 h-full w-1 bg-blue-500 rounded-r opacity-0 group-hover:opacity-100 transition-all duration-200 group-hover:scale-y-100 scale-y-80"
                        ></div>
                        <div
                            class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mr-3 group-hover:bg-blue-200 transition-colors duration-200"
                        >
                            <svg
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            class="h-5 w-5 text-blue-600 group-hover:text-[#2b6cb0]"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                clip-rule="evenodd"
                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                fill-rule="evenodd"
                            ></path>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700 group-hover:text-[#1a365d]"
                            >Mes informations</span
                        >
                        <svg
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            class="h-3 w-3 text-gray-400 ml-auto group-hover:text-[#2b6cb0]"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            clip-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            fill-rule="evenodd"
                            ></path>
                        </svg>
                        </a>

                        <a
                            href="route.php"
                            class="group relative flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 transition-all duration-200"
                        >
                        <div
                            class="absolute left-0 top-0 h-full w-1 bg-blue-600 rounded-r opacity-0 group-hover:opacity-100 transition-all duration-200 group-hover:scale-y-100 scale-y-80"
                        ></div>
                        <div
                            class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mr-3 group-hover:bg-blue-200 transition-colors duration-200"
                        >
                            <svg
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                class="h-5 w-5 text-blue-600 group-hover:text-[#2b6cb0]"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM9 8.466V7H7.5A1.5 1.5 0 0 0 6 8.5V11H5V8.5A2.5 2.5 0 0 1 7.5 6H9V4.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L9.41 8.658A.25.25 0 0 1 9 8.466"/>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700 group-hover:text-[#1a365d]"
                            >l'iténiraire</span
                        >
                        <svg
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            class="h-3 w-3 text-gray-400 ml-auto group-hover:text-[#2b6cb0]"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            clip-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            fill-rule="evenodd"
                            ></path>
                        </svg>
                        </a>

                        <a href="home.php?logout=true" onclick="return confirm('etes-vous sur de vouloir vous deconnecter ?');"
                            class="group relative flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 transition-all duration-200"
                        >
                        <div
                            class="absolute left-0 top-0 h-full w-1 bg-red-500 rounded-r opacity-0 group-hover:opacity-100 transition-all duration-200 group-hover:scale-y-100 scale-y-80"
                        ></div>
                        <div
                            class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center mr-3 group-hover:bg-red-200 transition-colors duration-200"
                        >
                            <svg
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            class="h-5 w-5 text-red-500 group-hover:text-red-600"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                clip-rule="evenodd"
                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                fill-rule="evenodd"
                            ></path>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700 group-hover:text-red-600"
                            >Déconnexion</span
                        >
                        <svg
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            class="h-3 w-3 text-gray-400 ml-auto group-hover:text-red-500"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            clip-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            fill-rule="evenodd"
                            ></path>
                        </svg>
                        </a>
                    </div>
                    </div>

                </div>

            </div>
            
        </nav>
    </header>
    <main>
        <div style="width: 63%;">
            <img src="../assets/images/SNTF.svg.png" alt="le logo n'est pas visible" style="margin-bottom: 50px;" width="152px" height="95px">
            <table>
                <caption>l'emploi de temps</caption>
                <tr>
                    <th>gares</th>
                    <th>B134</th>
                    <th>104</th>
                    <th>B136</th>
                    <th>B144</th>
                    <th>B140</th>
                </tr>
                <?php 
                    $result = mysqli_query($conn , "SELECT * FROM emploi_temps ORDER BY B134 , B104 , B136 , B144 , B140");

                    while($row = mysqli_fetch_array($result)){
                        if($row['direction'] == "aller"){
                            $B134 =  substr($row['B134'], 0, 5 /*nombre de caractere ex: 13:45  = 5 */);  //   fonction pour extraire une sous chaine de caractere [ substr(string $string, int $start, int $length): string ]
                            $B104 =  substr($row['B104'], 0, 5);
                            $B136 =  substr($row['B136'], 0, 5);
                            $B144 =  substr($row['B144'], 0, 5);
                            $B140 =  substr($row['B140'], 0, 5);
                            echo "
                                <tr>
                                    <td>{$row['gare']}</td>
                                    <td>$B134</td>
                                    <td>$B104</td>
                                    <td>$B136</td>
                                    <td>$B144</td>
                                    <td>$B140</td>
                                </tr>            
                            ";
                        }
                    }
                ?>

            </table>
            <br>
            <br>
            <br>
            <br>
            <table>
                <tr>
                    <th>gares</th>
                    <th>B134</th>
                    <th>104</th>
                    <th>B136</th>
                    <th>B144</th>
                    <th>B140</th>
                </tr>
                <?php 
                    $result = mysqli_query($conn , "SELECT * FROM emploi_temps ORDER BY B134 , B104 , B136 , B144 , B140");

                    while($row = mysqli_fetch_array($result)){

                        if($row["direction"] == "retour"){
                            $B134 =  substr($row['B134'], 0, 5 /*nombre de caractere ex: 13:45  = 5 */);  //   fonction pour extraire une sous chaine de caractere [ substr(string $string, int $start, int $length): string ]
                            $B104 =  substr($row['B104'], 0, 5);
                            $B136 =  substr($row['B136'], 0, 5);
                            $B144 =  substr($row['B144'], 0, 5);
                            $B140 =  substr($row['B140'], 0, 5);
                            echo "
                                <tr>
                                    <td>{$row['gare']}</td>
                                    <td>$B134</td>
                                    <td>$B104</td>
                                    <td>$B136</td>
                                    <td>$B144</td>
                                    <td>$B140</td>
                                </tr>            
                            ";
                        }
                    }
                    
                ?>
            </table>
        </div>
    </main>
    <footer>
    </footer>
    <script>
        const checkbox = document.getElementById("checkbox");
        const menu = document.getElementById("sideMenu");

        checkbox.addEventListener("change", function () {
            if (this.checked) {
            menu.classList.remove("hidden");
            } else {
            menu.classList.add("hidden");
            }
        });

        // Fermer le menu quand on clique en dehors
        document.addEventListener("click", function (event) {
            if (!menu.contains(event.target) && !checkbox.contains(event.target)) {
                checkbox.checked = false;
                menu.classList.add("hidden");
            }
        });
    </script>
</body>
</html>