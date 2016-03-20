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
        <title>New QA</title>
    </head>
    <body style="background-color: #245580;">
        <div class="container">
            <nav class="navbar navbar-default">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="home.php">Insert QA</a></li>
                    <li role="presentation"><a href="browse.php">Browse QA</a></li>
                    <li role="presentation"><a href="addCategory.php">Add Category</a></li>
                    <li role="presentation" class="active"><a href="newQA.php">New QA</a></li>
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
                                if (isset($_GET['offset'])) {
                                    $offset = $_GET['offset'];
                                    if (!$offset || $offset < 0) {
                                        $offset = 0;
                                    }
                                } else {
                                    $offset = 0;
                                }

                                $query = new BackendlessDataQuery();
                                $query->setPageSize(10);
                                $query->setOffset($offset);
                                $data = Backendless::$Data->of('PendingQA')->find($query)->getAsArray();
                                $i = 1 + $offset;
                                foreach ($data as $d) {
                                    echo '<tr>';
                                    echo '<td>' . $i++ . '</td>';
                                    echo '<td>' . $d['question'] . '</td>';
                                    echo '<td><a href="reviewNewQA.php?q=' . $d['objectId'] . '" target="_blank">Review</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pager">
                                <?php
                                if ($offset == 0) {
                                    echo '<li class="disabled"><a href="#">Previous</a></li>';
                                } else {
                                    echo '<li><a href="browse.php?&offset=' . ($offset - 10) . '">Previous</a></li>';
                                }
                                if (count($data) < 10) {
                                    echo '<li class="disabled"><a href="#">Next</a></li>';
                                } else {
                                    echo '<li><a href="browse.php?offset=' . ($offset + 10) . '">Next</a></li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
