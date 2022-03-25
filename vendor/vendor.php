<?php 
  require 'include/header.php';
  ?>
  


  <body data-col="2-columns" class=" 2-columns ">
      <div class="layer"></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


     
      <?php include('main.php'); ?>
      <!-- Navbar (Header) Ends-->

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->

<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Add Vendor</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								<div class="form-group">
									<label for="cname">Shop Owner Name</label>
									<input type="text" id="shop_owner_name" class="form-control" placeholder="Enter Shop Owner  Name"  name="shop_owner_name" required >
								</div>

								<div class="form-group">
									<label for="cname">Shop Name</label>
									<input type="text" id="shop_name" class="form-control" placeholder="Enter Shop Name"  name="shop_name" required >
								</div>
								
								<div class="form-group">
									<label for="cname">Mobile Number(Only Digit)</label>
									<input type="text" id="mobile"   class="form-control" pattern="[0-9]+"  placeholder="Enter  Mobile Number" name="mobile" required >
								</div>
								
									<div class="form-group">
									<label for="cname">Email Address</label>
									<input type="email"   class="form-control"   placeholder="Enter Email Address" name="email" required >
								</div>
								
								<div class="form-group">
									<label for="cname">Password</label>
									<input type="text"   class="form-control"   placeholder="Enter Password" name="password" required >
								</div>							
								
									<div class="form-group">
									<label for="cname">Address</label>
								<textarea style="resize: none;" class="form-control" name="shop_address"></textarea>
								</div>

								<div class="form-group">
									<label for="cname">Shop Category</label>
									<input type="text" id="shop_category" class="form-control" placeholder="Enter Shop Category"  name="shop_category" required >
								</div>
								
									<div class="form-group">
									<label for="cname">Status</label>
									<select name="status" class="form-control">
									    <option value="1">Active</option>
									    <option value="0">Deactive</option>
									</select>
								</div>


							

								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="ft-shopping-cart"></i> Save  Vendor
								</button>
							</div>
							
							<?php 
							if(isset($_POST['sub_cat'])){
							$cname = mysqli_real_escape_string($con,$_POST['cname']);
							$status = $_POST['status'];
							$mobile = $_POST['mobile'];
							$password = $_POST['password'];
							$email = $_POST['email'];
							$raddress = $_POST['shop_address'];
							$area_id = $_POST['area_id'];
						$check_email = $con->query("select * from vendor where email='".$email."'")->num_rows;
						$check_mobile = $con->query("select * from vendor where mobile='".$mobile."'")->num_rows;
						if($check_email != 0)
						{
							?>
							<script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Email Address Already Used.');

   setTimeout(function()
	{
		window.location.href="vendor.php";
	},1500);
	
  });
  </script>
							<?php 
						}
						else if($check_mobile != 0)
						{
							?>
						<script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.error('Mobile Number Already Used.');

   setTimeout(function()
	{
		window.location.href="vendor.php";
	},1500);
	
  });
  </script>	
							<?php 
						}
						else 
						{
$con->query("insert into vendor(`shop_owner_name`,`shop_name`,`mobile`,`email`,`aid`,`status`,`shop_address`,`shop_category`,`password`)values('".$shop_owner_name."','".$shop_name."','".$mobile."','".$email."',".$area_id.",".$status.",'".$shop_address."','".$shop_category."','".$password."')");
?>
						
							 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Insert Vendor Successfully!!!');

   setTimeout(function()
	{
		window.location.href="vendor.php";
	},1500);
	
  });
  </script>
  <?php 
							}
							}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>

		
	</div>
	


 


          </div>
        </div>

        

      </div>
    </div>
    
   <?php 
  require 'include/js.php';
  ?>
    

  </body>


</html>