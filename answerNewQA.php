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
        <title>Edit QA</title>
    </head>
    <body style="background-color: #D1D1D1;">
        <div class="container">
            <nav class="navbar navbar-default">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="home.php">Insert QA</a></li>
                    <li role="presentation"><a href="browse.php">Browse QA</a></li>
                    <li role="presentation"><a href="addCategory.php">Add Category</a></li>
                    <li role="presentation"><a href="newQA.php">New QA</a></li>
                    <li role="presentation" class="active"><a href="#">Answer QA</a></li>
                    <li role="presentation" class="navbar-right" style="padding-right: 20px;"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
            <?php
            $id = filter_input(INPUT_GET, 'q');
            $data = Backendless::$Data->of('PendingQA')->findById($id);
//            print_r($data);
            ?>
            <div style="padding: 100px;">
                <form action="answerNewQA.php?q=<?php echo $id ?>" method="post">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit</h3>
                        </div>
                        <div class="panel-body">
                            <div style="color: #23527c; font-size: large; padding-left: 20px;">
                                <?php
                                if (isset($_POST['publishData'])) {
                                    $title = filter_input(INPUT_POST, 'title');
                                    $question = filter_input(INPUT_POST, 'question');
                                    $answer = filter_input(INPUT_POST, 'answer');
                                    $askerName = "";
                                    if (isset($_POST['noname'])) {
                                        $askerName = "নাম প্রকাশে অনিচ্ছুক";
                                    } else {
                                        $askerName = filter_input(INPUT_POST, 'askerName');
                                        if ($askerName === '') {
                                            $askerName = "নাম প্রকাশে অনিচ্ছুক";
                                        }
                                    }
                                    $answeredBy = filter_input(INPUT_POST, 'answeredBy');
                                    $category = filter_input(INPUT_POST, 'category');
                                    //echo "q = $question <br> a = $answer <br> asker = $askerName <br> answerd = $answeredBy";
                                    $qa = new QA($title, $question, $answer, $askerName, $answeredBy, FALSE, $category);
                                    try {
                                        $savedQA = Backendless::$Persistence->save($qa);
                                        if ($savedQA !== NULL) {
                                            echo 'Alhamdulillah! Published.';
                                            $oid = $savedQA['objectId'];
                                            die("<script>location.href = 'reviewQA.php?q=$oid'</script>");
                                        }
                                    } catch (BackendlessException $ex) {
                                        echo $ex->getMessage();
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input  class="form-control" placeholder="দিতেই হবে। নাহলে হবে না।" name="title" required value="<?php echo $data['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Question</label>
                                <textarea  class="form-control" placeholder="দিতেই হবে। নাহলে হবে না।" name="question" rows="5" required>
                                    <?php echo $data['question']; ?>
                                </textarea>
                            </div>
                            <div class="form-group form-inline">
                                <label>Asker name</label>
                                <input id="askername" class="form-control" name="askerName" required value="<?php echo $data['questionBy']; ?>">
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
                                <textarea  class="form-control" placeholder="দিতেই হবে। নাহলে হবে না।" name="answer" rows="10" required>
                                    <?php echo $data['answer']; ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Answered by</label>
                                <select name="answeredBy">
                                    <option value="হাফেয মুফতি জিয়া রাহমান (দাঃ বাঃ)">হাফেয মুফতি জিয়া রাহমান (দাঃ বাঃ)</option>
                                    <option value="হাফেজ মুফতি সালেহ আহমদ (দাঃ বাঃ)">হাফেজ মুফতি সালেহ আহমদ (দাঃ বাঃ)</option>
                                    <option value="মুফতি দানিয়াল মাহমূদ (দাঃ বাঃ)">মুফতি দানিয়াল মাহমূদ (দাঃ বাঃ)</option>
                                    <option value="মুফতি ইমদাদুল হক (দাঃ বাঃ)">মুফতি ইমদাদুল হক (দাঃ বাঃ)</option>
                                    <option value="ওলামায়ে কেরামবৃন্দ (দাঃ বাঃ)">ওলামায়ে কেরামবৃন্দ (দাঃ বাঃ)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category">
                                    <?php
                                    $query = new BackendlessDataQuery();
                                    $query->setPageSize(100);
                                    $cat = Backendless::$Data->of('Category')->find($query)->getAsArray();
                                    $cat = array_reverse($cat);
                                    $i = 1;
                                    foreach ($cat as $d) {
                                        echo ' <option value=" ' . $d['cat'] . ' ">' . $i++ . '. ' . $d['cat'] . '</option>' . '<br>';
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <button  name="publishData" type="submit" class="pure-button btn-success" style="float: right" >Publish</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
