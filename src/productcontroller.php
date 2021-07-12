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
            $price = $_POST['price'];
            $maintain = $_POST['maintain'];
            $cat_ids = $_POST['category'];
            
            $salePrice = $_POST['sales_price'];
            $name = $_FILES['img']['name'];
            $target_dir = "../product/";
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
                                    
                    $sql = $mysql_db->query("INSERT INTO products (title,description,image,price,maintain,sale_price) VALUES('$title','$description','$name','$price','$maintain','$salePrice')") or die( $mysql_db->error);
                }

            }
            else
            {
                $sql = $mysql_db->query("INSERT INTO products (title,description,price,maintain,sale_price) VALUES('$title','$description','$price','$maintain','$salePrice')") or die( $mysql_db->error);
            }

            $last_id = $mysql_db->insert_id;
                     
            
            foreach($cat_ids as $cat)
            {
                $mysql_db->query("INSERT INTO product_category (product_id,category_id) VALUES('$last_id','$cat')") or die( $mysql_db->error);
            }

            

            $_SESSION['file_upload'] = "Successfully Added Category!";
            header('location: ../addProduct.php');      

        }

        if(isset($_GET['delete']))
        {
            $category_id = $_GET['delete'];
            
            $mysql_db->query("DELETE FROM products WHERE product_id = $category_id") or die( $mysql_db->error);

            $_SESSION['file_upload'] = "Successfully Delete Product!";
            header('location: ../addProduct.php');
        }

        if(isset($_GET['edit']))
        {
            $id = $_GET['edit'];
            
            $result = $mysql_db->query("SELECT * FROM products WHERE product_id = $id") or die( $mysql_db->error);        
            
            if(count(array($result)) == 1)
            {
                $row = $result->fetch_array();
                $title = $row['title'];
                $product_id = $row['product_id'];
                $description = $row['description'];
                $img = $row['image'];
                $price = $row['price'];
                $maintain = $row['maintain'];
                $salePrice = $row['sale_price'];
                $update = true;
            }
        }  

        if(isset($_POST['update']))
        {
            // echo "<pre>";
            // print_r($_FILES['imgs']);
            // echo "</pre>";
            // die;
            
            $id = $_POST['id'];
            
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $maintain = $_POST['maintain'];
            $cat_ids = $_POST['category'];
            $salePrice = $_POST['sales_price'];

            // $file = $_POST['img'];
            $name = $_FILES['img']['name'];
            $target_dir = "../product/";
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
                    // cat_id
                    $mysql_db->query("UPDATE products SET title ='$title',description ='$description',image = '$name',price = '$price',maintain = '$maintain', sale_price = '$salePrice' WHERE product_id = $id") or die ($mysql_db->error);
                }

            }
            else {
                $mysql_db->query("UPDATE products SET title ='$title', description ='$description', price = '$price', maintain = '$maintain', sale_price = '$salePrice' WHERE product_id = $id") or die ($mysql_db->error);
            }
                     
            $sql = $mysql_db->query("DELETE FROM product_category WHERE product_id = $id;");
            $sql1 = $mysql_db->query("DELETE FROM product_price_size WHERE product_id = $id;");
            
            foreach($cat_ids as $cat)
            {
                $mysql_db->query("INSERT INTO product_category (product_id,category_id) VALUES('$id','$cat')") or die( $mysql_db->error);
            }

           

            $otherImgs = $_FILES['imgs']['name'];
            
            foreach($otherImgs as $key => $oi)
            {                   
                
                $imgName = $_FILES['imgs']['name'][$key];
                // print_r($imgName);
                // die;
                $temp =$_FILES['imgs']['tmp_name'][$key];
                $target_direct = "../product/";
                $target_files = $target_direct.basename($imgName);
            
                // Select file type
                $imageFileType = strtolower(pathinfo($target_files,PATHINFO_EXTENSION));
                
                // Valid file extensions
                $extensions_arr = array("jpg","jpeg","png","gif");

                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){
                    
                    // Upload file
                    if(move_uploaded_file($temp,$target_direct.$imgName)){
                        // Insert record
                        
                        $sql = $mysql_db->query("INSERT INTO product_imgs (product_id,img) VALUES('$id','$imgName')") or die( $mysql_db->error);
                    }

                }
            }
            

            $_SESSION['file_upload'] = "Successfully Product Details Updated!";
            header('location: ../addProduct.php');
            

        }