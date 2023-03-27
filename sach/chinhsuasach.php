<?php    

    require_once "../config.php";

    if(isset($_GET['id'])){
        if(!isset($_SESSION['tk'])){
            header('location: ../dangnhap.php');
            die();
        }
        $id = $_GET['id'];
        $sql = "SELECT * from sach where id = $id";
        $res = mysqli_query($conn,$sql);

        //TH id != id trong mang 
        if(mysqli_num_rows($res) == 0) {
            header('location: hienthisach.php');
            die();
        }

        $rows = mysqli_fetch_assoc($res);
        $tensach = $rows['tensach'];
        $tentg = $rows['tentg'];
        $nhaxuatban = $rows['nhaxuatban'];
        $ngayxb = $rows['ngayxb'];
        $sotrang = $rows['sotrang'];
        $tomtat = $rows['tomtat'];

    }
    else { //Truong hop xoa id khien id rong
        header('location: hienthisach.php');
        die();
    }

    if(isset($_POST['save'])){
        $id = $tensach = $tentg = $nhaxuatban = $ngayxb = $sotrang = $tomtat = '';
        // Lay id tu URL

        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        if(isset($_POST['tensach'])){
            $tensach = $_POST['tensach'];
        }
        if(isset($_POST['tentg'])){
            $tentg = $_POST['tentg'];
        }
        if(isset($_POST['nhaxuatban'])){
            $nhaxuatban = $_POST['nhaxuatban'];
        }
        if(isset($_POST['ngayxb'])){
            $ngayxb = $_POST['ngayxb'];
        }
        if(isset($_POST['sotrang'])){
            $sotrang = $_POST['sotrang'];
        }
        if(isset($_POST['tomtat'])){
            $tomtat = $_POST['tomtat'];
        }


       
        // In hoa tensach
        $tensach = strtoupper($tensach);

        //Fix lỗi SQL Injection
        $tensach = str_replace('\'','\\\'',$tensach);
        $tentg = str_replace('\'','\\\'',$tentg);
        $nhaxuatban = str_replace('\'','\\\'',$nhaxuatban);
        $ngayxb = str_replace('\'','\\\'',$ngayxb);
        $sotrang = str_replace('\'','\\\'',$sotrang);
        $tomtat = str_replace('\'','\\\'',$tomtat);

        $sql = "SELECT * from sach";
        $res = mysqli_query($conn,$sql);
        $trungtensach = 0;
        if($res == true){
            while($rows = mysqli_fetch_assoc($res)){
                if($rows['tensach'] == $tensach){
                    $trungtensach = 1;
                }
            }
        }
        if($trungtensach == 1){
            $errors['tensach'] = "<div class='text-danger'><i>Sách đã được thêm</i></div>";
        }

        $errors = array();
        if($tensach == ''){
            $errors['tensach'] = "<div class='text-danger'>Bạn chưa nhập tên sách.</div>";
        }
        if($tentg == ''){
            $errors['tentg'] = "<div class='text-danger'>Bạn chưa nhập tên tác giả.</div>";
        }
        if($nhaxuatban == ''){
            $errors['nhaxuatban'] = "<div class='text-danger'>Bạn chưa nhập nhà xuất bản.</div>";
        }
        if($ngayxb == ''){
            $errors['ngayxb'] = "<div class='text-danger'>Bạn chưa nhập ngày xuất bản.</div>";
        }
        if($sotrang == ''){
            $errors['sotrang'] = "<div class='text-danger'>Bạn chưa nhập số trang sách.</div>";
        }
        if($tomtat == ''){
            $errors['tomtat'] = "<div class='text-danger'>Bạn chưa nhập bản tóm tắt.</div>";
        }

        if(!$errors){
            $sql = "CALL chinhsuasach('$tensach','$tentg','$nhaxuatban','$ngayxb','$sotrang','$tomtat','$id')";
            $res = mysqli_query($conn,$sql);
            if($res == true){
                $_SESSION['chinhsuasach1'] = "<div class='text-success' style='font-size:20px'><strong>Chỉnh sửa sách thành công</strong></div>";
                header('location: hienthisach.php');
            }
            else {
                $_SESSION['chinhsuasach']="<div class='text-danger text-center' style='font-size:20px'><strong>Chỉnh sửa sách thất bại</strong></div>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÍ SÁCH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
    <div class="container mt-3">
        <a href="hienthisach.php" class="btn btn-primary">Quay trở lại</a>
        <h2 class="text-center bg-success text-white mt-4 mb-4">CHỈNH SỬA SÁCH</h2>

        <?php 
            if(isset($_SESSION['chinhsuasach1'])){
                echo $_SESSION['chinhsuasach1'];
                unset($_SESSION['chinhsuasach1']);
            }
        ?>

        <form  method="POST">
            <div class="row mb-5">
                <label for="tensach" class="form-label col-sm-2 text-end "><strong>Nhập tên sách</strong></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="tensach" placeholder="Nhập tên sách" name="tensach" value="<?php if(isset($tensach)) {echo $tensach;} ?>">
                    <?php 
                        if(isset($errors['tensach'])){
                            echo $errors['tensach'];
                        }
                    ?>
                </div>
            </div>

            <div class="row mb-5">
                <label for="tentg" class="form-label col-sm-2 text-end "><strong>Nhập tên tác giả</strong></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="tentg" placeholder="Nhập tên tác giả" name="tentg" value="<?php if(isset($tentg)) {echo $tentg;} ?>">
                    <?php 
                        if(isset($errors['tentg'])){
                            echo $errors['tentg'];
                        }
                    ?>
                </div>
            </div>

            <div class="row mb-5">
                <label for="nhaxuatban" class="form-label col-sm-2 text-end "><strong>Nhập tên NXB</strong></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nhaxuatban" placeholder="Nhập tên nhà xuất bản" name="nhaxuatban" value="<?php if(isset($nhaxuatban)) {echo $nhaxuatban;} ?>">
                    <?php 
                        if(isset($errors['nhaxuatban'])){
                            echo $errors['nhaxuatban'];
                        }
                    ?>
                </div>
            </div>
            
            <div class="row mb-5">
                <label for="ngayxb" class="form-label col-sm-2 text-end "><strong>Nhập ngày xuất bản</strong></label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="ngayxb" placeholder="Nhập ngày xuất bản" name="ngayxb" value="<?php if(isset($ngayxb)) {echo $ngayxb;} ?>">
                    <?php 
                        if(isset($errors['ngayxb'])){
                            echo $errors['ngayxb'];
                        }
                    ?>
                </div>
            </div>
            
            <div class="row mb-5">
                <label for="sotrang" class="form-label col-sm-2 text-end "><strong>Nhập số trang</strong></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="sotrang" placeholder="Nhập số trang" name="sotrang" value="<?php if(isset($sotrang)) {echo $sotrang;} ?>">
                    <?php 
                        if(isset($errors['sotrang'])){
                            echo $errors['sotrang'];
                        }
                    ?>
                </div>
            </div>

            <div class="row mb-5">
                <label for="tomtat" class="form-label col-sm-2 text-end "><strong>Nhập bản tóm tắt</strong></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="tomtat" placeholder="Nhập bản tóm tắt" name="tomtat" value="<?php if(isset($tomtat)) {echo $tomtat;} ?>">
                    <?php 
                        if(isset($errors['tomtat'])){
                            echo $errors['tomtat'];
                        }
                    ?>
                </div>
            </div>

            <button class="btn btn-success offset-sm-2" name="save">Lưu lại</button>

        </form>
    </div>
</body>
</html>