<a href="index.php" class="logo">
	<img src="./images/logo_cdg.png" alt="">
</a>

<input class="menu-icon" type="checkbox" id="menu-icon" name="menu-icon" />
<label for="menu-icon"></label>
<nav class="nav">
	<ul class="pt-5">
		<li><a style="text-decoration:none" href="index.php">หน้าแรก</a></li>
		<li><a style="text-decoration:none" 
		<?php 
			if(isset($_SESSION['username'])){
				echo 'href="manage.php"';
			}else{
				echo 'data-bs-toggle="modal" data-bs-target="#Login"';
			}
		?>>ตรวจสอบป้าย</a></li>

		<?php 
			if(isset($_SESSION['username'])){
			
			
		?>

		<li><a style="text-decoration:none" href="./process/logout.php">ออกจากระบบ</a></li>
<?php } ?>
		
	</ul>
</nav>

<!-- Login -->
<div class="modal fade" id="Login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="color:black" id="exampleModalLabel">ลงชื่อเข้าใช้</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="container">
					
					<form method="post" action="./process/login.php">
					<label for="exampleFormControlInput1" class="form-label">ชื่อผู้ใช้งาน</label>
						<input name="username" type="text" class="form-control" id="exampleFormControlInput1">
						<label for="exampleFormControlInput1" class="form-label mt-3">รหัสผ่าน</label>
						<input name="password" type="password" class="form-control " id="exampleFormControlInput1">
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
				<input class="btn btn-primary" type="submit" name="submit" value="ตกลง">
				</form>
			</div>
		</div>
	</div>
</div>