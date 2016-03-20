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
        use backendless\model\BackendlessUser;
        use backendless\exception\BackendlessException;
        use backendless\services\persistence\BackendlessDataQuery;
        use QA;

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
        <title>Review QA</title>
    </head>
    <body style="background-color: #D1D1D1;">
        <div class="container">
            <nav class="navbar navbar-default">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="home.php">Insert QA</a></li>
                    <li role="presentation"><a href="browse.php">Browse QA</a></li>
                    <li role="presentation"><a href="addCategory.php">Add Category</a></li>
                    <li role="presentation"><a href="newQA.php">New QA</a></li>
                    <li role="presentation" class="active"><a href="#">Review</a></li>
                    <li role="presentation" class="navbar-right" style="padding-right: 20px;"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
            <div class="panel panel-default " style="margin-top: 20px; background-color: #527a7a; ">
                <div class="panel-body">    
                    <?php
                    $id = filter_input(INPUT_GET, 'q');
                    $data = Backendless::$Data->of('QA')->findById($id);
                    //print_r($data);
                    echo '<legend style=" color:  #fff;">' . $data['title'] . '</legend>';
                    echo '<div class="list-group" style="white-space: pre-wrap;">';
                    echo '<div class="list-group-item"  style="text-align: center;padding: 8px;background-color: #b3cccc;"><h2>প্রশ্ন</h2></div>';
                    echo '<div class="list-group-item"  style="padding: 8px;background-color: #c2d6d6;"><p>' . $data['question'] . '</p></div>';
                    echo '<div class="list-group-item"  style="text-align: right; padding: 10px; background-color:  #75a3a3;">Question posted by- <strong>' . $data['questionBy'] . '</strong></div>';
                    echo '<hr>';
                    echo '<div class="list-group-item"  style="text-align: center;padding: 8px;background-color: #b3cccc;"><h2>উত্তর</h2></div>';
                    echo '<div class="list-group-item"  style="padding: 8px;background-color: #c2d6d6;"><p>' . $data['answer'] . '</p></div>';
                    echo '<div class="list-group-item"  style="text-align: right; padding: 10px; background-color:  #75a3a3;">Answer given by- <strong>' . $data['answeredBy'] . '</strong></div>';
                    ?>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body" style="text-align: center;">
                    <a class="btn btn-primary" href="edit.php?q=<?php echo $id;?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?q=<?php echo $id;?>">Delete</a>
                </div>
            </div>
        </div>
    </body>
</html>
