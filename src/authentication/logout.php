<?php
session_start();
session_unset();
session_destroy();
unset($_SESSION);
header("Location: ../index.php");
