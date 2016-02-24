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
                    <li role="presentation" class="active"><a href="home.php">Insert QA</a></li>
                    <li role="presentation"><a href="browse.php">Browse QA</a></li>

                    <li role="presentation" class="navbar-right" style="padding-right: 20px;"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
            <div style="padding: 100px;">
                <form action="home.php" method="post">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data entry form for Kajol vai and his team</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label>Question</label>
                                <textarea  class="form-control" placeholder="দিতেই হবে। নাহলে হবে না।" name="question" rows="5" required></textarea>
                            </div>
                            <div class="form-group form-inline">
                                <label>Asker name</label>
                                <input id="askername" class="form-control" name="askerName">
                                <div class="form-group">
                                    <input type="checkbox" id="noname" name="noname">
                                    <label>নাম প্রকাশে অনিচ্ছুক</label>
                                </div>
                            </div>
                            <script>
                                document.getElementById('noname').onchange = function () {
                                    document.getElementById('askername').disabled = this.checked;
                                };
                            </script>
                            <div class="form-group">
                                <label>Answer</label>
                                <textarea  class="form-control" placeholder="দিতেই হবে। নাহলে হবে না।" name="answer" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Answered by</label>
                                <select name="answeredBy">
                                    <option value="মুফতি জিয়া রহমান">মুফতি জিয়া রহমান</option>
                                    <option value="মুফতি দানিয়াল মাহমুদ">মুফতি দানিয়াল মাহমুদ</option>
                                    <option value="হাফেজ মুফতি এম. এম. এইচ. সালেহ আহমেদ">হাফেজ মুফতি এম. এম. এইচ. সালেহ আহমেদ</option>
                                    <option value="মুফতি এমদাদ হক">মুফতি এমদাদ হক</option>
                                    <option value="ওলামায়ে কেরামবৃন্দ">ওলামায়ে কেরামবৃন্দ</option>
                                </select>
                            </div>

                        </div>
                        <div style="color: #23527c; font-size: large;">
                            <?php
                            if (isset($_POST['insertData'])) {
                                $question = filter_input(INPUT_POST, 'question');
                                $answer = filter_input(INPUT_POST, 'answer');
                                $askerName = "";
                                if (isset($_POST['noname'])) {
                                    $askerName = "নাম প্রকাশে অনিচ্ছুক";
                                } else {
                                    $askerName = filter_input(INPUT_POST, 'askerName');
                                }
                                $answeredBy = filter_input(INPUT_POST, 'answeredBy');
                                //echo "q = $question <br> a = $answer <br> asker = $askerName <br> answerd = $answeredBy";
                                $qa = new QA($question, $answer, $askerName, $answeredBy, FALSE);
                                try {
                                    $savedQA =  Backendless::$Persistence->save($qa);
                                    //print_r($savedQA);
                                    echo $savedQA['objectId'];
                                } catch (BackendlessException $ex) {
                                    echo $ex->getMessage();
                                }
                            }
                            ?>
                        </div>
                        <div class="panel-footer">
                            <button  name="insertData" type="submit" class="pure-button btn-success" style="float: right" >Save QA and add Comment</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
