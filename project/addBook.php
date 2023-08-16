<?php
    include('config/DB_config.php');
    
    session_start();

    $db = new DB;
    $authors = $db->table("authors")->selectAll();
    $publishers = $db->table("publishers")->selectAll();

    // Redirect if user logged in
    if(!isset($_SESSION['loggedIn'])) {
        echo "<script>window.location.href='index.php';</script>";
    }
    
    // If add book button is clicked
    if(isset($_POST['btnAddBook'])) 
    {
        function generateISBN() 
        {
          $prefix = '978'; // Common prefix for books
          // Generate 9 random digits
          $randomDigits = '';
          for ($i = 0; $i < 9; $i++) {
              $randomDigits .= mt_rand(0, 9);
          }
          // Calculate checksum digit using ISBN-13 formula
          $isbnDigits = $prefix . $randomDigits;
          $checksum = 0;
          for ($i = 0; $i < 12; $i++) {
              $checksum += ($i % 2 === 0) ? intval($isbnDigits[$i]) : 3 * intval($isbnDigits[$i]);
          }
          $checksum = (10 - ($checksum % 10)) % 10;
          // Combine all parts to form the ISBN
          $isbn = $isbnDigits . $checksum;
          return $isbn;
        }
        
        // Assign data from POST request
        $generatedISBN = generateISBN();
        $title = $_POST['title'];
        $description = $_POST['description'];
        $edition = $_POST['edition'];
        $year = $_POST['year'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];

        // Create instance of DB class
        $db = new DB;

        // Insert user data in order to create new book
        $result = $db->table('books')->insert(['book_isbn', 'book_title', 'book_desc', 'book_edition', 'book_published_year', 'book_author', 'book_publisher'], array($generatedISBN, $title, $description, $edition, $year, $author, $publisher), 'issssss');
        
        if($result) {
            echo "<script>window.location.href='dashboard.php';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Book - ReadWise</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="h-screen">
        <!-- Header/Navbar -->
        <section class="h-[10vh]"><?php require ('layout/header.php'); ?></section>
        <section class="container flex justify-center items-center">
            <div class="w-full max-w-md mx-2 md:mx-0 overflow-hidden bg-white rounded-lg shadow-md hover:shadow-lg">
                <div class="px-6 py-4">
                    <div class="flex justify-center mx-auto mt-8">
                        <a href="index.php" class="flex title-font font-medium items-center text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <span class="ml-3 text-2xl hover:underline">Read<span class="text-blue-600">Wise</span></span>
                        </a>
                    </div>

                    <p class="mt-1 text-xl text-center text-gray-500">Add Book</p>

                    <form method="post" class="my-8 grid grid-cols-12 gap-x-2">
                        <div class="col-span-full mt-1">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">Title</label>
                            <input class="block w-full px-4 py-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="title" placeholder="Book Title" required />
                        </div>

                        <div class="col-span-full mt-3">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">Description</label>
                          <textarea required id="description" rows="4" class="block p-2.5 w-full text-gray-700 placeholder-gray-500 bg-white rounded-lg border border focus:border-blue-400 focus:ring-blue-400 focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" name="description" placeholder="Write your description here..."></textarea>
                        </div>

                        <div class="col-span-full md:col-span-6 mt-3">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">Edition</label>
                          <input required class="block w-full px-4 py-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="edition" placeholder="Book edition" />
                        </div>
                        
                        <div class="col-span-full md:col-span-6 mt-3">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">Year</label>
                          <input required class="block w-full px-4 py-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="number" name="year" placeholder="Published year" />
                        </div>

                        <div class="col-span-full mt-3">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">Author</label>
                          <div class="relative">
                            <select class="block w-full px-4 py-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" id="author" name="author">
                              <?php foreach ($authors as $row) { ?>
                                <option value="<?php echo htmlspecialchars($row['author_email']); ?>">
                                    <?php echo htmlspecialchars($row['author_fname']) . ' ' . htmlspecialchars($row['author_lname']); ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-span-full mt-3">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">Publishers</label>
                          <div class="relative">
                            <select class="block w-full px-4 py-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" id="publisher" name="publisher">
                              <?php foreach ($publishers as $row) { ?>
                                <option value="<?php echo htmlspecialchars($row['publisher_email']); ?>">
                                    <?php echo htmlspecialchars($row['publisher_name']); ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-span-full flex items-center justify-end mt-6">
                            <button name="btnAddBook" class="px-6 w-full py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                Add Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <section class="h-[10vh]"><?php require ('layout/footer.php'); ?></section>
    </body>
</html>