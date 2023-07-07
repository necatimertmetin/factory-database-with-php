<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ormo_devices";

//Create connection

$connection = new mysqli($servername, $username, $password, $database);

//Add new device to database


$Brand = "";
$Model = "";
$Serial_No = "";
$Ip_Address = "";
$Toner = "";
$Location = "";
$Description = "";



$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    $Brand = $_POST["Brand"];
    $Model = $_POST["Model"];
    $Serial_No = $_POST["Serial_No"];
    $Ip_Address = $_POST["Ip_Address"];
    $Toner = $_POST["Toner"];
    $Location = $_POST["Location"];
    $Description = $_POST["Description"];

    do {
        if (empty($Ip_Address) || empty($Location)) {
            $errorMessage = "Ip adresi ve Lokasyon kısımları boş bırakılamaz.";
            break;
        }

        // Add new device to database
        // ...
        $sql = "INSERT INTO printer (Brand, Model, Serial_No, Ip_Address, Toner, Location, Description)" .
            "VALUES ('$Brand','$Model','$Serial_No','$Ip_Address','$Toner','$Location','$Description')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }


        $successMessage = "Başarıyla eklendi."; // Set success message

        // Clear the input values
        $Brand = "";
        $Model = "";
        $Serial_No = "";
        $Ip_Address = "";
        $Toner = "";
        $Location = "";
        $Description = "";


        header("location: ../printer/printer.php");
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
                <input type="text" name="Brand" placeholder="Marka" value="<?php echo $Brand; ?>"></input>
                <input type="text" name="Model" placeholder="Model" value="<?php echo $Model; ?>"></input>
                <input type="text" name="Serial_No" placeholder="Seri No" value="<?php echo $Serial_No; ?>"></input>
                <input type="text" name="Ip_Address" placeholder="Ip Adresi" value="<?php echo $Ip_Address; ?>"></input>
                

            </div>
            <div class="form-column">
            <input type="text" name="Toner" placeholder="Toner" value="<?php echo $Toner; ?>"></input>
                <input type="text" name="Location" placeholder="Lokasyon" value="<?php echo $Location; ?>"></input>
                <input type="text" name="Description" placeholder="Aciklama" value="<?php echo $Description; ?>"></input>


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
                <a class="form-button cancel" href="../printer/printer.php" role="button">Cancel</a>
                <br>

            </div>





        </form>
        <label>* alanlar zorunludur.</label>
    </div>
</body>

</html>