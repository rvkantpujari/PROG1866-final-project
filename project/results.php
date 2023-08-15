<?php
    session_start();

    $keyword = '';
    $books = array();

    if (isset($_GET['keyword'])) {
      $keyword = htmlspecialchars($_GET['keyword']);
      $books = $db->table("books")->select()->where(['book_title'], [$keyword], ['IN'], 's');
    } else {
      echo "No keyword found";
      return;
    }

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Results - ReadWise</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="h-screen">
        <!-- Header/Navbar -->
        <section class="h-[10vh]"><?php require ('layout/header.php'); ?></section>
        <!-- Main Section -->
        <section class="text-gray-600 body-font">
          <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
              <?php foreach ($books as $book): ?>
                <div class="xl:w-1/4 md:w-1/2 p-4">
                  <div class="bg-gray-100 p-6 rounded-lg">
                    <img class="h-40 rounded w-full object-fit object-center mb-6" src="https://upload.wikimedia.org/wikipedia/commons/9/92/Open_book_nae_02.svg" alt="content">
                    <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font"><?php echo htmlspecialchars($book['book_author']); ?></h3>
                    <h2 class="text-lg text-gray-900 font-medium title-font mb-4"><?php echo htmlspecialchars($book['book_title']); ?></h2>
                    <p>Edition: <?php echo htmlspecialchars($book['book_edition']); ?></p>
                    <p class="leading-relaxed text-base"><?php echo htmlspecialchars($book['book_desc']); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
        <!-- Footer -->
        <section class="h-[10vh]"><?php require ('layout/footer.php'); ?></section>
    </body>
</html>