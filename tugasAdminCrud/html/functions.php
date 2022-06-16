<?php
$db = "labkom";
$host = "localhost";
$user = "root";
$passwd = "";
$conn = mysqli_connect($host, $user, $passwd, $db);

function query($query)
{
    global $conn;
    // ambil data dari tabel mahasiswa / query data mahasiswa
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $semester = htmlspecialchars($data["semester"]);
    $nohp = htmlspecialchars($data["nohp"]);

    $query = "INSERT INTO laboratorium VALUES (NULL, '$nama', '$semester', '$nohp')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM laboratorium WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $semester = htmlspecialchars($data["semester"]);
    $nohp = htmlspecialchars($data["nohp"]);

    $query = "UPDATE laboratorium SET nama = '$nama', semester = '$semester', nohp = '$nohp' WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM laboratorium WHERE nama LIKE '%$keyword%' OR semester LIKE '%$keyword%' OR nohp LIKE '%$keyword%'";
    return query($query);
}
