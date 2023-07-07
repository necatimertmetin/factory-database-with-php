<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="../res/styles/dashboardcss.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#showComputerDataButton").click(function() {
        $.post("/show_computer_datas", function(data) {
          $("#computerDataContainer").html(data);
        });
      });
    });
  </script>
</head>

<body>

  <div class="body-container">

    <div class="left-container">
      <div class="logo-container">
        <img src="../res/img/logo.png">
      </div>
      <div class="left-menu">
        <div class="left-menu-title">Menu</div>
        <div class="left-menu-items">
          <a class="left-menu-item active" href="../computer/computer.php">
            <img class="left-menu-item-icon" src="../res/img/screen.png" width="40px">
            <div class="left-menu-item-title">Bilgisayar</div>
          </a>
          <a class="left-menu-item" href="../printer/printer.php">
            <img class="left-menu-item-icon" src="../res/img/printer.png" width="40px">
            <div class="left-menu-item-title">Yazici</div>


          </a>
          <a class="left-menu-item" href="../phone/phone.php">
            <img class="left-menu-item-icon" src="../res/img/phone.png" width="40px">
            <div class="left-menu-item-title">Telefon</div>
          </a>
          <a class="left-menu-item" href="../camera/camera.php">
            <img class="left-menu-item-icon" src="../res/img/video-camera.png" width="40px">
            <div class="left-menu-item-title">Kamera</div>
          </a>
          <a class="left-menu-item" href="../accesory/accesory.php">
            <img class="left-menu-item-icon" src="../res/img/computer-mouse.png" width="40px">
            <div class="left-menu-item-title">Aksesuar</div>
          </a>

        </div>
      </div>
    </div>

    <div class="main-container">
      <div class="database-container">



        <div class="database-top">
          <div class="search-bar">
            <input class="search-box" type="text" placeholder="Search" />
            <button class="search-button"></button>
          </div>
          <div class="database-top-middle">
            <div class="title">Bilgisayar</div>
            <div class="show-hide">
              <div class="show-hide-key">
                Gizle
              </div>
            </div>
          </div>

          <a class='add-button' href='../tools/create.php' role="button">ekle</a>

        </div>


        <div class="database">





          <table class="table">
            <thead>
              <tr>
                <th>action</th>
                <th>ID</th>
                <th>ComputerName</th>
                <th>User</th>
                <th>Username</th>
                <th>Domain</th>
                <th>ProductType</th>
                <th>Location</th>
                <th>Department</th>
                <th>Brand_Model</th>
                <th>SerialNo</th>
                <th>CPU</th>
                <th>RAM</th>
                <th>HardDrive</th>
                <th>OS</th>

              </tr>
            </thead>

            <tbody>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "ormo_devices";

              //Create connection

              $connection = new mysqli($servername, $username, $password, $database);

              //Check connection
              if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
              }

              //read

              $sql = "SELECT * from computer";
              $result = $connection->query($sql);

              if (!$result) {
                die("Invalid query: " . $connection->error);
              }

              //read data of each row
              while ($row = $result->fetch_assoc()) {

                echo "<tr>
                  <td class='action-button'>
                    <a class='update-button' href='../tools/edit.php?ID=$row[ID]' role='button'>Update</a>

                    <a class='delete-button' href='../tools/delete.php?ID=$row[ID]' role='button'>Delete</a>
                        
                    </td>
                    <td>$row[ID]</td>
                    <td>$row[Computer_Name]</td>
                    <td>$row[User]</td>
                    <td>$row[Username]</td>
                    <td>$row[Domain]</td>
                    <td>$row[Product_Type]</td>
                    <td>$row[Location]</td>
                    <td>$row[Department]</td>
                    <td>$row[Brand_Model]</td>
                    <td>$row[Serial_No]</td>
                    <td>$row[CPU]</td>
                    <td>$row[Ram]</td>
                    <td>$row[Hard_Drive]</td>
                    <td>$row[OS]</td>
                    

                </tr>";
              }


              ?>
            </tbody>

          </table>




        </div>
      </div>
    </div>



    <script>
      const switchElement = document.querySelector('.show-hide-key');

      switchElement.addEventListener('click', function() {
        const databaseElement = document.querySelector('.database');

        if (this.classList.contains('show-hide-key-active')) {
          this.classList.remove('show-hide-key-active');
          switchElement.innerHTML = "Gizle";

          databaseElement.classList.remove('unvisible');
        } else {
          this.classList.add('show-hide-key-active');
          switchElement.innerHTML = "Goster";

          databaseElement.classList.add('unvisible');
        }
      });
    </script>

</body>

</html>