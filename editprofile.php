<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $sql = "UPDATE profile SET nama=?, telepon=?, email=?, jenis_kelamin=?, agama=?, alamat=?, tanggal_lahir=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $nama, $telepon, $email, $jenis_kelamin, $agama, $alamat, $tanggal_lahir, $id);

    if ($stmt->execute()) {
        header('Location: settings.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $username = $_SESSION['username'];
    $query = "
        SELECT u.id, p.nama, p.telepon, p.email, p.jenis_kelamin, p.agama, p.alamat, p.tanggal_lahir, p.role 
        FROM users u 
        LEFT JOIN profile p ON u.id = p.id 
        WHERE u.username = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
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
    <title>Edit Profile</title>
</head>
<body>
    <div class="flex">
        <main class="relative w-full h-screen bg-gray-100">
            <div class="bg-emerald-200" style="height: 33.4%;"></div>
            <div class="absolute top-0 bottom-0 left-0 right-0">
                <div class="flex items-center gap-4 mx-4 my-4 mb-12">
                    <a href="settings.php"><i class="p-1 px-2 text-2xl rounded-md bx bx-arrow-back bg-emerald-200"></i></a>
                    <h1 class="text-3xl font-semibold">Edit Profile</h1>
                </div>
                <div class="flex flex-col gap-4 p-4 mx-4 bg-white rounded-md shadow-md">
                    <form method="POST" action="editprofile.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>" />
                        <div class="flex flex-col gap-2">
                            <label for="nama">Nama</label>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="<?php echo $user['nama']; ?>"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="telepon">Telepon</label>
                            <input
                                type="text"
                                id="telepon"
                                name="telepon"
                                value="<?php echo $user['telepon']; ?>"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?php echo $user['email']; ?>"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input
                                type="text"
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                value="<?php echo $user['jenis_kelamin']; ?>"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="agama">Agama</label>
                            <input
                                type="text"
                                id="agama"
                                name="agama"
                                value="<?php echo $user['agama']; ?>"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="alamat">Alamat</label>
                            <input
                                type="text"
                                id="alamat"
                                name="alamat"
                                value="<?php echo $user['alamat']; ?>"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input
                                type="date"
                                id="tanggal_lahir"
                                name="tanggal_lahir"
                                value="<?php echo $user['tanggal_lahir']; ?>"
                                class="px-4 py-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="px-4 py-2 text-white bg-emerald-400 rounded-md">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
