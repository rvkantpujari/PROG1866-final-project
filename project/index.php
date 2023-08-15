<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home - ReadWise</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <?php
            require ('layout/header.php');
        ?>
    </head>
    <body>
        <section class="section w-full space-4 px-8 py-12 bg-white">
            <form class="flex items-center h-[55vh] md:h-[75vh] lg:h-[72vh] justify-center px-4 md:px-12">
                <div class="relative w-full md:w-3/4 lg:w-1/2">
                    <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Books" required>
                    <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </form>
        </section>
        <?php
            require ('layout/footer.php');
        ?>
    </body>
</html>