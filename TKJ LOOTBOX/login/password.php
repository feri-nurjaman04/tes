<?php 
// Menghubungkan Dengan function.php
require '../function.php';

// Deklarasi Variabel
error_reporting(0);
$acc = $_POST['telpon'];
$pw1 = $_POST['password'];
$pw2 = $_POST['konfirmasi'];
// Memanggil akun dari database
$cek = query("SELECT * FROM user where telpon = '$acc'")[0];
$pw_db = $cek['password'];

// Logic tombol submit
if(isset($_POST['login'])){
    if($cek == true){
        if($pw1 == $pw2){
            if($pw1 == $pw_db){
                echo "
                 <script>
                    alert('Anda Memasukan Password Lama!');
                    document.location = 'password.php';
                 </script>
                 ";
            }else{
                lupa($_POST)==true;
                header('Location:login.php');
            }
        }else{
            echo "
                 <script>
                    alert('Password Tidak Sesuai!');
                    document.location = 'password.php';
                 </script>
                 ";
        }
    }else{
        echo "
                 <script>
                    alert('Akun Tidak Ditemukan!');
                    document.location = 'password.php';
                 </script>
                 ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TKJ LOOTBOX</title>
        <link href="../css/password.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <main>
        <div class="container">
            <div class="form">
                <div class="heading">
                    <h1>Lupa Password?</h1>
                    <p>Silahkan mengisi data dengan akun yang telah terdaftar sebelumnya.</p>
                </div>

                <form method="post">
                    <label for="telpon">Nomor Telpon</label>
                        <br>
                        <input type="tel" name="telpon" autocomplete="off" required id="telpon" placeholder="xxxx-xxxx-xxxx">
                        <br>
                    <label for="sandi">Password Baru</label>
                        <br>
                    <input type="password" name="password" required placeholder="Kata Sandi Anda" id="sandi">
                        <br>
                    <label for="confirm">Konfirmasi Password</label>
                        <br>
                    <input type="password" name="konfirmasi" required placeholder="Kata Sandi Anda" id="confirm">
                        <br>
                    <div class="forget">
                    </div>
                        <br>
                    <button name="login">Masuk</button>

                    <div class="regist">
                        <p>Belum memiliki akun? <a href="regist.php">Daftar Sekarang</a></p>
                    </div>
                </form>
            </div>
            

        </div>
    </main>
</body>
</html>
