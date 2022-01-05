<?php
  $conn = new PDO("mysql:host=localhost;dbname=geoip;charset=utf8", "root", "");

  if (($handle = fopen("geoip.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $geoip = array();
        for ($c=0; $c < $num; $c++) {
            array_push($geoip, $data[$c]);
        }

        $sql = "INSERT INTO geoip (ip_from, ip_to, country_code, country_name, region_name, city_name, latitude, longitude) VALUES (" . array_values($geoip)[0] . ", " . array_values($geoip)[1] . ", '" . array_values($geoip)[2] . "', '" . array_values($geoip)[3] . "', '" . array_values($geoip)[4] . "', '" . array_values($geoip)[5] . "', " . array_values($geoip)[6] . ", " . array_values($geoip)[7] . ");";
        $result = $conn->prepare($sql);
        $result->execute();
    }
    fclose($handle);
  }
?>