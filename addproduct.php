<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO products (name, category, price, stock) VALUES ('$name', '$category', '$price', '$stock')";
    if ($conn->query($sql) === TRUE) {
        header('Location: products.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function convertIDR($amount) {
    return "Rp " . number_format($amount, 0, ',', '.');
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
    <title>Mafstore</title>
</head>
<body>
<div class="flex">
    <aside class="flex flex-col items-center justify-between w-1/5 h-screen text-black shadow bg-emerald-100">
        <div class="flex flex-col items-center w-full h-full shadow bg-emerald-400">
            <p class="py-4 text-xl font-semibold text-center">Mafstore</p>
            <div class="flex flex-col items-center gap-2 pb-[1.7px]">
                <span class="object-cover rounded-full aspect-square">
                    <img src="./public/images/Ardi.png" alt="Profile" class="w-32 h-32 rounded-full"/>
                </span>
                <p class="text-lg">Ardiansyah</p>
            </div>
            <ul class="flex flex-col w-full gap-2 px-4 pt-4 mt-4 bg-white">
                <li class="rounded-md">
                    <a href="dashboard.php" class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                        <i class="text-2xl cursor-pointer bx bxs-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="rounded-md bg-emerald-400">
                    <a href="products.php" class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                        <i class="text-2xl bx bx-box"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="rounded-md">
                    <a href="settings.php" class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                        <i class="text-2xl bx bx-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="flex items-end w-full h-full px-4 pb-4 bg-white">
            <button class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                <i class="text-2xl bx bx-log-out"></i>
                <p>Logout</p>
            </button>
        </div>
    </aside>
    <main class="relative w-4/5 h-screen bg-gray-100">
        <div class="bg-emerald-200" style="height: 33.4%;"></div>
        <div class="absolute top-0 bottom-0 left-0 right-0">
            <div class="flex items-center gap-4 mx-4 my-4 mb-12">
                <a href="products.php"><i class="p-1 px-2 text-2xl rounded-md bx bx-left-arrow-alt bg-emerald-300"></i></a>
                <p class="w-40 px-4 py-2 font-semibold text-center rounded bg-emerald-300">Add Products</p>
            </div>
            <div class="flex justify-center w-full">
                <div class="h-auto p-4 bg-white rounded-lg shadow-md w-96">
                    <form action="addproduct.php" method="POST" class="flex flex-col gap-4">
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-black">Name Product</label>
                            <input type="text" id="name" name="name" class="p-2 border-2 rounded outline-white" required>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="category" class="text-black">Category Product</label>
                            <input type="text" id="category" name="category" class="p-2 border-2 rounded outline-white" required>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="price" class="text-black">Price Product</label>
                            <input type="number" id="price" name="price" class="p-2 border-2 rounded outline-white" required>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="stock" class="text-black">Stock Product</label>
                            <input type="number" id="stock" name="stock" class="p-2 border-2 rounded outline-white" required>
                        </div>
                        <button type="submit" class="px-3 py-2 font-semibold text-white rounded place-content-end bg-emerald-500">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
