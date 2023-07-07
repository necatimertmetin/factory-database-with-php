<?php


if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ormo_devices";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sql = "DELETE FROM phone WHERE ID=$ID";
    $connection->query($sql);
}
header("location: ../phone/phone.php");
exit;

?>