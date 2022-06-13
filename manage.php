<!doctype html>
<html lang="en">
<?php
session_start();
include './component/head.php';
include './connect/connect.php';


if (!isset($_SESSION['username'])) {
    header('location: ./index.php');
    $_SESSION['not_login'] == '1';
}

?>


<body>
    <?php
    include './component/navbar.php'
    ?>

    <div class="container" style="margin-top: 150px">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h1 class="mt-4" style="color:black">ป้ายที่ต้องตรวจสอบ</h1>
                    <?php
                    $sql = "SELECT * FROM billboard WHERE status = 'uncheck' ";
                    $query = mysqli_query($conn, $sql);

                    $num = mysqli_num_rows($query);
                    ?>
                    <p class="badge text-bg-secondary" style="color: grey">ทั้งหมด <?php echo $num ?> ป้าย</p>

                    <div class="table-responsive">
                        <table class="table table-light table-hover mt-3" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">ไอดี</th>
                                    <th scope="col">ชื่อสถานที่ใกล้เคียง</th>
                                    <th scope="col">จังหวัด</th>
                                    <th scope="col">ละติจูด</th>
                                    <th scope="col">ลองจิจูด</th>
                                    <th scope="col">ประเภทป้าย</th>
                                    <th scope="col">ตรวจสอบ</th>
                                    <th scope="col">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM billboard WHERE status = 'uncheck' ";
                                $query = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['id'] ?></th>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['province'] ?></td>
                                        <td><?php echo $row['lat'] ?></td>
                                        <td><?php echo $row['lng'] ?></td>
                                        <td><?php echo $row['type'] ?></td>
                                        <td>

                                            <a data-bs-toggle="modal" data-bs-target="#Confirm<?php echo $row['id'] ?>" class="btn btn-primary">ตรวจสอบ</a>
                                        </td>
                                        <td>

                                            <a data-bs-toggle="modal" data-bs-target="#Delete<?php echo $row['id'] ?>" class="btn btn-danger">ลบ</a>
                                        </td>
                                    </tr>

                                    <!-- Delete -->
                                    <div class="modal fade" id="Delete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" style="color:black" id="exampleModalLabel">ยืนยันการลบ</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <h5 style="color:black">คุณต้องการลบป้ายไอดี <?php echo $row['id'] ?> ใช่หรือไม่</h5>
                                                        <form method="post" action="./process/deleteBillboard.php">

                                                            <input hidden name="id" type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['id'] ?>">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                    <input class="btn btn-danger" type="submit" name="submit" value="ตกลง">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Confirm -->
                                    <div class="modal fade" id="Confirm<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" style="color:black" id="exampleModalLabel">ยืนยันการอนุมัติ</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <p align="center">
                                                        <img src="./images/segment/<?php echo $row['segment'] ?>" class="img-fluid mb-3" alt="">

                                                        </p>
                                                        <div class="row">
                                                            <form method="post" action="./process/confirmBillboard.php">

                                                                <div class="mb-3 col-6">
                                                                    <label for="exampleFormControlInput1" class="form-label">ชื่อสถานที่ใกล้เคียง</label>
                                                                    <input name="name" type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['name'] ?>">
                                                                </div>
                                                                <div class="mb-3 col-6">
                                                                    <label for="exampleFormControlInput1" class="form-label">จังหวัด</label>
                                                                    <select name="province" class="form-select" aria-label="Default select example">
                                                                        <option value="<?php echo $row['province'] ?>" selected><?php echo $row['province'] ?></option>
                                                                        <option value="กรุงเทพฯ">กรุงเทพฯ</option>
                                                                        <option value="ตาก">ตาก</option>
                                                                        <option value="ลำพูน">ลำพูน</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-6">
                                                                    <label for="exampleFormControlInput1" class="form-label">ละติจูด</label>
                                                                    <input name="lat" type="number" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['lat'] ?>">
                                                                </div>
                                                                <div class="mb-3 col-6">
                                                                    <label for="exampleFormControlInput1" class="form-label">ลองจิจูด</label>
                                                                    <input name="lng" type="number" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['lng'] ?>">
                                                                </div>
                                                                <div class="mb-3 col-6">
                                                                    <label for="exampleFormControlInput1" class="form-label">ประเภทป้าย</label>
                                                                    <select name="type" class="form-select" aria-label="Default select example">
                                                                        <option value="<?php echo $row['type'] ?>" selected><?php echo $row['type'] ?></option>
                                                                        <option value="ป้ายอักษรไทยล้วน ">ป้ายอักษรไทยล้วน </option>
                                                                        <option value="ป้ายอักษรไทยปนกับอักษรต่างประเทศ">ป้ายอักษรไทยปนกับอักษรต่างประเทศ</option>
                                                                        <option value="ป้ายที่มีข้อความ เครื่องหมาย หรือภาพที่เคลื่อนที่  ">ป้ายที่มีข้อความ เครื่องหมาย หรือภาพที่เคลื่อนที่</option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3 col-6">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                        <label for="exampleFormControlInput1" class="form-label">กว้าง (เมตร)</label>
                                                                    <input name="width" type="number" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['height'] ?>">
                                                              
                                                                        </div>
                                                                        <div class="col-6">
                                                                        <label for="exampleFormControlInput1" class="form-label">ยาว (เมตร)</label>
                                                                    <input name="height" type="number" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['width'] ?>">
                                                              
                                                                        </div>
                                                                    </div>
                                                                     </div>
                                                        </div>


                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <input hidden name="id" type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['id'] ?>">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                    <input class="btn btn-primary" type="submit" name="submit" value="ตกลง">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            </tbody>
                        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>






    </div>






    <?php
    $lat = "<script>document.writeln(position.coords.latitude);</script>";
    $lng = "<script>document.writeln(position.coords.longitude);</script>";

    ?>


    <script>
        var x = document.getElementById("location");

        function getlocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
            }
        }
    </script>





    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <?php
    include './component/script.php'
    ?>

    <?php

    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);

    ?>

        <script>
            Swal.fire({
                title: 'เสร็จสิ้น!',
                text: 'คุณลงชื่อเข้าใช้เรียบร้อยแล้ว',
                icon: 'success',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#198754'
            })
        </script>
    <?php } ?>
    <?php
    if (isset($_SESSION['success']) and $_SESSION['success'] == 'add') {
    ?>
        <script>
            Swal.fire({
                title: 'เสร็จสิ้น!',
                text: 'คุณอนุมัติป้ายเรียบร้อยแล้ว',
                icon: 'success',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#198754'
            })
        </script>
    <?php } else if (isset($_SESSION['success']) and $_SESSION['success'] == 'delete') {
    ?>
        <script>
            Swal.fire({
                title: 'เสร็จสิ้น!',
                text: 'คุณลบป้ายเรียบร้อยแล้ว',
                icon: 'success',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#198754'
            })
        </script>
    <?php } else if (isset($_SESSION['success']) and $_SESSION['success'] == 'edit') {

    ?>
        <script>
            Swal.fire({
                title: 'เสร็จสิ้น!',
                text: 'คุณแก้ไขข้อมูลป้ายเรียบร้อยแล้ว',
                icon: 'success',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#198754'
            })
        </script>

    <?php }
    unset($_SESSION['success']);
    ?>


</body>

</html>