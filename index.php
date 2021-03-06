<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="pure/pure-min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/iftaCss.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <?php

        use backendless\Backendless;
        use backendless\exception\BackendlessException;

        include_once './backendless/autoload.php';
        Backendless::initApp('0F8F33A0-5515-0C9B-FFCB-F8A0A3E92A00', 'B1ACD24E-02A7-E964-FFA0-7D0ABB2FFD00', 'v1');
        if (isset($_SESSION['becu'])) {
            die("<script>location.href = 'home.php'</script>");
        } else {
            //echo 'no becu in session';
        }
        ?>
        <title>DeenQA</title>
    </head>
    <body style="background-color: #245580;">
        <div class="container" style="padding: 300px; align-items: center;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <form class="pure-form" action="index.php" method="post">
                        <fieldset class="pure-group">
                            <input name="email" type="email" class="pure-input-1" placeholder="Email" required>
                            <input name="password" type="password" class="pure-input-1" placeholder="Password (6 charecter minimum)" required pattern=".{6,}">
                        </fieldset>
                        <button name="login" type="submit" class="pure-button pure-input-1 pure-button-primary">Login</button>
                    </form>
                    <?php
                    if (isset($_POST['login'])) {
                        $email = $_POST['email'];
                        $pass = $_POST['password'];
                        try {
                            $user = Backendless::$UserService->login($email, $pass);
                            if ($user === NULL) {
                                echo 'login failed!';
                            } else {
                                //echo $user->getEmail();
                                //echo 'CU'. Backendless::$UserService->getCurrentUser()->getEmail();;
                                $_SESSION['becu'] = $user->getUserToken();
                                die("<script>location.href = 'home.php'</script>");
                            }
                        } catch (BackendlessException $ex) {
                            if($ex->getCode() === 3003)
                            {
                                echo 'Invalid login.';
                            }
                            echo 'Exception ' . $ex->getMessage();
                        }
                    }
                    ?>
                </div>

            </div>

            <a href="register.php" class="pure-button pure-input-1 pure-button-primary">Need an account? Sign up.</a>

        </div>
    </body>
</html>
