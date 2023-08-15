<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up - ReadWise</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <section class="container h-screen flex justify-center items-center">
            <div class="w-full max-w-sm mx-2 md:mx-0 overflow-hidden bg-white rounded-lg shadow-md hover:shadow-lg">
                <div class="px-6 py-4">
                    <div class="flex justify-center mx-auto mt-8">
                        <a href="index.php" class="flex title-font font-medium items-center text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <span class="ml-3 text-2xl hover:underline">Read<span class="text-blue-600">Wise</span></span>
                        </a>
                    </div>

                    <p class="mt-1 text-xl text-center text-gray-500">User - Sign Up</p>

                    <form method="post" class="my-8 grid grid-cols-12 gap-x-2">
                        <div class="col-span-full md:col-span-6">
                            <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" placeholder="First Name" />
                        </div>
                        
                        <div class="col-span-full md:col-span-6">
                            <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" placeholder="Last Name" />
                        </div>

                        <div class="col-span-full mt-1">
                            <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="email" placeholder="Email Address" />
                        </div>

                        <div class="col-span-full mt-1">
                            <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" placeholder="Password" />
                        </div>

                        <div class="col-span-full flex items-center justify-end mt-6">
                            <button class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                Sign Up
                            </button>
                        </div>
                    </form>
                </div>

                <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
                    <span class="text-sm text-gray-600 dark:text-gray-200">Already have an account? </span>

                    <a href="signin.php" class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">Sign In</a>
                </div>
            </div>
        </section>
    </body>
</html>