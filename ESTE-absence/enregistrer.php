<?php
    //print_r($_POST);
    if(isset($_POST['heur']) AND isset($_POST['absent'])){
        $bdd = new PDO('mysql:host=localhost;dbname=pfs','root','');
        $request = $bdd->prepare('INSERT INTO `absent`(`ID_etudiant`, `date`) VALUES (?,?)');
        $reponse = $bdd->prepare('SELECT `ID_etudiant`, `date` FROM `absent` WHERE date = ?');
        $absent = $_POST['absent'];
        switch($_POST['heur']){
            case 8  : $time= date("Y-m-d").' 08:30:00'; break;
            case 10 : $time= date("Y-m-d").' 10:30:00'; break;
            case 14 : $time= date("Y-m-d").' 14:30:00'; break;
            case 16 : $time= date("Y-m-d").' 16:30:00'; break;
            default: echo "<h1>Erreur: vous n'avez choisi pas l'heur. l'absence pas enregistrer!</h1>
                            <a href = 'list.php'>retour a la liste</a>
            ";
        }
        $reponse->execute(array($time));
        //pour tester si il est deja enregistrer des absent avant pour eviter a renregistrer l'absence deux fois
        $c = 0;
        while($donne = $reponse ->fetch()){
            $id[$c] = $donne['ID_etudiant'];
            $c++;
        }
        $N = count($absent);// contient le nombres des etudiants absent
        if($c != 0){//oui, il y'a des enregistrement pour cette seance
            for($i=0; $i < $N; $i++){
                $flag =0;
                for($j=0; $j<$c ; $j++){
                    if($absent[$i] == $id[$j]){
                        $flag = 1;//il y'a une etudiants il est deja enregistrer son absence
                    }
                }
                if($flag != 1){
                    $request->execute(array($absent[$i], $time));
                    //la nouvelle enregistrement
                }
            }
        }else{//non, il ne y'a pas des enregistrement pour cette seance
            for($i=0; $i < $N; $i++){
                    $request->execute(array($absent[$i], $time));
            }
        }
        include('inc/header.php')
        ?>
                <title>Enregistrer</title>
            </head>
            <body>
                <div class="align-items-cneter wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-lg-offset-0 text-center"><h1>enregistrement reussir</h1></div>
                            <div class="col-lg-8 col-lg-offset-2 text-center margin-top">
                                <div class="btn btn-lg btn-info"><a href="accueil.php">Retour a l'accueil</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        <?php
    }else{
        echo "<h1>Erreur: vous n'avez choisi pas l'heur. l'absence pas enregistrer!</h1>
                            <a href = 'list.php'>retour a la liste</a>
                            ";
    }
?>