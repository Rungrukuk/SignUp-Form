<?php

function clearHarmfullCharacter($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["email"])) {
        $em = "Serverdə xəta baş verdi. Zəhmət olmasa bir müddət sonra yenidən yoxlayın!";
        header("Location: ../login.php?error=$em");
        exit;
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    if (empty($username)) {
        $em = "İstifadəçi adı doldurulmalıdır!";
        header("Location: ../index.php?error=$em");
        exit;
    }
    if (empty($password)) {
        $em = "Şifrə doldurulmalıdır!";
        header("Location: ../index.php?error=$em");
        exit;
    }
    if (empty($email)) {
        $em = "E-mail doldurulmalıdır!";
        header("Location: ../index.php?error=$em");
        exit;
    }
    $username = clearHarmfullCharacter($username);
    $password = clearHarmfullCharacter($password);
    $email = clearHarmfullCharacter($email);

    if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
        $em = "İstifadəci adında sadəcə hərflər və boşluq qoyula bilər";
        header("Location: ../index.php?error=$em");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $em = "Yanlış E-mail formatı";
        header("Location: ../index.php?error=$em");
        exit;
    }
    $em = "Uğurlu Əməliyyat";
    header("Location: ../home.php?success=$em");
    exit;
}
