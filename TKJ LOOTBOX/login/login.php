<?php 
// Menghubungkan Dengan function.php
require '../function.php';

// Logic fitur login(Mencari akun terkait di database)
if(isset($_POST['login'])){
    $email = $_POST['username'];
    $password = $_POST['password'];

    $cek = query("SELECT * FROM user WHERE username = '$email' AND password = '$password'")[0];

    if($cek == true){
        $_SESSION['log'] = 'True';
        $_SESSION['level'] = $cek['level'];
        $_SESSION['username'] = $cek['nama_user'];
        header('Location:../index.php');
    }else{
        header('Location:login.php');
    }
}

// Logic tombol login
if(!isset($_SESSION['log'])){
    
}else{
    header('Location:../index.php');
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
        <link href="../css/login.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <main>
        <div class="container">
            <div class="bg">
                <div class="satu">
                    <img src="../img/bg-login.png" alt="bg-login.png">
                </div>
                <div class="dua">
                    <img class="2" src="../img/bg-login2.png" alt="bg-login2.png">
                </div>
            </div>

            <div class="form">
                <div class="heading">
                    <h1>Selamat Datang</h1>
                    <p>Silahkan mengisi data dengan akun yang telah terdaftar sebelumnya.</p>
                </div>

                <form method="post">
                    <label for="username">Email</label>
                        <br>
                    <input type="email" name="username" autocomplete="off" required id="username" placeholder="example@gmail.com">
                        <br>
                    <label for="sandi">Password</label>
                        <br>
                    <input type="password" name="password" required placeholder="Kata Sandi Anda" id="sandi">
                        <br>
                    <div class="forget">
                        <a href="password.php">Lupa Password?</a>
                    </div>
                        <br>
                    <button name="login">Masuk</button>

                    <div class="regist">
                        <p>Belum memiliki akun? <a href="regist.php">Daftar Sekarang!</a></p>
                    </div>
                </form>
            </div>
            

        </div>
    </main>
</body>
</html>
