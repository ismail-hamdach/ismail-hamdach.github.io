    <?php
        include('inc/header.php');
        if(isset($_POST['filiere']) AND isset($_POST['semistre'])){
            $bdd = new PDO('mysql:host=localhost;dbname=pfs','root','');
            $request = $bdd->prepare('SELECT id, nom, prenom FROM `etudiant` WHERE semistre = ? AND filiere = ?');
            $filiere = $_POST['filiere'];
            $sem = $_POST['semistre'];
            $request->execute(array($sem,$filiere));
            switch($_POST['filiere']){
                    case 'IDSD' : $fi='Informatique Décisionnelle et Science de Données' ;break;
                    case 'GI' : $fi='Génie Informatique ' ;break;
                    case 'ER' : $fi='Energies Renouvelables ' ;break;
                    case 'TM' : $fi='Techniques de Management ' ;break;
                    case 'GODT' : $fi='Gestion des Organisations et des Destinations Touristiques ' ;break;
                    case 'GE' : $fi="Génie de l'Environnement" ;break;
            }
    ?>
    
    <title>liste des etudiants</title>
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
        <form action="enregistrer.php" method="post">
            <div class="col-lg-12 text-right">
                
            </div>
            <div class="col-lg-12">
                <?php> echo "<h2>Liste des etudiants de" .$fi." : s".$sem."</h2>";?>
            </div>
            <!--table-->
                <div class="table-responsive col-lg-12">          
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Absent</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                            while($donnees = $request -> fetch()){
                                $i++;
                                echo '
                                    <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$donnees['nom'].'</td>
                                    <td>'.$donnees['prenom'].'</td>
                                    <td><input type="checkbox" name="absent[]" value='.$donnees['id'].' ></td>
                                    </tr>
                                 ';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            <!--table-->
           
            <div class="text-right col-lg-12">
                <?php echo '<input type="hidden" name="heur" value ="'.$_POST['heur'].'">';?>
                <input type="submit" class="btn btn-info btn-sm margin-top " value="valider">
            </div> 
           
        </form>
    </div>
</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>

<?php
        }else{
            header('Location:accueil.php');
        }
?>
