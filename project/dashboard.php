<?php
    include('config/DB_config.php');

    // Start Session
    session_start();

    // Redirect if user not logged in
    if(!isset($_SESSION['loggedIn'])) {
        echo "<script>window.location.href='index.php';</script>";
    }

    $db = new DB;
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo strtoupper($_SESSION['user']); ?> - Manage Books | Transcript</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body class="h-screen bg-white">
        <!-- Header/Navbar -->
        <section class="h-[10vh]"><?php require ('layout/header.php'); ?></section>
        <!-- Main Section -->
        <?php if($_SESSION['user'] == 'admin') { ?>
            <section class="h-[80vh] w-full space-4 px-6 py-8 md:px-16 lg:px-28">
                <div class="my-12 md:mt-0 md:mb-16 lg:mt-8 flex justify-center md:justify-start">
                    <a href="admin/manage-books/addBook.php" class="px-4 py-2 text-white bg-indigo-500 rounded-md hover:scale-105">Add Book</a>
                </div>
                <table id="tbl-books" class="w-full display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $books = $db->table('books')->selectAll();
                            $books = $db->table('books')->join('authors', 'authors.author_email', 'books.book_author')->selectAll();

                            foreach($books as $book) {
                                echo   "<tr>
                                            <td>".$book['book_isbn']."</td>
                                            <td>".$book['book_title']."</td>
                                            <td>".$book['author_fname'].' '.$book['author_lname']."</td>
                                            <td>".mb_strimwidth(htmlspecialchars($book['book_desc']), 0, 50, '...')."</td>
                                            <td>
                                                <form method='POST' action='admin/manage-books/editBook.php' class='flex'>
                                                    <input type='hidden' name='book_isbn' value='".$book['book_isbn']."'>
                                                    <input type='submit' value='Edit' name='edit_book' id='".$book['book_isbn']."' class='px-4 py-2 text-sm md:text-md text-white bg-indigo-500 rounded-md hover:scale-105 cursor-pointer' />
                                                    <input type='submit' value='Delete' name='delete_book' id='del-".$book['book_isbn']."' class='del-btn ml-5 px-4 py-2 text-sm md:text-md text-white bg-red-500 rounded-md hover:scale-105 cursor-pointer' />
                                                </form>
                                            </td>
                                        </tr>";
                            } 
                        ?>
                    </tbody>
                </table>
            </section>
        <?php } else { 
            $books = $db->table('books')->join('book_read', 'book_read.book_isbn', 'books.book_isbn')->join('authors', 'authors.author_email', 'books.book_author')
                        ->where(['user_email'], [$_SESSION['user_email']], ['LIKE'], 's');
        ?>
            <section class="h-[80vh] w-full space-4 px-6 py-8 md:px-16 lg:px-28">
                <h1 class="text-3xl text-center mt-4 mb-12">Your Favourite Books 📚</h1>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 space-8">
                    <?php foreach ($books as $book): ?>
                        <!-- <div class="xl:w-1/4 md:w-1/2 p-4"> -->
                        <div class="col-span-full md:col-span-6 lg:col-span-3">
                        <div class="bg-gray-100 p-6 rounded-lg h-[25rem]">
                            <img class="h-40 rounded w-full object-fit object-center mb-6" src="https://upload.wikimedia.org/wikipedia/commons/9/92/Open_book_nae_02.svg" alt="content">
                            <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font"><?php echo htmlspecialchars($book['author_fname'] .' '. $book['author_lname']); ?></h3>
                            <h2 class="text-lg text-gray-900 font-medium title-font mb-4"><?php echo htmlspecialchars($book['book_title']); ?></h2>
                            <p>Edition: <?php echo htmlspecialchars($book['book_edition']); ?></p>
                            <p class="leading-relaxed text-base"><?php echo mb_strimwidth($book['book_desc'], 0, 100, '...'); ?></p>
                        </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php } ?>
        <!-- Footer -->
        <section class="h-[10vh]"><?php require ('layout/footer.php'); ?></section>
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(()=> {
                let delBtns = document.querySelectorAll('.del-btn');
                delBtns.forEach(btn => {
                    btn.addEventListener('click', deleteModal);
                });

                function deleteModal(event) 
                {
                    event.preventDefault();

                    swal({
                        title: 'Are you sure? 😥',
                        text: "You won't be able to revert this action!",
                        icon: 'warning',
                        buttons: {
                            cancel: true,
                            confirm: {
                                text: "Yes, delete it!",
                                value: true,
                                className: "bg-red-500 hover:bg-red-700",
                            },
                        }
                    })
                    .then((willDelete) => {
                        if (willDelete) 
                        {
                            let formData = { 
                                delete_book : true,
                                book_isbn : (event.target.id).substring(4) 
                            };

                            $.ajax({
                                type: "POST",
                                url: "admin/manage-books/handler.php",
                                data: formData,
                                dataType: "json",
                                encode: true,
                            }).done(function(data) {
                                if(data) {
                                    window.location.href='dashboard.php';
                                }
                            });
                        }
                    });
                }

                let table = $('#tbl-books').DataTable({
                    dom: '<"my-4 py-0"lf><"mt-4 py-4"rt><"mb-4 py-4"Bp>',
                    buttons: [
                        'colvis',
                        {
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                    ],
                    "lengthMenu": [ 5, 10, 15 ],
                    "language": {
                        "emptyTable": "Sorry!! There are no books available yet. Please check again later. 😐"
                    },
                    responsive: true,
                    "scrollX": true
                });
            });
        </script>
    </body>
</html>