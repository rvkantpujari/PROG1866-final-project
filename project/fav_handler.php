<?php
    include('config/DB_config.php');

    // Start Session
    session_start();

    // Redirect if user not logged in
    if(!isset($_SESSION['loggedIn']) || $_SESSION['user'] !== 'Admin') {
        echo "<script>window.location.href='index.php';</script>";
    }
    
    // Create DB Object
    $db = new DB;
    
    if(isset($_POST['book_isbn'])) 
    {
        $book_isbn = $_POST['book_isbn'];

        $res = $db->table('book_read')->where(['book_isbn', 'user_email'], [$book_isbn, $_SESSION['user_email']], ['=', 'LIKE'], 'is', ['AND']);
        
        if(count($res) == 1) {
            $res = $db->table('book_read')->delete()->where(['book_isbn', 'user_email'], [$book_isbn, $_SESSION['user_email']], ['=', 'LIKE'], 'is', ['AND']);
        }
        else {
            $res = $db->table('book_read')->insert(['book_isbn', 'user_email'], [$book_isbn, $_SESSION['user_email']], ['=', 'LIKE'], 'is');
        }
    }

    echo json_encode($res);
?>