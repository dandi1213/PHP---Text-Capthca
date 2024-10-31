<?php
session_start();

// Membuat string acak untuk CAPTCHA
$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// Simpan string CAPTCHA dalam sesi
$_SESSION['captcha_text'] = $randomString;

// Membuat gambar
$width = 120;
$height = 40;
$image = imagecreatetruecolor($width, $height);

// Warna background dan teks
$bgColor = imagecolorallocate($image, 255, 255, 255); // Putih
$textColor = imagecolorallocate($image, 0, 0, 0);     // Hitam

// Mengisi background gambar
imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

// Menambahkan teks CAPTCHA ke gambar (gunakan font dasar jika ttf tidak ada)
$font = dirname(__FILE__) . '/arial.ttf';  // Pastikan font ini ada di direktori yang sama
if (file_exists($font)) {
    imagettftext($image, 20, 0, 10, 30, $textColor, $font, $randomString);
} else {
    imagestring($image, 5, 10, 10, $randomString, $textColor);  // Backup jika ttf tidak ada
}

// Menampilkan gambar sebagai PNG
header('Content-Type: image/png');
imagepng($image);

// Hapus gambar dari memori
imagedestroy($image);
?>
