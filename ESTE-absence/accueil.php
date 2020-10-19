<?php
    include('inc/header.php');
    if(!isset($_SESSION['ID'])){// pour verivier si le client il est deja connecter ou non 
        header('Location: index.php');//redirection a la page de login
    }
    //print_r($_SESSION);
     $bdd= new PDO('mysql:host=localhost;dbname=pfs','root','');
     $request = $bdd->prepare('SELECT c.nom,c.id_module,c.semistre,c.filiere,p.jour,p.heur FROM cours as c Inner Join programme as p on p.ID_cours = c.ID WHERE c.ID_user = ? and p.jour = ? ORDER BY p.heur DESc');
     $request->execute(array($_SESSION['ID'], date('D')));
?>
    <title>accueil</title>

</head>
<body> 
        <nav class="navbar navbar-default">
            <div class="container">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="inc/disc.php"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <?php
                    echo '<h2 class="text-left col-lg-8">Salut M.'.$_SESSION['nom'].' '.$_SESSION['prenom'].'</h2>
                    ';
                ?>
                <h3 class="text-left col-lg-8 ">Choisissez le cour d'aujourd'hui : <?php 
                    switch(date('l')){
                        case 'Monday' : $day = 'Lundi'.' '.date('d/m/Y');break;
                        case 'Tuesday' : $day = 'Mardi'.' '.date('d/m/Y');break;
                        case 'Wednesday' : $day = 'Mercredi'.' '.date('d/m/Y');break;
                        case 'Thursday' : $day = 'Jeudi'.' '.date('d/m/Y');break;
                        case 'Friday' : $day = 'Vendredi'.' '.date('d/m/Y');break;
                        case 'Saturday' : $day = 'Samedi'.' '.date('d/m/Y');break;
                        case 'Sunday' : $day = 'Dimanche'.' '.date('d/m/Y');break;
                    }
                    echo $day;
                
                ?></h3>
                <!--<a href="index.php">back</a>-->
            </div>
                <?php
                    while($donnees= $request->fetch()){
                        echo    '
                            <form action="list.php" method="post">
                                    <div class="row">
                                        <input type="hidden" name="filiere" value="'.$donnees['filiere'].'">
                                        <input type="hidden" name="semistre" value="'.$donnees['semistre'].'">
                                        <input type="hidden" name="heur" value="'.$donnees['heur'].'">
                                        <button type="submit" class="text-center col-sm-8 col-sm-offset-2 btn btn-lg btn-default margin-top">'.$donnees['nom'].'-'.$donnees['filiere'].' S'.$donnees['semistre'].' '.date('H:i',strtotime($donnees['heur'])).'</button>
                                    </div>
                            </form>
                                ';
                    }
                ?>
            
        </div>
        
</body>
</html>