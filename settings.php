<?php 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

include('config.php');

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: signin.php");
    exit();
}

$username = $_SESSION['username'];
$query = "
    SELECT u.id, u.username, u.phone, p.nama, p.telepon, p.email, p.jenis_kelamin, p.agama, p.alamat, p.tanggal_lahir, p.role 
    FROM users u 
    LEFT JOIN profile p ON u.id = p.id 
    WHERE u.username = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User profile not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Manage Mart</title>
</head>
<body>
    <div class="flex">
        <aside class="flex flex-col items-center justify-between w-1/5 h-screen text-black shadow-md bg-emerald-100">
            <div class="flex flex-col items-center w-full h-full bg-emerald-400">
                <p class="py-4 text-xl font-semibold text-center">Manage Mart</p>
                <div class="flex flex-col items-center gap-2 pb-[1.7px]">
                    <span class="object-cover rounded-full aspect-square">
                        <img src="./public/images/logo.png" alt="Profile" class="w-32 h-32 rounded-full" />
                    </span>
                    <p class="text-lg"><?php echo $user['nama']; ?></p>
                </div>
                <ul class="flex flex-col w-full gap-2 px-4 pt-4 mt-4 bg-white">
                    <li class="rounded-md">
                        <a href="dashboard.php" class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                            <i class="text-2xl cursor-pointer bx bxs-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="rounded-md">
                        <a href="products.php" class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                            <i class="text-2xl bx bx-box"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="rounded-md bg-emerald-400">
                        <a href="settings.php" class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                            <i class="text-2xl bx bx-cog"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex items-end w-full h-full px-4 pb-4 bg-white">
                <form method="POST">
                    <button type="submit" name="logout" class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                        <i class="text-2xl bx bx-log-out"></i>
                        <p>Logout</p>
                    </button>
                </form>
            </div>
        </aside>
        <main class="relative w-4/5 h-screen bg-gray-100">
            <div class="w-full bg-emerald-200" style="height: 33.4%;"></div>
            <div class="absolute top-0 bottom-0 left-0 right-0 flex flex-col h-full">
                <div class="flex flex-col gap-4 p-4 bg-emerald-200">
                    <div class="flex items-center justify-center gap-4">
                        <p class="pb-4 font-semibold border-b-2 border-black cursor-pointer">Profile</p>
                        <p class="pb-4 border-b-2 border-transparent cursor-pointer">Account</p>
                        <p class="pb-4 border-b-2 border-transparent cursor-pointer">Security</p>
                        <p class="pb-4 border-b-2 border-transparent cursor-pointer">Notification</p>
                        <p class="pb-4 border-b-2 border-transparent cursor-pointer">Application</p>
                    </div>
                </div>
                <div class="flex h-full gap-4 p-4 py-4 m-4 bg-white rounded-lg shadow">
                    <img src="./public/images/Ardi.png" alt="Profile" class="w-1/4 rounded-md shadow-md aspect-square h-60">
                    <div class="flex flex-col justify-between w-3/4 h-full">
                        <div class="flex flex-col gap-2">
                            <p>Nama: <?php echo $user['nama']; ?></p>
                            <p>Telepon: <?php echo $user['telepon']; ?></p>
                            <p>Email: <?php echo $user['email']; ?></p>
                            <p>Jenis Kelamin: <?php echo $user['jenis_kelamin']; ?></p>
                            <p>Agama: <?php echo $user['agama']; ?></p>
                            <p>Alamat: <?php echo $user['alamat']; ?></p>
                            <p>Tanggal Lahir: <?php echo $user['tanggal_lahir']; ?></p>
                            <p>Role: <?php echo $user['role']; ?></p>
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="editprofile.php" class="px-4 py-2 text-white rounded-md bg-emerald-400">Edit Profile</a>
                            <a href="changepassword.php" class="px-4 py-2 text-white rounded-md bg-emerald-400">Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
