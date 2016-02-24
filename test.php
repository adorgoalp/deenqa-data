<?php
use backendless\Backendless;
include_once './backendless/autoload.php';
Backendless::initApp('0F8F33A0-5515-0C9B-FFCB-F8A0A3E92A00', 'B1ACD24E-02A7-E964-FFA0-7D0ABB2FFD00', 'v1');
use backendless\exception\BackendlessException;
                    if (isset($_POST['login'])) {
                        $email = $_POST['email'];
                        $pass = $_POST['password'];
                        try {
                            $user = Backendless::$UserService->login($email, $pass);
                            if ($user === NULL) {
                                echo 'login failed!';
                            } else {
                                echo $user->getEmail();
                                $userSerrvice->setCurrentUser($user);
                                //die("<script>location.href = 'home.php'</script>");
                            }
                        } catch (BackendlessException $ex) {
                            if($ex->getCode() === 3003)
                            {
                                echo 'Invalid login.';
                            }
                            echo 'Exception ' . $ex->getMessage();
                        }
                    }
                    echo 'rrrr';
                    ?>