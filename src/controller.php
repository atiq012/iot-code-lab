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
        $description = $_POST['description'];

        // $file = $_POST['img'];
        $name = $_FILES['img']['name'];
        $target_dir = "../upload/";
        $target_file = $target_dir.basename($name);
        
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            // Upload file
            if(move_uploaded_file($_FILES['img']['tmp_name'],$target_dir.$name)){
                // Insert record
                                
                $mysql_db->query("INSERT INTO categoris (title,description,image) VALUES('$title','$description','$name')") or die( $mysql_db->error);
            }

        }
        $_SESSION['file_upload'] = "Successfully Added Category!";
        header('location: ../category.php');
        

    }

    if(isset($_GET['delete']))
    {
        $category_id = $_GET['delete'];
        
        $mysql_db->query("DELETE FROM categoris WHERE category_id = $category_id") or die( $mysql_db->error);
        $_SESSION['file_upload'] = "Successfully Delete Category!";
        header('location: ../category.php');
    }

    if(isset($_GET['edit']))
    {

        $category_id = $_GET['edit'];
        
        $result = $mysql_db->query("SELECT * FROM categoris WHERE category_id = $category_id") or die( $mysql_db->error);        
        
        if(count(array($result)) == 1)
        {
            $row = $result->fetch_array();
            $title = $row['title'];
            $description = $row['description'];
            $img = $row['image'];
            $update = true;
        }
    }

    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        
        $title = $_POST['title'];
        $description = $_POST['description'];

        // $file = $_POST['img'];
        $name = $_FILES['img']['name'];
        $target_dir = "../upload/";
        $target_file = $target_dir.basename($name);
        
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            // Upload file
            if(move_uploaded_file($_FILES['img']['tmp_name'],$target_dir.$name)){
                // Insert record
                                
                // $mysql_db->query("INSERT INTO categoris (title,description,image) VALUES('$title','$description','$name')") or die( $mysql_db->error);
                $mysql_db->query("UPDATE categoris SET title ='$title', description ='$description',image = '$name' WHERE category_id = $id") or die ($mysql_db->error);
            }

        }
        else {
            $mysql_db->query("UPDATE categoris SET title ='$title', description ='$description' WHERE category_id = $id") or die ($mysql_db->error);
        }
        $_SESSION['file_upload'] = "Successfully Added Category!";
        header('location: ../category.php');
        

    }
    
?>