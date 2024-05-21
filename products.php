<?php
include 'config.php';

function convertIDR($amount) {
    return "Rp " . number_format($amount, 0, ',', '.');
    
}
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: signin.php");
    exit();
}
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sort_direction = isset($_GET['direction']) ? $_GET['direction'] : 'asc';
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM products WHERE name LIKE '%$search_term%' OR category LIKE '%$search_term%' ORDER BY $sort_column $sort_direction";
$result = $conn->query($sql);

function getSortDirection($current_direction) {
    return $current_direction === 'asc' ? 'desc' : 'asc';
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
    <title>Manage Mart</title>
    <script>
        function sortTable(column, currentDirection) {
            const urlParams = new URLSearchParams(window.location.search);
            const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
            urlParams.set('sort', column);
            urlParams.set('direction', newDirection);
            window.location.search = urlParams.toString();
        }

        let debounceTimeout;
        function searchProducts() {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                const searchInput = document.querySelector('input[name="search"]').value;
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('search', searchInput);
                window.location.search = urlParams.toString();
            }, 300); 
        }
    </script>
</head>
<body>
    <div class="flex">
    
        <aside class="flex flex-col items-center justify-between w-1/5 h-screen text-black shadow bg-emerald-100">
            <div class="flex flex-col items-center w-full h-full shadow bg-emerald-400">
                <p class="py-4 text-xl font-semibold text-center">Manage Mart</p>
                <div class="flex flex-col items-center gap-2 pb-[1.7px]">
                    <span class="object-cover rounded-full aspect-square">
                        <img src="./public/images/logo.png" alt="Profile" class="w-32 h-32 rounded-full" />
                    </span>
                    <p class="text-lg">Muhammad Ardiansyah Firdaus</p>
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
                <form method="POST">
                    <button type="submit" name="logout" class="flex items-center w-full gap-4 px-2 py-1 rounded-md">
                        <i class="text-2xl bx bx-log-out"></i>
                        <p>Logout</p>
                    </button>
                </form>
            </div>
        </aside>

    
        <main class="relative w-4/5 h-screen bg-gray-100">
            <div class="bg-emerald-200" style="height: 33.4%;"></div>
            <div class="absolute top-0 bottom-0 left-0 right-0">
                <div class="flex items-center justify-between m-4">
                    <p class="w-40 px-4 py-2 font-semibold text-center rounded bg-emerald-300">All Products</p>
                    <div class="flex items-center gap-2">
                        <a href="addproduct.php"><i class="px-2 py-1 text-2xl rounded cursor-pointer bx bx-plus bg-emerald-300"></i></a>
                        <div class="relative">
                            <i class="absolute text-xl -translate-y-1/2 left-2 bx bx-search top-1/2"></i>
                            <input type="text" name="search" class="py-2 rounded-md ps-9" placeholder="Search Product" onkeyup="searchProducts()">
                        </div>
                    </div>
                </div>
                <div class="flex h-[40rem] gap-4 p-4 py-4 m-4 bg-white rounded-lg items-start shadow">
                    <table class="w-full max-h-full border">
                        <thead class="bg-gray-100 max-h-12">
                            <tr>
                                <th class="py-2 border-2 rounded-tl cursor-pointer" onclick="sortTable('id', '<?php echo $sort_direction; ?>')">No</th>
                                <th class="py-2 border-2 cursor-pointer" onclick="sortTable('name', '<?php echo $sort_direction; ?>')">Name</th>
                                <th class="py-2 border-2 cursor-pointer" onclick="sortTable('category', '<?php echo $sort_direction; ?>')">Category</th>
                                <th class="py-2 border-2 cursor-pointer" onclick="sortTable('price', '<?php echo $sort_direction; ?>')">Price</th>
                                <th class="py-2 border-2 cursor-pointer" onclick="sortTable('stock', '<?php echo $sort_direction; ?>')">Stock</th>
                                <th class="py-2 border-2 rounded-tr">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-2 border-gray-100 rounded-b">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="text-center max-h-12" id="list-product">
                                <td class="py-2"><?php echo $row['id']; ?></td>
                                <td class="py-2"><?php echo $row['name']; ?></td>
                                <td class="py-2"><?php echo $row['category']; ?></td>
                                <td class="py-2"><?php echo convertIDR($row['price']); ?></td>
                                <td class="py-2"><?php echo $row['stock']; ?></td>
                                <td class="flex items-center gap-4 px-4 py-2">
                                    <a href="editproduct.php?id=<?php echo $row['id']; ?>" class="w-full px-2 py-1 text-white rounded bg-emerald-400">Edit</a>
                                    <a href="deleteproduct.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="w-full px-2 py-1 text-white bg-red-400 rounded">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
