<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, phone, password) VALUES ('$username', '$phone', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Registration successful! Please login.";
        header("Location: signin.php");
        exit(); 
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>UTS</title>
</head>
<body>
    <div class="w-screen h-screen flex items-center justify-center bg-emerald-100">
        <div class="w-1/3 h-auto bg-white rounded-lg shadow-md p-4">
            <p class="font-sans text-center font-semibold text-2xl mb-12">Daftar Akun</p>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<p class="text-center text-red-500">'.$_SESSION['message'].'</p>';
                unset($_SESSION['message']);
            }
            ?>
            <form action="signup.php" method="post" class="w-full h-full mt-4 flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="username" class="font-sans font-semibold">Username</label>
                    <input type="text" name="username" id="username" class="w-full h-10 rounded-md border-2 border-gray-400 p-2" required />
                </div>
                <div class="flex flex-col gap-2">
                    <label for="phone" class="font-sans font-semibold">Telephone</label>
                    <input type="number" name="phone" id="phone" class="w-full h-10 rounded-md border-2 border-gray-400 p-2" required />
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password" class="font-sans font-semibold">Password</label>
                    <input type="password" name="password" id="password" class="w-full h-10 rounded-md border-2 border-gray-400 p-2" required />
                </div>
                <button type="submit" class="w-full h-10 bg-emerald-400 rounded-md text-white font-semibold">Daftar</button>
                <p class="text-center font-sans">Sudah punya akun? <a href="signin.php" class="text-emerald-400 font-semibold">Masuk</a></p>
            </form>
        </div>
    </div>
</body>
</html>
