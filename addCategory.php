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
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <?php

        use backendless\Backendless;
        use backendless\model\BackendlessUser;
        use backendless\exception\BackendlessException;
        use backendless\services\persistence\BackendlessDataQuery;

include_once './backendless/autoload.php';
        Backendless::initApp('0F8F33A0-5515-0C9B-FFCB-F8A0A3E92A00', 'B1ACD24E-02A7-E964-FFA0-7D0ABB2FFD00', 'v1');
        if (isset($_SESSION['becu'])) {
            try {
                $currentUser = new BackendlessUser();
                $currentUser = $_SESSION['becu'];
                if ($currentUser == NULL) {
                    echo 'no current user';
                } else {
                    //echo $currentUser->getEmail();
                    //echo 'worked';
                }
            } catch (BackendlessException $ex) {
                echo $ex->getMessage();
            }
        } else {
            die("<script>location.href = 'index.php'</script>");
            echo 'no becu in session';
        }
        include_once './deenQA_lib.php';
        ?>
        <title>Home</title>
    </head>
    <body style="background-color: #245580;">
        <div class="container">
            <nav class="navbar navbar-default">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="home.php">Insert QA</a></li>
                    <li role="presentation"><a href="browse.php">Browse QA</a></li>
                    <li role="presentation" class="active"><a href="addCategory.php">Add Category</a></li>
                    <li role="presentation"><a href="newQA.php">New QA</a></li>
                    <li role="presentation" class="navbar-right" style="padding-right: 20px;"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
            <div style="padding: 100px;">
                <form action="addCategory.php" method="post" class="pure-form pure-form-aligned">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add category</h3>
                        </div>
                        <div class="panel-body">
                            <fieldset>
                                <div class="pure-control-group">
                                    <label>Category</label>
                                    <input type="text"  name="cat" class="pure-input-1-2" required>
                                </div>
                            </fieldset>
                        </div>
                        <div style="color: #23527c; font-size: large; padding-left: 20px;">
                            <?php
                            if (isset($_POST['addCat'])) {
                                $cat = filter_input(INPUT_POST, 'cat');
                                $category = new Category($cat);
                                try {
                                    $savedCat = Backendless::$Persistence->save($category);
                                    if($savedCat !== NULL)
                                    {
                                        echo 'Alhamdulillah! Saved.';
                                    }
                                } catch (BackendlessException $ex) {
                                    if($ex->getCode() === 36)
                                    {
                                        echo 'Masha Allah! Already saved once before.';
                                    }  else {
                                        echo $ex->getMessage();
                                    }
                                    
                                }
                            }
                            ?>
                        </div>
                        <div class="panel-footer">
                            <button  name="addCat" type="submit" class="pure-button btn-success" style="float: right" >Add</button>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="panel-body">
                            <?php
                                $query = new BackendlessDataQuery();
                                $query->setPageSize(100);
                                try{
                                $data = Backendless::$Data->of('Category')->find($query);
                                $data = $data->getAsArray();
                                $data = array_reverse($data);
                                echo '<h3>Already saved category</h3>';
                                $i = 1;
                                foreach ($data as $d)
                                {
                                    echo $i++.'. '.$d['cat'].' <a href="deleteCat.php?q='.$d['objectId'].'">Delete</a><br>';
                                }
                                }  catch (BackendlessException $ex)
                                {
                                    echo $ex->getMessage();
                                }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
