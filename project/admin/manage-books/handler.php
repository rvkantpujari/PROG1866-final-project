<?php
    include('../../config/DB_config.php');

    // Start Session
    session_start();

    // Redirect if user not logged in
    if(!isset($_SESSION['loggedIn']) || $_SESSION['user'] !== 'Admin') {
        echo "<script>window.location.href='../../index.php';</script>";
    }
    
    // Create DB Object
    $db = new DB;
    
    if(isset($_POST['delete_book'])) {
        $book_isbn = $_POST['book_isbn'];
        $res = $db->table('books')->delete()->where(['book_isbn'], [$book_isbn], ['='], 'i');
    }

    echo json_encode($res);
?>