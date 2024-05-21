<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (password_verify($current_password, $user['password'])) {
        if ($new_password == $confirm_password) {
            $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);
            $update_query = "UPDATE users SET password = ? WHERE username = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ss", $new_password_hashed, $username);

            if ($update_stmt->execute()) {
                echo "Password changed successfully.";
            } else {
                echo "Error: " . $update_stmt->error;
            }
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <title>Change Password</title>
</head>
<body>
    <div class="flex">
        <main class="relative w-full h-screen bg-gray-100">
            <div class="bg-emerald-200" style="height: 33.4%;"></div>
            <div class="absolute top-0 bottom-0 left-0 right-0">
                <div class="flex items-center gap-4 mx-4 my-4 mb-12">
                    <a href="settings.php"><i class="p-1 px-2 text-2xl rounded-md bx bx-arrow-back bg-emerald-200"></i></a>
                    <h1 class="text-3xl font-semibold">Change Password</h1>
                </div>
                <div class="flex flex-col gap-4 p-4 mx-4 bg-white rounded-md shadow-md">
                    <form method="POST" action="changepassword.php">
                        <div class="flex flex-col gap-2">
                            <label for="current_password">Current Password</label>
                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                                required
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="new_password">New Password</label>
                            <input
                                type="password"
                                id="new_password"
                                name="new_password"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                                required
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="confirm_password">Confirm New Password</label>
                            <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                                required
                            />
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="px-4 py-2 text-white bg-emerald-400 rounded-md">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
