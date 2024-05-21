<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}
if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("Location: signin.php");
  exit();
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
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Manage Mart</title>
  </head>
  <body>
    <div class="flex max-h-screen overflow-auto bg-gray-100">
      <div class="relative w-1/5 h-screen shadow-md">
        <aside
          class="fixed flex flex-col items-center justify-between w-1/5 h-screen text-black bg-emerald-100"
        >
          <div class="flex flex-col items-center w-full h-full bg-emerald-400">
            <p class="py-4 text-xl font-semibold text-center">Manage Mart</p>
            <div class="flex flex-col items-center gap-2 pb-[1.7px]">
              <span class="object-cover rounded-full aspect-square"
                ><img
                  src="./public/images/logo.png"
                  alt="Prrfile"
                  class="w-32 h-32 rounded-full"
              /></span>
              <p class="text-lg">Muhammad Ardiansyah Firdaus</p>
            </div>
            <ul class="flex flex-col w-full gap-2 px-4 pt-4 mt-4 bg-white">
              <li class="rounded-md bg-emerald-400">
                <a
                  href="dashboard.php"
                  class="flex items-center w-full gap-4 px-2 py-1 rounded-md"
                >
                  <i class="text-2xl cursor-pointer bx bxs-dashboard"></i>
                  <p>Dashboard</p></a
                >
              </li>
              <li class="rounded-md">
                <a
                  href="products.php"
                  class="flex items-center w-full gap-4 px-2 py-1 rounded-md"
                >
                  <i class="text-2xl bx bx-box"></i>
                  <p>Products</p></a
                >
              </li>
              <li class="rounded-md">
                <a
                  href="settings.php"
                  class="flex items-center w-full gap-4 px-2 py-1 rounded-md"
                >
                  <i class="text-2xl bx bx-cog"></i>
                  <p>Settings</p></a
                >
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
      </div>
      <main class="flex flex-col w-4/5 gap-[6.5px] bg-gray-100">
        <div
          class="grid w-full grid-cols-4 gap-4 p-4 bg-emerald-200 min-h-[33.4%] max-h-[33.4%]"
          style="height: 33.4%"
        >
          <div class="h-full bg-white shadow rounded-xl">
            <div class="relative flex flex-col justify-end h-full pb-6">
              <img
                src="./public/images/1.png"
                alt="Products 1"
                class="absolute w-32 p-0 -left-2 top-5 drop-shadow-lg rtl"
              />
              <i
                class="absolute text-2xl right-2 top-2 bx bx-dots-vertical-rounded"
              ></i>
              <div>
                <p class="px-4 text-lg font-bold">Laptop</p>
                <div class="flex justify-between">
                  <p class="px-4 text-sm opacity-60">120 Products</p>
                  <p class="px-4 text-sm opacity-60">12 Terjual</p>
                </div>
              </div>
            </div>
          </div>
          <div class="h-full bg-white shadow rounded-xl">
            <div class="relative flex flex-col justify-end h-full pb-6">
              <img
                src="./public/images/2.png"
                alt="Products 1"
                class="absolute w-32 p-0 -left-2 top-5 drop-shadow-lg rtl"
              />
              <i
                class="absolute text-2xl right-2 top-2 bx bx-dots-vertical-rounded"
              ></i>
              <div>
                <p class="px-4 text-lg font-bold">Mouse</p>
                <div class="flex justify-between">
                  <p class="px-4 text-sm opacity-60">120 Products</p>
                  <p class="px-4 text-sm opacity-60">12 Terjual</p>
                </div>
              </div>
            </div>
          </div>
          <div class="h-full bg-white shadow rounded-xl">
            <div class="relative flex flex-col justify-end h-full pb-6">
              <img
                src="./public/images/3.png"
                alt="Products 1"
                class="absolute w-32 p-0 -left-2 top-5 drop-shadow-lg rtl"
              />
              <i
                class="absolute text-2xl right-2 top-2 bx bx-dots-vertical-rounded"
              ></i>
              <div>
                <p class="px-4 text-lg font-bold">Keyboard</p>
                <div class="flex justify-between">
                  <p class="px-4 text-sm opacity-60">120 Products</p>
                  <p class="px-4 text-sm opacity-60">12 Terjual</p>
                </div>
              </div>
            </div>
          </div>
          <div class="h-full bg-white shadow rounded-xl">
            <div class="relative flex flex-col justify-end h-full pb-6">
              <img
                src="./public/images/4.png"
                alt="Products 1"
                class="absolute w-32 p-0 -left-2 top-5 drop-shadow-lg rtl"
              />
              <i
                class="absolute text-2xl right-2 top-2 bx bx-dots-vertical-rounded"
              ></i>
              <div>
                <p class="px-4 text-lg font-bold">Headshet</p>
                <div class="flex justify-between">
                  <p class="px-4 text-sm opacity-60">120 Products</p>
                  <p class="px-4 text-sm opacity-60">12 Terjual</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="max-h-[66.6%]">
          <div
            class="grid w-full grid-cols-2 gap-4 px-4 pt-2 pb-4"
          >
            <div class="box-border grid grid-rows-2 gap-4 h-fit">
              <div class="box-border p-2 bg-white shadow rounded-xl">
                <div>
                  <canvas id="myChart"></canvas>
                </div>
              </div>
              <div class="p-2 bg-white shadow rounded-xl">
                <p class="text-lg font-semibold">Log Sales</p>
                <table class="w-full mt-2 text-center border-2">
                  <thead class="w-full">
                    <tr>
                      <td class="p-2 text-sm border-2">No</td>
                      <td class="text-sm border-2 p-2whitespace-nowrap">Nama Produk</td>
                      <td class="p-2 text-sm border-2">Harga</td> 
                      <td class="p-2 text-sm border-2">Qty</td>
                      <td class="p-2 text-sm border-2">Total</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-sm">1</td>
                      <td class="text-sm">Laptop Think Pad V1</td>
                      <td class="text-sm"><?php echo convertIDR(1000000) ?></td>
                      <td class="text-sm">1</td>
                      <td class="text-sm"><?php echo convertIDR(1000000) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="p-2 bg-white shadow rounded-xl">
              <div>
                <canvas id="myChart2"></canvas>
              </div>
          </div>
        </div>
      </div>
      </main>
    </div>

    <script>
      const ctx = document.getElementById("myChart");
      const ctx2 = document.getElementById("myChart2");

      new Chart(ctx, {
        type: "line",
        data: {
          labels: [
            "Mouse",
            "Laptop",
            "Keyboard",
            "Headshet",
            "Handphone",
            "Monitor",
          ],
          datasets: [
            {
              label: "Statistic Sales",
              data: [12, 19, 3, 5, 2, 3],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });

      new Chart(ctx2, {
        type: "doughnut",
        data: {
          labels: [
            "Mouse",
            "Laptop",
            "Keyboard",
            "Headshet",
            "Handphone",
            "Monitor",
          ],
          datasets: [
            {
              label: "Statistic Sales",
              data: [12, 19, 3, 5, 2, 3],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    </script>
  </body>
</html>
