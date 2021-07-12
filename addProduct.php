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

	if(isset($category_id))
	{
		$category_id = $category_id;
	}
	else
	{
		$category_id = '';
	}

	if(isset($description))
	{
		$description = $description;
	}
	else
	{
		$description = '';
	}
	if(isset($price))
	{
		$price = $price;
	}
	else {
		$price='';
	}
	
	if(isset($maintain))
	{
		$maintain = $maintain;
	}
	else
	{
		$maintain ='';
	}
	if(isset($salePrice))
	{
		$salePrice = $salePrice;
	}
	else
	{
		$salePrice = '';
	}

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="stylesheet" href="style/w3.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
	require_once "src/productcontroller.php"; 
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
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"> <?php if($update==false): ?> Add <?php else: ?> Update <?php endif?> Product</h3>
					</div>
					<div class="card-body">
						<?php 
						$cate = $mysql_db->query("SELECT * FROM categoris") or die($mysql_db->error);
						?>

						<?php if($update):?>
							<?php if(isset($product_id)): ?>
							<?php $r = $mysql_db->query("SELECT * FROM product_category WHERE product_id = $product_id") or die( $mysql_db->error); ?>
							<?php $uh_array = []; ?>
							<?php foreach($r as $v): ?>
								<?php $uh_array[] = $v['category_id']; ?>
							<?php endforeach;?>
							<?php endif; ?>
						<?php endif;?>

							
											



						<form action="src/productcontroller.php" method="post" class="form-group" enctype="multipart/form-data">
							<input type="hidden" name='id' value=<?php echo $id?>>
							<div class="form-group">
								<label for="title"> Select Product Category</label>
								
								<select name="category[]" id="" class="form-control select2" multiple>
								

								<?php if($update):?>
									<?php 
										// while($row = $cate->fetch_assoc()):
											foreach($cate as $cat):
									?>
									
									<option value="<?php echo $cat['category_id'] ?>"
										<?php echo in_array($cat['category_id'],$uh_array) ? 'selected' : '' ?>
									>
									<?php echo $cat['title']?>
									</option>
									
									<?php 
									// endwhile; 
									endforeach;
									?>
								<?php else:?>
									<?php 
										// while($row = $cate->fetch_assoc()):
											foreach($cate as $cat):
									?>
									<option value="<?php echo $cat['category_id'] ?>">
									<?php echo $cat['title']?>
									</option>
									<?php endforeach; ?>
								<?php endif;?>
								</select>
							</div>

							

							<div class="form-group">
								<label for="title"> Product Title</label>
								<input type="text" class="form-control" name="title" id="title" placeholder = "Enter Product Title" require value="<?php  echo $title; ?>">
							</div>

							<div class="form-group">
								<label for="description"> Product Description</label>
								<textarea type="text" class="form-control" name="description" id="description" placeholder = "Enter Product Description"><?php echo $description; ?></textarea>
							</div>

							<div class="form-group">
								<label for="maintain"> Product Install/Maintainance</label>
								<textarea type="text" class="form-control" name="maintain" id="maintain" placeholder = "Product Install/Maintainance" ><?php echo $maintain;?></textarea>
							</div>

							<div class="form-group">
								<label for="price"> Product Price</label>
								<input type="text" class="form-control" name="price" id="price" placeholder = "Enter Product Price" value="<?php  echo $price;?>">
							</div>

							<div class="form-group">
								<label for="price"> Product Sale Price</label>
								<input type="text" class="form-control" name="sales_price" id="sales_price" placeholder = "Enter Product Sale Price" value="<?php  echo $salePrice;?>">
							</div>

							<div class="form-group">
								<label for="description">Featured Image</label>
								<input type="file" class="form-control" style="padding-bottom:30px;" name="img" id="img">
							</div>

							<?php if($update):?>
								<div class="form-group">
									<label for="description">Other Images</label>
									<input type="file" class="form-control" style="padding-bottom:30px;" name="imgs[]" multiple id="imgs">
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
		</div>
		<div class="row mt-2">
		<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="w3-center">All Categories</h3>
					</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-sm table-border table-stripped">
									<tr>
										<th width="120">Action</th>
										<th>Title</th>
										<!-- <th>Category</th> -->
										<th>Description</th>
										<th>Install/Maintanace</th>
										<th>Price</th>
										<th>Sale Price</th>
										<th>Images</th>
									</tr>
									<?php 
									$result = $mysql_db->query("SELECT * FROM products") or die($mysql_db->error);
							

									?>
									
									<?php 
										while($row = $result->fetch_assoc()):
									?>
									
									<tr>
										<td>
											<a href="addProduct.php?edit=<?php echo $row['product_id'];?>" class="btn btn-warning btn-sm">Edit</a>
											<a name="delete" href="src/productcontroller.php?delete=<?php echo $row['product_id'];?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you absolutely sure you want to delete?')">Delete</a>
										</td>
										<td><?php echo $row['title']; ?></td>
										
										<td><?php echo $row['description'] ?></td>
										<td><?php echo $row['maintain'] ?></td>
										<td><?php echo $row['price'] ?></td>
										<td><?php echo $row['sale_price'] ?></td>
										<td><img src="product/<?php echo $row['image']?>" alt="" width="50" height="50"></td>
										
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
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		$(".select2").select2({
			maximumSelectionLength: 10
		});
	</script>
</body>
</html>