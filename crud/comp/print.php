<?php
function print_good()
{
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookstore";
    $con = mysqli_connect($server, $username, $password);
    if (!$con) {
        die("connection failed" . mysqli_connect_error());
    }
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if (mysqli_query($con, $sql)) {
        $con = mysqli_connect($server, $username, $password, $dbname);
        $sql = "
                CREATE TABLE IF NOT EXISTS books(
                    id INT(11) NOT NULL AUTO_INCREMENT,
                    book_name VARCHAR(100) NOT NULL,
                    book_publisher VARCHAR(100) NOT NULL,
                    book_price FLOAT NOT NULL,
                    PRIMARY KEY(id)
                );
                ";
        if (mysqli_query($con, $sql)) {
            return $con;
        } else {
            echo "Failed Creating Table" . mysqli_error($con);
        }
    } else {
        echo "Failed Creating database" . mysqli_error($con);
    }
}