<?php
include '../../lib/DataProvider.php';
session_start();



if (isset($_POST["username"]) && isset($_POST["password"])) {


    $un = $_POST["username"];
    $pw = $_POST["password"];
    $sql = "select * from TaiKhoan where BiXoa = 0 
    and TenDangNhap = '$un' and MatKhau='$pw' ";
    $result = DataProvider::ExecuteQuery($sql);
    $row = mysqli_fetch_array($result);
    if ($row == null)
        DataProvider::ChangeURL("../../index.php");
    else {
        $_SESSION["MaTaiKhoan"] = $row["MaTaiKhoan"];
        $_SESSION["MaLoaiTaiKhoan"] = $row["MaLoaiTaiKhoan"];
        $_SESSION["TenHienThi"] = $row["TenHienThi"];
    }

    if ($row["MaLoaiTaiKhoan"] == 2) 
        {
            DataProvider::ChangeURL("../../index.php");
     } 
    else
     {
        $curURL = $_SESSION["path"];
        DataProvider::ChangeURL($curURL);
        #DataProvider::ChangeURL("../../index.php");
    }
} else 
{
    DataProvider::ChangeURL("../../index.php");
}

?>