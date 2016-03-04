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
        <title>Browse QA</title>
    </head>
    <body style="background-color: #245580;">
        <div class="container">
            <nav class="navbar navbar-default">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="home.php">Insert QA</a></li>
                    <li role="presentation" class="active"><a href="browse.php">Browse QA</a></li>
                    <li role="presentation"><a href="addCategory.php">Add Category</a></li>
                    <li role="presentation" class="navbar-right" style="padding-right: 20px;"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
            <div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">QA</h3>
                    </div>
                    <div class="panel-body" style="white-space: pre-wrap;">
                        <table class="table table-striped">
                            
                            <tbody>
                                <?php
                                try {
                                     $query = new BackendlessDataQuery();
                                    $query->setPageSize(100);
                                    $data = Backendless::$Data->of('QA')->find($query)->getAsArray();
                                    $i = 1;
                                    foreach ($data as $qa) {
                                        echo '<tr><td><ul class="list-group">';
                                        echo '<li class="list-group-item"><strong>Question No</strong>- '.$i++.'</li>';
                                        echo '<li class="list-group-item"><strong>Category</strong>- '.$qa['category'].'</li>';
                                        echo '<li class="list-group-item"><strong>Title</strong>- '.$qa['title'].'</li>';
                                        echo '<li class="list-group-item"><strong>প্রশ্ন</strong>- <br> '.$qa['question'].'</li>';
                                        echo '<li class="list-group-item"><strong>প্রশ্ন করেছেন</strong>- '.$qa['questionBy'].'</li>';
                                        echo '<li class="list-group-item"><strong>উত্তর</strong>- <br> '.$qa['answer'].'</li>';
                                        echo '<li class="list-group-item"><strong>উত্তর দিয়েছেন</strong>- '.$qa['answeredBy'].'</li>';
                                        echo '<li class="list-group-item"><a href="delete.php?q='.$qa['objectId'].'"'.'>Delete</a></li>';
                                        echo '</ul></td></tr>';
                                    }
                                } catch (BackendlessException $ex) {
                                    echo $ex->getMessage();
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
