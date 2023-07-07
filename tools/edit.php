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
    $Computer_Name = $_POST["Computer_Name"] ?? "";
    $User = $_POST["User"] ?? "";
    $Username = $_POST["Username"] ?? "";
    $Domain = $_POST["Domain"] ?? "";
    $Product_Type = $_POST["Product_Type"] ?? "";
    $Location = $_POST["Location"] ?? "";
    $Department = $_POST["Department"] ?? "";
    $Brand_Model = $_POST["Brand_Model"] ?? "";
    $Serial_No = $_POST["Serial_No"] ?? "";
    $CPU = $_POST["CPU"] ?? "";
    $Ram = $_POST["Ram"] ?? "";
    $Hard_Drive = $_POST["Hard_Drive"] ?? "";
    $OS = $_POST["OS"] ?? "";

    if (empty($Computer_Name) || empty($User) || empty($Username)) {
        $errorMessage = "Bilgisayar adı, kullanıcı ve kullanıcı adı kısımları boş bırakılamaz.";
    } else {
        $sql = "UPDATE computer SET 
            Computer_Name = '$Computer_Name',
            User = '$User',
            Username = '$Username',
            Domain = '$Domain',
            Product_Type = '$Product_Type',
            Location = '$Location',
            Department = '$Department',
            Brand_Model = '$Brand_Model',
            Serial_No = '$Serial_No',
            CPU = '$CPU',
            Ram = '$Ram',
            Hard_Drive = '$Hard_Drive',
            OS = '$OS'
            WHERE ID = $ID";

        if ($connection->query($sql) === TRUE) {
            $successMessage = "Device updated successfully.";
            header("Location: ../computer/computer.php?successMessage=" . urlencode($successMessage));
            exit;
        } else {
            $errorMessage = "Error updating device: " . $connection->error;
        }
    }
} else {
    $sql = "SELECT * FROM computer WHERE ID = $ID";
    $result = $connection->query($sql);

    if ($result->num_rows === 0) {
        $errorMessage = "Device not found.";
    } else {
        $row = $result->fetch_assoc();

        $Computer_Name = $row["Computer_Name"];
        $User = $row["User"];
        $Username = $row["Username"];
        $Domain = $row["Domain"];
        $Product_Type = $row["Product_Type"];
        $Location = $row["Location"];
        $Department = $row["Department"];
        $Brand_Model = $row["Brand_Model"];
        $Serial_No = $row["Serial_No"];
        $CPU = $row["CPU"];
        $Ram = $row["Ram"];
        $Hard_Drive = $row["Hard_Drive"];
        $OS = $row["OS"];
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
        <div class="title">Yeni Kayit</div>
        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <form class="form" method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <div class="form-column">
                <input type="text" name="Computer_Name" placeholder="*Bilgisayar Adi" value="<?php echo $Computer_Name; ?>" required>
                <input type="text" name="User" placeholder="*Kullanici" value="<?php echo $User; ?>" required>
                <input type="text" name="Username" placeholder="*Kullanici Adi" value="<?php echo $Username; ?>" required>
                <input type="text" name="Domain" placeholder="Domain" value="<?php echo $Domain; ?>">
                <input type="text" name="Product_Type" placeholder="Urun tipi" value="<?php echo $Product_Type; ?>">
                <input type="text" name="Location" placeholder="Lokasyon" value="<?php echo $Location; ?>">
                <input type="text" name="Department" placeholder="Departman" value="<?php echo $Department; ?>">
            </div>
            <div class="form-column">
                <input type="text" name="Brand_Model" placeholder="Marka Model" value="<?php echo $Brand_Model; ?>">
                <input type="text" name="Serial_No" placeholder="Seri No" value="<?php echo $Serial_No; ?>">
                <input type="text" name="CPU" placeholder="Islemci" value="<?php echo $CPU; ?>">
                <input type="text" name="Ram" placeholder="Ram" value="<?php echo $Ram; ?>">
                <input type="text" name="Hard_Drive" placeholder="Hard Disk" value="<?php echo $Hard_Drive; ?>">
                <input type="text" name="OS" placeholder="Isletim Sistemi" value="<?php echo $OS; ?>">

                <button class="form-button" type="submit">Submit</button>
                <a class="form-button cancel" href="../computer/computer.php" role="button">Cancel</a>
            </div>
        </form>
        <label>* alanlar zorunludur.</label>
    </div>
</body>

</html>
