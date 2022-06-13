<!doctype html>
<html lang="en">
<?php
session_start();
include './component/head.php';
include './connect/connect.php';
?>

<body>
    <?php
    include './component/navbar.php'
    ?>
    <div class="section-center">
        <div>
            <h1 class="compete">
                VIRTUAL<span class="stroke"> HACK</span>
            </h1>
            <h2 class="mb-0 project" style="color:#5fafd7">
                IMAGERY INTELLIGENCE BILLBOARD IDENTIFICATION
            </h2>
        </div>
    </div>
    <div class="wrap">
        <div class="indicator"></div>
    </div>


    <div class="container " style="margin-top:200px;margin-bottom:200px">
        <h1 class="mb-3">ป้ายที่ลงทะเบียน</h1>
        <div id="map"></div>
    </div>

    

    <?php
    include './component/footer.php';
    include './component/script.php';
    ?>
</body>

</html>