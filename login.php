<?php
session_start();

$link = mysqli_connect("localhost", "root", "ketrin123", "db_ketrin");

if (isset($_POST['login'])) {
    $_usr = trim($_POST['user']);
    $_pas = trim($_POST['pass']);

    if ($_usr == '' or $_pas == '') {
        echo "Data tidak boleh kosong";
    } else if ($_usr == 'admin' and $_pas == 'admin') {
        $_SESSION['user'] = "Administrator";
        echo "Login berhasil <br><br>";
        header("Location: index.php");
        exit();
    }
    else{
        $sql = "SELECT count(*) FROM mahasiswa WHERE nama='$_usr' AND nim='$_pas'";
        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_row($result);
    
        if ($data[0] == 1) {
            $_SESSION['user'] = $_usr;
            echo "Login Berhasil";
            header("Location: index.php");
            exit();
        } else {
            echo "Silahkan masukkan Username dan Password <br><br>";
        }
    }
} 

if (!isset($_SESSION['user'])) {
    echo "
    <p>Silahkan masukkan Username dan Password</p>
    <form method='POST' action=''>
    <input type='text' name='user' placeholder='Username'><br><br>
    <input type='password' name='pass' placeholder='Password'><br><br>
    <input type='submit' name='login' value='Login' id='submit'>
</form>";
} 
else {
    echo "<a href='index.php?logout'>Logout</a>";
}
?>