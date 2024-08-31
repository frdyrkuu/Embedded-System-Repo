<?php
include 'includes/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embedded System - Activities</title>
    <link rel="stylesheet" href="src/output.css">
</head>

<body class="bg-[#F5F5F5]">
    <!-- header -->
    <header>
        <nav class="bg-[#316FF6] border-blue-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="https://flowbite.com" class="flex items-center">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Embedded System</span>
                </a>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Company</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Marketplace</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white">Features</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Team</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Landing page -->

    <main class="max-w-7xl mx-auto px-10">
        <div class="mt-14">
            <h1 class="text-center text-4xl font-bold p-4">
                Embedded Systems
            </h1>
        </div>

        <!-- Activity 1 Temp and Humidity  -->
        <div>
            <h2 class="text-2xl py-2 font-[600]">Activity 1 - Temperature and Humidity</h2>
        </div>
        <div class="grid grid-cols-5 grid-rows-5 gap-4 h-[400px]">
            <div class="col-span-2 row-span-5 bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 justify-center grid">
                <!-- Card 1  -->
                <div class="flex mx-auto items-center justify-center">
                    <h2 class="font-[500] text-2xl">Temperature</h2>
                </div>
                <div>
                    <img src="assets/image/temperature-icon.png" alt="temperature-icon" class="h-[200px] w-[180px]">
                </div>
                <div class="flex mx-auto items-center justify-center">
                    <h2 class="font-[500] text-2xl">30.42 C</h2>
                </div>
            </div>
            <div class="col-span-2 row-span-5 col-start-3 bg-white rounded-[8px] border-gray-200 shadow-sm p-8 justify-center grid">
                <!-- Card 2  -->
                <div class="flex mx-auto items-center justify-center">
                    <h2 class="font-[500] text-2xl">Humidity</h2>
                </div>
                <div>
                    <img src="assets/image/humidity-icon.png" alt="temperature-icon" class="h-[200px] w-[190px]">
                </div>
                <div class="flex mx-auto items-center justify-center">
                    <h2 class="font-[500] text-2xl">30.42 C</h2>
                </div>
            </div>
            <div class="row-span-2 col-start-5 bg-white rounded-[8px] border-gray-200 shadow-sm p-4">
                <!-- Card 3  -->
                <div class="mx-auto items-center justify-center text-center">
                    <h2 class="font-[500] text-2xl">Temperature Status</h2>
                    <h3 class="text-red-500 text-4xl font-[500]">Hot</h3>
                </div>
            </div>
            <div class="row-span-3 col-start-5 row-start-3 bg-white rounded-[8px] border-gray-200 shadow-sm p-4 flex items-center justify-center">
                <!-- Card 4  -->
                <div class="mx-auto items-center justify-center text-center">
                    <h2 class="font-[500] text-2xl">Humidity Status</h2>
                    <h3 class="text-green-500 text-4xl font-[500]">Good</h3>
                </div>
            </div>
        </div>
        <!-- end activity 1 -->


    </main>


</body>

</html>