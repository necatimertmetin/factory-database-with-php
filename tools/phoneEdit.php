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
    
    $User = $_POST["User"] ?? "";
    $Username = $_POST["Username"] ?? "";
    $Phone_No = $_POST["Phone_No"] ?? "";
    $Brand = $_POST["Brand"] ?? "";
    $Model = $_POST["Model"] ?? "";
    $Serial_No = $_POST["Serial_No"] ?? "";
    $Mail = $_POST["Mail"] ?? "";
    $Account_Password = $_POST["Account_Password"] ?? "";
    $Accessory = $_POST["Accessory"] ?? "";
    $Pin_Code = $_POST["Pin_Code"] ?? "";
    $Location = $_POST["Location"] ?? "";
    
    
    
    
    

    if (empty($Phone_No) || empty($User) || empty($Username)) {
        $errorMessage = "Telefon Numarasi, kullanıcı ve kullanıcı adı kısımları boş bırakılamaz.";
    } else {
        $sql = "UPDATE phone SET 
            Phone_No = '$Phone_No',
            User = '$User',
            Username = '$Username',
            Brand = '$Brand',
            Model = '$Model',
            Location = '$Location',
            Mail = '$Mail',
            Accessory = '$Accessory',
            Serial_No = '$Serial_No',
            Account_Password = '$Account_Password',
            Pin_Code = '$Pin_Code',
            WHERE ID = $ID";

        if ($connection->query($sql) === TRUE) {
            $successMessage = "Device updated successfully.";
            header("Location: ../phone/phone.php?successMessage=" . urlencode($successMessage));
            exit;
        } else {
            $errorMessage = "Error updating device: " . $connection->error;
        }
    }
} else {
    $sql = "SELECT * FROM phone WHERE ID = $ID";
    $result = $connection->query($sql);

    if ($result->num_rows === 0) {
        $errorMessage = "Device not found.";
    } else {
        $row = $result->fetch_assoc();

        $Phone_No = $row["Phone_No"];
        $User = $row["User"];
        $Username = $row["Username"];
        $Brand = $row["Brand"];
        $Model = $row["Model"];
        $Location = $row["Location"];
        $Mail = $row["Mail"];
        $Accessory = $row["Accessory"];
        $Serial_No = $row["Serial_No"];
        $Account_Password = $row["Account_Password"];
        $Pin_Code = $row["Pin_Code"];
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
                <input type="text" name="Phone_No" placeholder="*Telefon Numarasi" value="<?php echo $Phone_No; ?>" required>
                <input type="text" name="User" placeholder="*Kullanici" value="<?php echo $User; ?>" required>
                <input type="text" name="Username" placeholder="*Kullanici Adi" value="<?php echo $Username; ?>" required>
                <input type="text" name="Brand" placeholder="Marka" value="<?php echo $Brand; ?>">
                <input type="text" name="Model" placeholder="Model" value="<?php echo $Model; ?>">
                <input type="text" name="Location" placeholder="Lokasyon" value="<?php echo $Location; ?>">
                <input type="text" name="Mail" placeholder="Mail" value="<?php echo $Mail; ?>">
            </div>
            <div class="form-column">
                <input type="text" name="Accessory" placeholder="Aksesuar" value="<?php echo $Accessory; ?>">
                <input type="text" name="Serial_No" placeholder="Seri No" value="<?php echo $Serial_No; ?>">
                <input type="text" name="Account_Password" placeholder="Hesap Sifresi" value="<?php echo $Account_Password; ?>">
                <input type="text" name="Pin_Code" placeholder="Pin_Code" value="<?php echo $Pin_Code; ?>">

                <button class="form-button" type="submit">Submit</button>
                <a class="form-button cancel" href="../phone/phone.php" role="button">Cancel</a>
            </div>
        </form>
        <label>* alanlar zorunludur.</label>
    </div>
</body>

</html>
