<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$database = "ormo_devices";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$ID = $_GET["ID"] ?? null;

if (!$ID) {
    die("ID parameter is missing.");
}

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Brand = $_POST["Brand"] ?? "";
    $Model = $_POST["Model"] ?? "";
    $Serial_No = $_POST["Serial_No"] ?? "";
    $Ip_Address = $_POST["Ip_Address"] ?? "";
    $Toner = $_POST["Toner"] ?? "";
    $Location = $_POST["Location"] ?? "";
    $Description = $_POST["Description"] ?? "";

    if (empty($Ip_Address) || empty($Location)) {
        $errorMessage = "IP adresi ve Lokasyon kısımları boş bırakılamaz.";
    } else {
        $sql = "UPDATE printer SET 
            Brand = '$Brand',
            Model = '$Model',
            Serial_No = '$Serial_No',
            Ip_Address = '$Ip_Address',
            Toner = '$Toner',
            Location = '$Location',
            Description = '$Description'
            WHERE ID = $ID";

        if ($connection->query($sql) === TRUE) {
            $successMessage = "Cihaz başarıyla güncellendi.";
            header("Location: ../printer/printer.php?successMessage=" . urlencode($successMessage));
            exit;
        } else {
            $errorMessage = "Cihaz güncellenirken hata oluştu: " . $connection->error;
        }
    }
} else {
    $sql = "SELECT * FROM printer WHERE ID = $ID";
    $result = $connection->query($sql);

    if ($result->num_rows === 0) {
        $errorMessage = "Cihaz bulunamadı.";
    } else {
        $row = $result->fetch_assoc();

        $Brand = $row["Brand"];
        $Model = $row["Model"];
        $Serial_No = $row["Serial_No"];
        $Ip_Address = $row["Ip_Address"];
        $Toner = $row["Toner"];
        $Location = $row["Location"];
        $Description = $row["Description"];
    }
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compitable" content="IE=edge">
    <link rel="stylesheet" href="../res/styles/create.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main-container">
        <div class="title">Düzenle</div>
        <?php
        if (!empty($errorMessage)) {
            echo '<div class="error-message">' . $errorMessage . '</div>';
        }
        if (!empty($successMessage)) {
            echo '<div class="success-message">' . $successMessage . '</div>';
        }
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="Brand">Marka:</label>
                <input type="text" name="Brand" value="<?php echo $Brand; ?>" required>
            </div>
            <div class="form-group">
                <label for="Model">Model:</label>
                <input type="text" name="Model" value="<?php echo $Model; ?>" required>
            </div>
            <div class="form-group">
                <label for="Serial_No">Seri Numarası:</label>
                <input type="text" name="Serial_No" value="<?php echo $Serial_No; ?>">
            </div>
            <div class="form-group">
                <label for="Ip_Address">IP Adresi:</label>
                <input type="text" name="Ip_Address" value="<?php echo $Ip_Address; ?>" required>
            </div>
            <div class="form-group">
                <label for="Toner">Toner Durumu:</label>
                <input type="text" name="Toner" value="<?php echo $Toner; ?>">
            </div>
            <div class="form-group">
                <label for="Location">Lokasyon:</label>
                <input type="text" name="Location" value="<?php echo $Location; ?>" required>
            </div>
            <div class="form-group">
                <label for="Description">Açıklama:</label>
                <textarea name="Description"><?php echo $Description; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Güncelle">
            </div>
        </form>
    </div>
</body>

</html>

