<?php
$connect = mysqli_connect('localhost', 'root', '', 'postsdb');
if (!$connect) {
    die('Error to connect db');
}