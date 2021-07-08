<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'login_system');
    // Attempt to connect to MySQL database
    $mysql_db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$mysql_db) {
        die("Error: Unable to connect " . $mysql_db->connect_error);
    }


    if(isset($_POST['save']))
    {
        
        $title = $_POST['title'];
        $active = $_POST['active'];
        if($active == 'on')
        {
            $active = 1;
        }
        else
        {
            $active = 0;
        }
        
        $mysql_db->query("INSERT INTO price_size (title,active) VALUES('$title','$active')") or die( $mysql_db->error);

        $_SESSION['file_upload'] = "Successfully Added Size!";
        header('location: ../addPrice.php');      

    }

    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        
        $result = $mysql_db->query("SELECT * FROM price_size WHERE id = $id") or die( $mysql_db->error);        
        
        if(count(array($result)) == 1)
        {
            $row = $result->fetch_array();
            $title = $row['title'];
            $active = $row['active'];
            $update = true;
        }
    } 

    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        
        $title = $_POST['title'];
        $active = $_POST['active'];
        if($active == 'on')
        {
            $active = 1;
        }
        else
        {
            $active = 0;
        }
        
        $mysql_db->query("UPDATE price_size SET title ='$title', active ='$active' WHERE id = $id") or die ($mysql_db->error);

        $_SESSION['file_upload'] = "Successfully Product Details Updated!";
        header('location: ../addPrice.php');
        

    }