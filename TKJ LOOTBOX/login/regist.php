<?php 
// Menghubungkan Dengan function.php
require '../function.php';

// Logic tombol login
error_reporting(0);
$pw1 = $_POST['password'];
$pw2 = $_POST['konfirmasi'];

// Cek apakah username tersedia
$acc = $_POST['username'];
$cek = query("SELECT * FROM user WHERE username = '$acc'");

if(isset($_POST['login'])){
    if($cek == true){
        echo "
            <script>
                alert('Akun Sudah Ada!');
                document.location = 'regist.php';
            </script>
             ";
    }else{
        if($pw2 == $pw1){
            regist($_POST) == true;
            header('Location:login.php');
        }else{
            echo "
            <script>
                alert('Password Tidak Sesuai!');
                document.location = 'regist.php';
            </script>
            ";
        }
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
        <link href="../css/regist.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <main>
        <div class="container">
            <div class="form">
                <div class="heading">
                    <h1>Registrasi Akun</h1>
                    <p>Silahkan mengisi data yang diperlukan untuk mendaftarkan akun.</p>
                </div>

                <form method="post">
                    <div class="input">
                    <div class="wrapper">
                        <label for="nama">Nama Lengkap</label>
                        <br>
                        <input type="text" name="nama" autocomplete="off" required id="nama" placeholder="Cantumkan Nama Kamu">
                        <br>
                        <label for="telpon">Nomor Telpon</label>
                        <br>
                        <input type="tel" name="telpon" autocomplete="off" required id="telpon" placeholder="xxxx-xxxx-xxxx">
                        <br>
                    <label for="username">Email</label>
                        <br>
                    <input type="email" name="username" autocomplete="off" required id="username" placeholder="example@gmail.com">
                    </div>
                    <div class="wrapper">
                        <label for="sandi">Password</label>
                        <br>
                        <input type="password" name="password" required placeholder="Kata Sandi Anda" id="sandi">
                        <br>
                        <label for="confirm">Konfirmasi Password</label>
                        <br>
                        <input type="password" name="konfirmasi" required placeholder="Kata Sandi Anda" id="confirm">
                        <div class="forget">
                            </div>
                            <br>
                        </div>
                    </div>
                    <button name="login">Masuk</button>
                    <div class="regist">
                        <p>Anda sudah memiliki akun? <a href="login.php">Klik Disini!</a></p>
                    </div>
                    </form>

            </div>
            

        </div>
    </main>
</body>
</html>
