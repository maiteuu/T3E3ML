<?php
session_start();
session_unset(); // se borran las aldagaias
session_destroy();
header("Location:index.php?itxi");
?>