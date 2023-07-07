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
      $("#showPrinterDataButton").click(function() {
        $.post("/show_printer_datas", function(data) {
          $("#printerDataContainer").html(data);
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
          <a class="left-menu-item" href="../computer/computer.php">
            <img class="left-menu-item-icon" src="../res/img/screen.png" width="40px">
            <div class="left-menu-item-title">Bilgisayar</div>
          </a>
          <a class="left-menu-item active" href="../printer/printer.php">
            <img class="left-menu-item-icon" src="../res/img/printer.png" width="40px">
            <div class="left-menu-item-title">Yazıcı</div>
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
            <div class="title">Yazıcı</div>
            <div class="show-hide">
              <div class="show-hide-key">
                Gizle
              </div>
            </div>
          </div>
          <a class='add-button' href='../tools/printerCreate.php' role="button">Ekle</a>
        </div>
        <div class="database">
          <table class="table">
            <thead>
              <tr>
                <th>İşlem</th>
                <th>ID</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Seri Numarası</th>
                <th>IP Adresi</th>
                <th>Toner Durumu</th>
                <th>Lokasyon</th>
                <th>Açıklama</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "ormo_devices";

              // Veritabanına bağlantıyı oluştur
              $connection = new mysqli($servername, $username, $password, $database);

              // Bağlantıyı kontrol et
              if ($connection->connect_error) {
                die("Bağlantı hatası: " . $connection->connect_error);
              }

              // Verileri oku
              $sql = "SELECT * FROM printer";
              $result = $connection->query($sql);

              if (!$result) {
                die("Geçersiz sorgu: " . $connection->error);
              }

              // Her bir satırın verilerini oku
              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td class='action-button'>
                          <a class='update-button' href='../tools/printerEdit.php?ID=$row[ID]' role='button'>Güncelle</a>
                          <a class='delete-button' href='../tools/printerDelete.php?ID=$row[ID]' role='button'>Sil</a>
                        </td>
                        <td>$row[ID]</td>
                        <td>$row[Brand]</td>
                        <td>$row[Model]</td>
                        <td>$row[Serial_No]</td>
                        <td>$row[Ip_Address]</td>
                        <td>$row[Toner]</td>
                        <td>$row[Location]</td>
                        <td>$row[Description]</td>
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
          switchElement.innerHTML = "Göster";
          databaseElement.classList.add('unvisible');
        }
      });
    </script>
  </div>

</body>

</html>
