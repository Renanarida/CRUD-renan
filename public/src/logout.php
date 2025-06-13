<?php

    session_start();
    session_destroy();
    header("Location: ./reunioes.php");
    exit;

?>