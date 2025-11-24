<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=laundry_taufiq', 'root', '');
} catch (\Exception $c) {
    die('koneksi gagal => '. $c->getMessage());
}

// try {
//     $db = mysqli_connect('localhost', 'root', '', 'db_laundry_taufiq');
// } catch (\Exception $c) {
//     die('koneksi gagal => '. $c->getMessage());
// }2
//     die('gagal' . mysqli_connect_error());
// }

// define ('URL', 'http://localhost/11rpl1_apollonia/laundry/');

// EOF
?>