<?php 
//Menyimpan suatu informasi antar proses request
session_start();

// Koneksi ke database
$conn = mysqli_connect("localhost","root","","gudang");

// Query Database
function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows=[];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// //Format tanggal 
function format($date){
    return date('l, d-m-Y', strtotime($date));
}

// menambah stok
function insert($data){
    global $conn;

    $nama = $data['nama'];
    $jumlah = $data['jumlah'];

    $cek = query("SELECT * FROM tb_barang WHERE nama_barang = '$nama'");

    if($cek == true){
        echo "
             <script>
                alert('Barang Sudah ada!');
             </script>
             ";
    }else{
        $query = "INSERT INTO tb_barang
              VALUES
              ('','$nama','$jumlah')
             ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
    }
}

// Delete data pinjam
function hapus_barang($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM tb_barang WHERE idbarang = '$id'");
    return mysqli_affected_rows($conn);
}

// update stok barang
function update_barang($data){
    global $conn;

    $id = $data['idbarang']; 
    $jumlah = $data['jumlah'];

    $query = "UPDATE tb_barang
              SET
              stok           = '$jumlah'
              WHERE idbarang = '$id'
             ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);  
}

// Pinjam barang
function pinjam($data){
    global $conn;
    
    $namabarang = $data['barang'];
    $penerima = $data['penerima'];
    $tanggal = $data['tanggal'];
    $jumlah = $data['jumlah'];
    
    $selsto = mysqli_query($conn, "SELECT * FROM tb_barang WHERE idbarang = '$namabarang'");
    $sto = mysqli_fetch_array($selsto);
    $stok = $sto['stok'];


    if($stok >= $jumlah){
        $query = "INSERT INTO tb_pinjam
                  VALUES
                  ('','$namabarang','$penerima','$tanggal','$jumlah')
                 ";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
}

// Delete data pinjam
function hapus($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM tb_pinjam WHERE idpinjam = '$id'");
    return mysqli_affected_rows($conn);
}

// update tabel pinjam
function update($data){
    global $conn;
    $idp = $data['idpinjam'];   

    $jumlah = $data['jumlah'];
    $penerima = $data['penerima'];

    $query = "UPDATE tb_pinjam
              SET
              idsiswa            = '$penerima',
              jumlah           = '$jumlah'
              WHERE idpinjam   = '$idp'
             ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);  
}

// pengembaliaan barang
function kembali($data){
    global $conn;

    $namabarang = $data['idbarang'];
    $idpinjam = $data['idpinjam'];
    $penerima = $data['idsiswa'];
    $tanggal = date('y-m-d');
    $jumlah = $data['jumlah'];
    
    $query = "INSERT INTO tb_masuk
              VALUES
              ('','$idpinjam','$namabarang','$penerima','$tanggal','$jumlah')
             ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

// Delete data pinjam
function hapus_masuk($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM tb_masuk WHERE idmasuk = '$id'");
    return mysqli_affected_rows($conn);
}

// menambah data barang bermasalah
function catatan($data){
    global $conn;

    $nama = $data['barang'];
    $status = $data['status'];
    $jumlah = $data['jumlah'];

    $query = "INSERT INTO catatan
              VALUES
              ('','$nama','$status','$jumlah')
             ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

// Delete data pinjam
function hapus_catatan($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM catatan WHERE idcatat = '$id'");
    return mysqli_affected_rows($conn);
}

// update tabel pinjam
function update_catatan($data){
    global $conn;
    $idp = $data['idcatat'];   

    $jumlah = $data['jumlah'];
    $status = $data['status'];

    $query = "UPDATE catatan
              SET
              jumlah            = '$jumlah',
              status           = '$status'
              WHERE idcatat   = '$idp'
             ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);  
}

// Registrasi akun
function regist($data){
    global $conn;

    $nama = $data['nama'];
    $no = $data['telpon'];
    $email = $data['username'];
    $password = $data['password'];

    $query = "INSERT INTO user
              VALUES
              ('','$nama','$no','$email','$password','user');
              ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

// Lupa Password
function lupa($data){
    global $conn;

    $nomor = $data['telpon'];
    $password = $data['password'];

    $query = "UPDATE user
             SET
             password = '$password'
             WHERE telpon = '$nomor'
             ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

// menambah data barang bermasalah
function siswa($data){
    global $conn;

    $absen = $data['absen'];
    $nama = $data['nama'];
    $kelas = $data['kelas'];

    $query = "INSERT INTO siswa
              VALUES
              ('','$absen','$nama','$kelas')
             ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

// Delete data siswa
function hapus_siswa($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM siswa WHERE idsiswa = '$id'");
    return mysqli_affected_rows($conn);
}

// update tabel siswa
function update_siswa($data){
    global $conn;
    $id = $data['idsiswa'];   

    $absen = $data['absen'];
    $nama = $data['nama'];
    $kelas = $data['kelas'];

    $query = "UPDATE siswa
              SET
              absen          = '$absen',
              nama_siswa     = '$nama',
              Kelas          = '$kelas'
              WHERE idsiswa  = '$id'
             ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);  
}

// Delete data akun
function hapus_akun($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM user WHERE iduser = '$id'");
    return mysqli_affected_rows($conn);
}
?>