<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ormo_devices";

//Create connection

$connection = new mysqli($servername, $username, $password, $database);

//Add new device to database









$Computer_Name = "";
$User = "";
$Username = "";
$Domain = "";
$Product_Type = "";
$Location = "";
$Department = "";
$Brand_Model = "";
$Serial_No = "";
$CPU = "";
$Ram = "";
$Hard_Drive = "";
$OS = "";


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Computer_Name = $_POST["Computer_Name"];
    $User = $_POST["User"];
    $Username = $_POST["Username"];
    $Domain = $_POST["Domain"];
    $Product_Type = $_POST["Product_Type"];
    $Location = $_POST["Location"];
    $Department = $_POST["Department"];
    $Brand_Model = $_POST["Brand_Model"];
    $Serial_No = $_POST["Serial_No"];
    $CPU = $_POST["CPU"];
    $Ram = $_POST["Ram"];
    $Hard_Drive = $_POST["Hard_Drive"];
    $OS = $_POST["OS"];

    do {
        if (empty($Computer_Name) || empty($User) || empty($Username)) {
            $errorMessage = "Bilgisayar adı, kullanıcı ve kullanıcı adı kısımları boş bırakılamaz.";
            break;
        }

        // Add new device to database
        // ...
        $sql = "INSERT INTO computer (Computer_Name, User, Username, Domain, Product_Type, Location, Department, Brand_Model, Serial_No, CPU, Ram, Hard_Drive, OS)" .
            "VALUES ('$Computer_Name', '$User','$Username', '$Domain','$Product_Type','$Location','$Department','$Brand_Model','$Serial_No','$CPU','$Ram','$Hard_Drive','$OS')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }


        $successMessage = "Başarıyla eklendi."; // Set success message

        // Clear the input values
        $Computer_Name = "";
        $User = "";
        $Username = "";
        $Domain = "";
        $Product_Type = "";
        $Location = "";
        $Department = "";
        $Brand_Model = "";
        $Serial_No = "";
        $CPU = "";
        $Ram = "";
        $Hard_Drive = "";
        $OS = "";

        header("location: ../computer/computer.php");
        exit;
    } while (false);
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
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' style='color: #d00000; padding-top: 5px; padding-bottom: 15px;' role='alert'>
            <strong>$errorMessage</strong>
            </div>
            ";
        }

        ?>
        <form class="form" method="post">
            <div class="form-column">
                <input type="text" name="Computer_Name" placeholder="*Bilgisayar Adi" value="<?php echo $Computer_Name; ?>"></input>
                <input type="text" name="User" placeholder="*Kullanici" value="<?php echo $User; ?>"></input>
                <input type="text" name="Username" placeholder="*Kullanici Adi" value="<?php echo $Username; ?>"></input>
                <input type="text" name="Domain" placeholder="Domain" value="<?php echo $Domain; ?>"></input>
                <input type="text" name="Product_Type" placeholder="Urun tipi" value="<?php echo $Product_Type; ?>"></input>
                <input type="text" name="Location" placeholder="Lokasyon" value="<?php echo $Location; ?>"></input>
                <input type="text" name="Department" placeholder="Departman" value="<?php echo $Department; ?>"></input>
            </div>
            <div class="form-column">
                <input type="text" name="Brand_Model" placeholder="Marka Model" value="<?php echo $Brand_Model; ?>"></input>
                <input type="text" name="Serial_No" placeholder="Seri No" value="<?php echo $Serial_No; ?>"></input>
                <input type="text" name="CPU" placeholder="Islemci" value="<?php echo $CPU; ?>"></input>
                <input type="text" name="Ram" placeholder="Ram" value="<?php echo $Ram; ?>"></input>
                <input type="text" name="Hard_Drive" placeholder="Hard Disk" value="<?php echo $Hard_Drive; ?>"></input>
                <input type="text" name="OS" placeholder="Isletim Sistemi" value="<?php echo $OS; ?>"></input>

                <?php
                if (!empty($successMessage)) {
                    echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissable fade show' role='alert'>
                            <strong style='color:green;'>$successMessage</strong>
                        </div>
                    </div>
                </div>
            ";
                }
                ?>
                <button class="form-button" type="submit">Submit</button>
                <a class="form-button cancel" href="../computer/computer.php" role="button">Cancel</a>
                <br>

            </div>





        </form>
        <label>* alanlar zorunludur.</label>
    </div>
</body>

</html>