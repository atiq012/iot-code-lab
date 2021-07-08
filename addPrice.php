<?php
	include 'auth.php'; 
    if(isset($update))
	{
		$update = $update;
	}
	else 
	{
		$update = false;	
	}
    if(isset($id))
	{
		$id = $id;
	}
	else
	{
		$id= 0;
	}
	if(isset($title))
	{
		
		$title = $title;
	}
	else
	{
		$title = '';
	}
    if(isset($active))
	{
		
		$active = $active;
	}
	else
	{
		$active = 0;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="stylesheet" href="style/w3.css">
	<style>
        .wrapper{ 
        	width: 500px; 
        	padding: 20px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>

    <?php   
        // Include config file
        // require_once "config/config.php"; 
        require_once "src/pricecontroller.php"; 
    ?>

    <main>
	<?php 
		include 'layouts/navbar.php';
	?>
    <div class="container mt-3">
		<?php 
			if(isset($_SESSION['file_upload'])){
		?>
			<div class="alert alert-success">
				<?php echo $_SESSION['file_upload'];?>
			</div>

		<?php		
			unset($_SESSION['file_upload']);
			}
		?>

        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Add Sizes With Price
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="src/pricecontroller.php" class="form-group" method="post">
							<input type="hidden" name='id' value=<?php echo $id?>>

                            <div class="form-group">
								<label for="title"> <?php if($update==false): ?> Add <?php else:?>Update <?php endif?>  Produce Price with Size</label>
								<input type="text" class="form-control" name="title" id="title" placeholder = "Ex: 12mm French Pattern Standard $41.80 m" value="<?php echo $title ?>">
							</div>
                            <div class="form-group">
								<input type="checkbox" name="active" <?php if($active == true): ?> checked <?php endif; ?>>
								<label for="active"> Active</label>
							</div>
                            
                            <div class="form-group">
								<?php 
										if($update==false):
								?>
									<button type="submit" class="btn btn-lg btn-success" 
									name='save'>
									Save
									</button>
								<?php else: ?>
									<button type="submit" class="btn btn-lg btn-success" 
									name='update'>
									Update
									</button>
								<?php endif; ?>
							</div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            All Size and Price list
                        </h3>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
								<table class="table table-sm table-border table-stripped">
									<tr>
										<th width="120">Action</th>
										<th>Title</th>
										<th>Category</th>
										
									</tr>
									<?php 
									$result = $mysql_db->query("SELECT * FROM price_size") or die($mysql_db->error);
							

									?>
									
									<?php 
										while($row = $result->fetch_assoc()):
									?>
									
									<tr>
										<td>
											<a href="addPrice.php?edit=<?php echo $row['id'];?>" class="btn btn-warning btn-sm">Edit</a>
										</td>
										<td><?php echo $row['title']; ?></td>
                                        <td>
                                        <?php if($row['active'] == 1): ?>Active 
                                        <?php else: ?> Inactive
                                        <?php endif ?>
                                        </td>
										
									</tr>
									<?php endwhile; ?>
								
								</table>
								<?php 

									function pre_r($array){
										echo '<pre>';
										print_r($array);
										echo '<pre>';
							
									}
									?>
							</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
