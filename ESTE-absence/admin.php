<?php
    include('inc/header.php');
    if($_SESSION['ID'] != 1){
        header('Location:index.php');
    }
    $dbb = new PDO('mysql:host=localhost; dbname=pfs','root','');
    $reponse = $dbb->query("SELECT e.ID as ID_etudiant ,e.nom,e.prenom,e.semistre,e.filiere,date_format(absent.date,'%a') as jour,absent.date as `date d'absence`,c.nom as cours,m.nom as module FROM `absent` INNER JOIN etudiant as e ON absent.ID_etudiant=e.ID INNER JOIN programme as p on p.heur = date_format(absent.date, '%H:%i:%s') and p.jour = date_format(absent.date, '%a') INNER join cours as c on c.ID = p.ID_cours INNER JOIN module as m on m.ID = c.ID_module ORDER BY `date d'absence` DESC ");
?>
        <title>Admin</title>
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
            <div class="col-lg-12">
                <h1 class="text-center">Liste d'absence</h1>
            </div>
            <!--table-->
                <div class="table-responsive col-lg-12">          
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>ID_etudiant</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>semistre</th>
                            <th>filiere</th>
                            <th>jour</th>
                            <th>date</th>
                            <th>module</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                    
                            while($donnees = $reponse -> fetch()){

                                switch($donnees['jour']){
                                    case 'Mon' : $day = 'Lundi';break;
                                    case 'Tue' : $day = 'Mardi';break;
                                    case 'Wed' : $day = 'Mercredi';break;
                                    case 'Thu' : $day = 'Jeudi';break;
                                    case 'Fri' : $day = 'Vendredi';break;
                                    case 'Sat' : $day = 'Samedi';break;
                                    case 'Sun' : $day = 'Dimanche';break;
                                }
                            
                                echo '
                                    <tr>
                                        <td>'.$donnees['ID_etudiant'].'</td>
                                        <td>'.$donnees['nom'].'</td>
                                        <td>'.$donnees['prenom'].'</td>
                                        <td>S'.$donnees['semistre'].'</td>
                                        <td>'.$donnees['filiere'].'</td>
                                        <td>'.$day.'</td>
                                        <td>'.$donnees["date d'absence"].'</td>
                                        <td>'.$donnees['module'].'</td>
                                    </tr>
                                 ';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            <!--table-->
    </div>
    </body>
    </html>
