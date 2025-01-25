<?php

$database = new mysqli("localhost", "root", "", "mentormeet");
if ($database->connect_error) {
    die("Connection failed:  " . $database->connect_error);
}
