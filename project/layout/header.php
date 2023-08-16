<header class="text-gray-600 body-font px-8">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href="/prog1866-final-project/project/index.php" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="ml-3 text-3xl">Read<span class="text-blue-600">Wise</span></span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            <?php if(isset($_SESSION['loggedIn'])) { ?>
                <a href="/prog1866-final-project/project/dashboard.php" class="mr-5 hover:text-gray-900 hover:font-semibold">Dashboard</a>
                <form method="post">
                    <button name="btnSignOut" class="mr-5 hover:text-gray-900 hover:font-semibold">Sign Out</button>
                </form>
            <?php } else { ?>
                <a href="/prog1866-final-project/project/signin.php" class="mr-5 hover:text-gray-900 hover:font-semibold">Sign In</a>
                <a href="/prog1866-final-project/project/signup.php" class="mr-5 hover:text-gray-900 hover:font-semibold">Sign Up</a>
            <?php } ?>
        </nav>
    </div>
</header>

<?php
    if(isset($_POST['btnSignOut'])) {
        session_destroy();
        echo "<script>window.location.href='/prog1866-final-project/project/index.php';</script>";
    }
?>