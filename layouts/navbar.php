<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-2">
                
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="welcome.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="category.php">Add Category</a>
                </li>
                
                <li class="nav-item ">
                    <a class="nav-link" href="addProduct.php">Add Product</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="addPrice.php">Add Size & Price</a>
                </li>
                
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown w3-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="password_reset.php">Reset Password</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</div>