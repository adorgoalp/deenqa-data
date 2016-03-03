<?php

session_start();

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
use QA;
$id = $_GET['q'];
try{
    Backendless::$Persistence->removeById('Category',$id);
    echo 'Alhamdulillah! Deleted.';
    die("<script>location.href = 'addCategory.php'</script>");
}  catch (BackendlessException $ex)
{
    echo $ex->getMessage();
}
//$qa = new QA();
//
//try {
//    $query = new BackendlessDataQuery();
//    $query->setWhereClause("objectId='$id'");
//    $qa = Backendless::$Data->of('QA')->find($query);
//    print_r($qa);
//    Backendless::$Data->of('QA')->remove($qa['objectId']);
//    echo 'ok';
//} catch (BackendlessException $ex) {
//    echo $ex->getMessage();
//}


