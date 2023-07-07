<!DOCTYPE html>
<html>

<head>
  <title>Login Form</title>
  <link rel="stylesheet" href=".//res/styles/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <script src="script.js"></script>
</head>

<body>
  <div class="container">
    <div class="form-container">
      <div class="form-title">ORMO</div>

      <form method="post" action="login.php" id="loginForm">
        <input id="username" type="text" class="form-input" placeholder="Username" name="username" required />
        <input id="password" type="password" class="form-input" placeholder="Password" name="password" required />
        <button type="submit" class="form-button">Giriş  Yap</button>
      </form>

      <?php
      if (isset($_GET['error'])) {
        echo '<div class="error-message">Kullanıcı adı veya şifre hatalı.</div>';
      }
      ?>
    </div>
  </div>
</body>

</html>