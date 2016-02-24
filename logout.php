<?php
    session_start();
    unset($_SESSION['becu']);
    die("<script>location.href = 'index.php'</script>");

