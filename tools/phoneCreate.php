<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ormo_devices";

//Create connection

$connection = new mysqli($servername, $username, $password, $database);

//Add new device to database


$User = "";
$Username = "";
$Phone_No = "";
$Brand = "";
$Model = "";
$Serial_No = "";
$Mail = "";
$Account_Password = "";
$Accessory = "";
$Pin_Code = "";
$Location = "";



$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    $User = $_POST["User"];
    $Username = $_POST["Username"];
    $Phone_No = $_POST["Phone_No"];
    $Brand = $_POST["Brand"];
    $Model = $_POST["Model"];
    $Serial_No = $_POST["Serial_No"];
    $Mail = $_POST["Mail"];
    $Account_Password = $_POST["Account_Password"];
    $Accessory = $_POST["Accessory"];
    $Pin_Code = $_POST["Pin_Code"];
    $Location = $_POST["Location"];

    do {
        if (empty($Location) || empty($User)) {
            $errorMessage = "Location ve user gerekli";
            break;
        }

        // Add new device to database
        // ...
        $sql = "INSERT INTO phone (User, Username, Phone_No, Brand, Model, Serial_No, Mail, Account_Password, Accessory, Pin_Code, Location)" .
            "VALUES ('$User','$Username','$Phone_No','$Brand','$Model','$Serial_No','$Mail','$Account_Password','$Accessory','$Pin_Code','$Location')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }


        $successMessage = "Başarıyla eklendi."; // Set success message

        // Clear the input values
        $User = "";
        $Username = "";
        $Phone_No = "";
        $Brand = "";
        $Model = "";
        $Serial_No = "";
        $Mail = "";
        $Account_Password = "";
        $Accessory = "";
        $Pin_Code = "";
        $Location = "";


        header("Location: ../phone/phone.php");
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
                <input type="text" name="User" placeholder="Marka" value="<?php echo $User; ?>"></input>
                <input type="text" name="Username" placeholder="Username" value="<?php echo $Username; ?>"></input>
                <input type="text" name="Phone_No" placeholder="Seri No" value="<?php echo $Phone_No; ?>"></input>
                <input type="text" name="Brand" placeholder="Ip Adresi" value="<?php echo $Brand; ?>"></input>
                <input type="text" name="Model" placeholder="Model" value="<?php echo $Model; ?>"></input>
                <input type="text" name="Serial_No" placeholder="Lokasyon" value="<?php echo $Serial_No; ?>"></input>



            </div>
            <div class="form-column">
                <input type="text" name="Mail" placeholder="Aciklama" value="<?php echo $Mail; ?>"></input>
                <input type="Account_Password" name="Account_Password" placeholder="Account_Password" value="<?php echo $Account_Password; ?>"></input>
                <input type="Accessory" name="Accessory" placeholder="Accessory" value="<?php echo $Accessory; ?>"></input>
                <input type="Pin_Code" name="Pin_Code" placeholder="Pin_Code" value="<?php echo $Pin_Code; ?>"></input>
                <input type="Location" name="Location" placeholder="Location" value="<?php echo $Location; ?>"></input>

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
                <a class="form-button cancel" href="../phone/phone.php" role="button">Cancel</a>
                <br>

            </div>





        </form>
        <label>* alanlar zorunludur.</label>
    </div>
</body>

</html>