<?php
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification</title>
</head>
<style>
    table, td {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
    }
    .key {
        width: 35%;
        font-weight: bold;
    }
</style>
<body>
    <p>Kepada Administrator,</p>
    <p>Berikut ini informasi terkait pengguna yang sudah melakukan pembaruan data dari aplikasi GIKHub.</p>
    <table>
        <tr>
            <td class="key">Nama</td>
            <td>{{ $nama }}</td>
        </tr>
        <tr>
            <td class="key">Nomor Telepon</td>
            <td>{{ $telepon }}</td>
        </tr>
        <tr>
            <td class="key">Tanggal Pembaruan</td>
            <td>{{ $tanggalUpdate }}</td>
        </tr>
    </table>
    <br>
    <p>Demikian  informasi yang dapat kami sampaikan untuk dapat ditindaklanjuti.</p>
    <p>Terima kasih.</p>
    <br>
    <p>Tertanda,</p>
    <p>Data Umat GIKHub</p>
</body>
</html>
