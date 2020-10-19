<?php
    session_start();
    if(isset($_POST['email']) AND isset($_POST['pwd'])){
        $_POST['email']=htmlspecialchars($_POST['email']);
        $_POST['pwd']=htmlspecialchars($_POST['pwd']);
        $bdd= new PDO('mysql:host=localhost;dbname=pfs','root','');
        $request = $bdd->prepare('SELECT nom, prenom ,email, `password` AS pwd, id FROM `user` WHERE email = ? ');
        $request->execute(array($_POST['email']));
        $s = 0; // une signe pour verifier si l'email est trouve ou non, si s rest 1 il s'agit que l'email non trouve pas
        while($donnees = $request->fetch()){
            $s = 1;
            if($donnees['email'] == $_POST['email'] AND $donnees['pwd'] == $_POST['pwd']){
                $_SESSION['ID']=$donnees['id'];
                $_SESSION['nom']=$donnees['nom'];
                $_SESSION['prenom']=$donnees['prenom'];

                
                //print_r($_SESSION);
                if( $_SESSION['ID'] == 1){
                    header('Location:admin.php');
                }else{
                    header('Location:accueil.php');
                }
            }else{
                $_SESSION['test']=1; //si le mote de passe est incorrect return 1
                header('Location:index.php');
                die('1');
            }
        }
            
            if($s != 1){// l'interet de la variable s est ici
                $_SESSION['test'] = 0;//si il ya pas de compte retun 0
                header('Location: index.php');//redirection a la page de login
                //echo $request->fetch().'fdsfsdf';
                //print_r($donnees);
                //die('0');
            }
    }else{
        header('Location: index.php');//redirection a la page de login
    }
?>