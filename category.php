<?php 
	include 'auth.php';
	
	if(isset($title))
	{
		$title = $title;
	}
	else
	{
		$title = '';
	}

	if(isset($description))
	{
		$description = $description;
	}
	else
	{
		$description = '';
	}
	if(isset($update))
	{
		$update = $update;
	}
	else 
	{
		$update = false;		
	}
	if(isset($category_id))
	{
		$category_id = $category_id;
	}
	else 
	{
		$category_id = 0;		
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
	require_once "src/controller.php"; 
?>
	<main>
	<?php include 'layouts/navbar.php';?>
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
				<div class="col-md-6">
					<div class="card">
						<div class="card-header card-primary">
							<h3> <i class="fa fa-plus"></i> <?php if($update ==false):?>
								Add New <?php else:?> Update <?php endif; ?> Category</h3>
						</div>
						<div class="card-body">
							<form action="src/controller.php" method="post" class="form-group" enctype="multipart/form-data">
							<input type="hidden" name = 'id' value=<?php echo $category_id?>>
								<div class="form-group">
									<label for="title"> Category Title</label>
									<input type="text" class="form-control" name="title" id="title" placeholder = "Enter Category Title" value="<?php echo $title; ?>">
								</div>
								<div class="form-group">
									<label for="description"> Category Description</label>
									<input type="text" class="form-control" name="description" id="description" placeholder = "Enter Category Description" value="<?php echo $description; ?>">
								</div>
								<div class="form-group">
									<label for="description">Image</label>
									<input type="file" class="form-control" style="padding-bottom:30px;" name="img" id="img">
								</div>

								<?php if($update): ?>
								<div class="form-group">
									<label for="">Preview Image</label>
									<br>
									<?php if($img): ?>
									<img height="80" width="80" src="upload/<?php echo $img?>">
									<?php endif;?>
								</div>
								<?php endif;?>
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
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h3>All Categories</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-sm table-border table-stripped">
									<tr>
										<th>Title</th>
										<th>Description</th>
										<th>Images</th>
										<th>Action</th>
									</tr>
									<?php 
									$result = $mysql_db->query("SELECT * FROM categoris") or die($mysql_db->error);
							

									?>
									
									<?php 
										while($row = $result->fetch_assoc()):
									?>
									
									<tr>
									
										<td><?php echo $row['title']; ?></td>
									
										<td><?php echo $row['description'] ?></td>
										<td><img src="upload/<?php echo $row['image']?>" alt="" width="50" height="50"></td>
										<td>
											<a href="category.php?edit=<?php echo $row['id'];?>" class="btn btn-warning btn-sm">Edit</a>
											<a name="delete" href="src/controller.php?delete=<?php echo $row['id'];?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you absolutely sure you want to delete?')">Delete</a>
										</td>
									</tr>
									<?php endwhile; ?>
								
								</table>
								<?php 
									// pre_r($result);
									// pre_r($result->fetch_assoc());
									// pre_r($result->fetch_assoc());

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