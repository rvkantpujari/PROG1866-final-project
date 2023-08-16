<?php
    include('config/DB_config.php');

    session_start();

    $db = new DB;
    
    $books = $db->table("books")->join('authors', 'books.book_author' ,'authors.author_email')->selectAll();
    
    $liked_books = [];
    if(isset($_SESSION['user_email']))
        $liked_books = $db->table('book_read')->where(['user_email'], [$_SESSION['user_email']], ['LIKE'], 's');

    $fav_books = [];
    foreach($liked_books as $book) {
        array_push($fav_books, $book['book_isbn']);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home - ReadWise</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body class="h-screen">
        <!-- Header/Navbar -->
        <section><?php require ('layout/header.php'); ?></section>
        <!-- Main Section -->
        <section class="w-full space-4 px-8 py-12 bg-white">
            <form method="get" action="results.php" class="flex items-center h-full justify-center px-4 md:px-12">
                <div class="relative w-full md:w-3/4 lg:w-1/2">
                    <input name="keyword" id="keyword" type="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Books" required>
                    <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </form>
        </section>
        <section class="flex flex-col mx-8 px-8">
            <h1 class="text-3xl text-center mt-4 mb-12">All Books 📚</h1>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 space-8">
              <?php foreach ($books as $book): ?>
                <!-- <div class="xl:w-1/4 md:w-1/2 p-4"> -->
                <div class="col-span-full md:col-span-6 lg:col-span-3">
                  <div class="bg-gray-100 p-6 rounded-lg h-[26rem]">
                    <form>
                        <input type="hidden" name="book_isbn" value=<?php echo $book['book_isbn']; ?>>
                        <?php if(in_array($book['book_isbn'], $fav_books)) {?>
                            <div class="mt-2 flex justify-end cursor-pointer hover:font-semibold">
                                <button class="fav-btn flex" id=<?php echo $book['book_isbn']; ?>>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-600">
                                        <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                    </svg>&nbsp;Liked
                                </button>
                            </div>
                        <?php } else { ?>
                            <div class="mt-2 flex justify-end cursor-pointer hover:font-semibold">
                                <button class="fav-btn flex" id=<?php echo $book['book_isbn']; ?>>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>&nbsp;Like
                                </button>
                            </div>
                        <?php } ?>
                    </form>
                    <img class="h-40 rounded w-full object-fit object-center mb-6" src="https://upload.wikimedia.org/wikipedia/commons/9/92/Open_book_nae_02.svg" alt="content">
                    <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font"><?php echo htmlspecialchars($book['author_fname'] .' '. $book['author_lname']); ?></h3>
                    <h2 class="text-lg text-gray-900 font-medium title-font mb-4"><?php echo htmlspecialchars($book['book_title']); ?></h2>
                    <p>Edition: <?php echo htmlspecialchars($book['book_edition']); ?></p>
                    <p class="leading-relaxed text-base"><?php echo mb_strimwidth(htmlspecialchars($book['book_desc']), 0, 60, '...'); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
        </section>
        <!-- Footer -->
        <section class="my-8"><?php require ('layout/footer.php'); ?></section>
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(()=> {
                let favBtns = document.querySelectorAll('.fav-btn');
                favBtns.forEach(btn => {
                    btn.addEventListener('click', bookmark);
                });

                function bookmark(event)
                {
                    console.log(event.target.id);
                    event.preventDefault();
                    
                    let formData = { 
                        book_isbn : (event.target.id)
                    };

                    $.ajax({
                        type: "POST",
                        url: "fav_handler.php",
                        data: formData,
                        dataType: "json",
                        encode: true,
                    }).done(function(data) {
                        if(data) {
                            window.location.href='index.php';
                        }
                    });
                }
            });
        </script>
    </body>
</html>