<?php
session_start();
$captchaError = '';
$captchaSuccess = ''; // Variabel untuk pesan sukses

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $captchaInput = $_POST['captcha'];
    
    // Memeriksa apakah input pengguna sesuai dengan string CAPTCHA
    if ($captchaInput === $_SESSION['captcha_text']) {
        $captchaSuccess = "CAPTCHA benar!"; // Menyimpan pesan sukses
    } else {
        $captchaError = "CAPTCHA salah, coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form dengan CAPTCHA</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS -->
</head>
<body>

<div class="container">
    <h2>Masukkan CAPTCHA</h2>

    <form method="POST" action="">
        <p><img src="captcha.php" alt="CAPTCHA"></p>
        <p><input type="text" name="captcha" placeholder="Masukkan CAPTCHA" required></p>
        <p><button type="submit">Submit</button></p>

        <!-- Tampilkan pesan error atau sukses di dalam form -->
        <?php if (!empty($captchaError)): ?>
            <p class="error"><?php echo $captchaError; ?></p>
        <?php endif; ?>
        
        <?php if (!empty($captchaSuccess)): ?>
            <p class="success"><?php echo $captchaSuccess; ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
