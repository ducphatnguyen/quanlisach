<?php 
    include('config.php');
    if(isset($_POST['submit'])){
        
        $tk = $mk = '';

        if(isset($_POST['tk'])){
            $tk = $_POST['tk'];
        }

        if(isset($_POST['mk'])){
            $mk = $_POST['mk'];
        }

        $mk = str_replace("\'","\\\'",$mk);
        $tk = str_replace('\'','\\\'',$tk);

        $errors = array();
        if($mk ==''){
            $errors['mk'] = "<span style='color:red;'><i>Bạn chưa nhập mật khẩu</i></span>";
        }
        if($tk==''){
            $errors['tk'] = "<span style='color:red;'><i>Bạn chưa nhập tài khoản</i></span>";
        }
        if(!$errors){
            $sql = "SELECT * from admin";
            $res = mysqli_query($conn,$sql);

            $kq = 0;
            if($res == true){
                while($rows = mysqli_fetch_assoc($res)){
                    if($rows['tk'] == $tk && $rows['mk'] == $mk){
                        $kq =1;
                    }
                }
                if($kq == 0){
                    $_SESSION['dangnhap']="<div style='color:red;font-weight:bold;text-align:center;'><b>Tài khoản hoặc mật khẩu không hợp lệ!</b></div>";
                }
                else{
                    $_SESSION['tk'] = $tk;
                    header('location: sach/hienthisach.php');
                }
            }
        }else{
            $_SESSION['dangnhap']="<div style='color:red;font-weight:bold;text-align:center;'><b>Đăng nhập thất bại !</b></div>";
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" method="POST">
                <?php 
                    if(isset($_SESSION['dangnhap'])){
                    echo $_SESSION['dangnhap'];
                    unset($_SESSION['dangnhap']);
                    }
                ?>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" name="tk" class="login__input" placeholder="Tài Khoản">
                    <?php 
                        if(isset($errors['tk'])){
                        echo $errors['tk'];
                        }
                    ?>
				</div>
                
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="mk" class="login__input" placeholder="Mật Khẩu">
                    <?php 
                        if(isset($errors['mk'])){
                        echo $errors['mk'];
                        }   
                    ?>
				</div>

				<button type="submit" value="Đăng nhập" name="submit" class="button login__submit">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>
</html>

