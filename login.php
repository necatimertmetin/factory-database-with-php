<?php
// Kullanıcı adı ve şifre doğrulamasını gerçekleştirin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $correctUsername = 'mert';
    $correctPassword = '123';

    if ($username === $correctUsername && $password === $correctPassword) {
        // Kullanıcı adı ve şifre doğru ise, belirtilen websiteye yönlendirin
        header('Location: /ormo_cihazlar/computer/computer.php');
        exit();
    } else {
        // Kullanıcı adı veya şifre yanlış ise, hata mesajını query string ile index.php'ye gönderin
        header('Location: index.php?error=1');
        exit();
    }
}
?>
