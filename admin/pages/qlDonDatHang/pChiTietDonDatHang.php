<?php
   if(!isset($_GET["id"]))
      DataProvider::ChangeURL("index.php?c=404");

    $id = $_GET["id"];
    $sql = "SELECT  d.MaDonDatHang, d.NgayLap, d.TonhThanhTien, t.TenHienThi, t.DiaChi, t.DienThoai, tt.MaTinhTrang, tt.TenTinhTrang FROM TaiKhoan t, DonDatHang d, TinhTrang tt 
              WHERE d.MaTaiKhoan = t.MaTaiKhoan AND d.MaTinhTrang = tt.MaTinhTran AND MaDonDatHang = $id";
             $result = DataProvider::ExecuteQuery($sql);
             $row = mysqli_fetch_array($result);
?>
<fieldset>
     <legend>Thông tin đơn đặt hàng</legend>
     <div>
          <span>Mã đơn đặt hàng:</span>
          <?php echo $row["MaDonDatHang"]; ?>
      </div>
      <div>
          <span>Ngày đăt hàng:</span>
          <?php echo $row["NgayLap"]; ?>
      </div>
      <div>
          <span>Tên khách hàng:</span>
          <?php echo $row["TenHienThi"]; ?>
      </div>
      <div>
          <span>Số điện thoại:</span>
          <?php echo $row["DienThoai"]; ?>
      </div>
      <div>
          <span>Địa chỉ giao hàng:</span>
          <?php echo $row["DiaChi"]; ?>
      </div>
      <div>
          <span>Tổng thành tiền:</span>
          <?php echo $row["TongThanhTien"]; ?> đồng
      </div>
      <a href="pages/qlDonDatHang/xlDonDatHang.php?a=2&id=<?php echo $id; ?>" class="btnGiaoHang">
           Giao hàng
      </a>
      <a href="pages/qlDonDatHang/xlDonDatHang.php?a=2&id=<?php echo $id; ?>" class="btnThanhToan">
           Thanh toán
      </a>
      <a href="pages/qlDonDatHang/xlDonDatHang.php?a=2&id=<?php echo $id; ?>" class="btnHuy">
           Hủy đơn hàng
      </a>
      <a href="#" onclick="window.print();" class="btnInDonHang">
            In đơn hàng
      </a>
</fieldset>
<h2>Chi tiết đơn hàng</h2>
<table cellspacing="0" border="1">
   <tr>
       <th width="100">STT</th>
       <th width="150">Tên sản phẩm</th>
       <th width="100">Hình</th>
       <th width="100">Số lượng</th>
       <th width="100">Giá bán</th>
    </tr>
    <?php
        $sql = "SELECT s.TenSanPham, s.HinhURL, c.SoLuong, c.GiaBan FROM ChiTietDonHang c, SanPham s WHERE c.MaSanPham = s.MaSanPham 
          AND c.MaDonDatHang = $id";
        $result = DataProvider::ExecuteQuery($sql);
        $i = 1;
        while($row = mysqli_fetch_array($result))
        {
            ?>
               <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row["TenSanPham"]; ?></td>
                  <td>
                      <img src="../images/<?php echo $row["HinhURL"]; ?>" height="35"/>
                  </td>
                  <td><?php echo $row["SoLuong"]; ?></td>
                  <td><?php echo $row["GiaBan"]; ?></td>
                </tr>
            <?php 
        }
    ?>
</table>
