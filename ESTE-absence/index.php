<?php
        include('inc/header.php');
        if(isset($_SESSION['ID']) ){// pour verivier si le client il est deja connecter ou non 
            header('Location:accueil.php');//redirection a la page d'accueil
        }
        //print_r($_SESSION);
?>
    <link rel="stylesheet" href="./style.css">
    <title>Login-Page-Absence</title>
</head>

<body>
    <div class="align-items-cneter wrapper">
        <div class="container">
            <div class="row">
                <div  class="col-lg-6 col-lg-offset-3 ">
                    <div class="login">

                        <h1 class="">BIENVENU LOGIN</h1>

                    
                        <!--loging form-->
                        <div class="">

                            <form action="verification.php" method="post">

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                                </div>

                                <div class="form-group">

                                    <label for="pwd">Password:</label>
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>

                                </div>

                                <div class="form-group">
                                    <label class="chk-btn" for="remember"><input class="chk-box" type="checkbox" name="remember"> Remember me </label>
                                    
                                </div>

                                    <button type="submit" class="btn-custm btn ">Submit</button>
                                    <?php
                                        if(isset($_SESSION['test'])){
                                            
                                            if($_SESSION['test'] == 1){
                                                ?>
                                                    <p><br></p>
                                                    <div class="alert alert-danger">Le mot de passe entré est incorrect.<br> <strong>Vous l’avez oublié ? : contacter le superviseur</strong></div>
                                                <?php
                                            }

                                            if($_SESSION['test'] == 0){
                                               
                                                ?>
                                                    <p><br></p>
                                                    <div class="alert alert-danger">Il n'y a pas de compte avec l'email que vous avez saisi.<br> <strong>Veuillez créer un compte : contacter le superviseur</strong></div>
                                                <?php
                                            }    
                                        }
                                    ?>
                            </form>

                        </div>
                        <!--login form end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>