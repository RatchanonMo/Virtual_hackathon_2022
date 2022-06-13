<script>
    let map;

    function initMap() {
        const myLatLng = {
            lat: 18.790950958226272,
            lng: 98.98805774963338
        };

        map = new google.maps.Map(document.getElementById("map"), {
            center: myLatLng,
            zoom: 15,
        });

        const tourStops = [
            <?php
            $sql = "SELECT * FROM billboard  ";
            $query = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($query)) {
            ?>[{
                        lat: <?php echo $row['lat'] ?>,
                        lng: <?php echo $row['lng'] ?>
                    },
                    "<div class='infoWindow'><p align='center'><img src='./images/<?php echo $row['img'] ?>' style='width:250px'></p><span class='infoTitle'><?php echo $row['name'] ?> </span><br>ไอดี : <?php echo $row['id'] ?><br>จังหวัด : <?php echo $row['province'] ?> <br>ขนาด (เมตร) : <?php echo $row['width'] ?> x <?php echo $row['height'] ?> <br>ประเภทป้าย : <?php echo $row['type'] ?><br>สถานะ : <?php if($row['status'] == 'checked'){ ?><span style='color:#17c964'>ตรวจสอบแล้ว</span> <?php }else{ ?><span style='color:#f5a524'>กำลังรอการตรวจสอบ</span><?php } ?> <?php if($row['status'] == 'checked'){ ?><br>วันที่ลงทะเบียน : <?php echo $row['date'] ?><?php } ?></div>"
                    ,"<?php if($row['status'] == 'checked'){ echo 'http://maps.google.com/mapfiles/kml/paddle/red-circle.png';}else{ echo 'http://maps.google.com/mapfiles/kml/paddle/orange-circle.png';} ?>"
                ],

            <?php } ?>

        ];
        // Create an info window to share between markers.
        const infoWindow = new google.maps.InfoWindow();
        // Create the markers.
        tourStops.forEach(([position, title], i) => {
            const marker = new google.maps.Marker({
                position,
                map,
                title: `${i + 1}. ${title}`,
                optimized: false,
                icon: tourStops[i][2]
            });

            // Add a click listener for each marker, and set up the info window.
            marker.addListener("click", () => {
                infoWindow.close();
                infoWindow.setContent(marker.getTitle());
                infoWindow.open(marker.getMap(), marker);
            });
        });
    }

    window.initMap = initMap;
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7awcpJruK2VDI3CGXMQm_ciaWD63h8Bs&callback=initMap&v=weekly"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>