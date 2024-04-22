<?php
include "./PDO.php";

$std_id = $_GET['id'];

delete_user_prepared($std_id);