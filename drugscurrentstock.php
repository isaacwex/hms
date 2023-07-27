<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>
	
	<link rel="stylesheet" href="assets/css/datatables.min.css">

   <title>Drugs prices - <?php echo $smart_name; ?></title>
	
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }
 
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
 
        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style>
</head>
<body>
    <div id="wrapper">
	<?php include('includes/sidebar.php');?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<?php
		$current_processstage='REGISTRY';
		$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_drugs");
		$title='Newly Added Stock';
		?>
		
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>Drugs</h2>
				<ol class="breadcrumb">
					<li>
						<a href="drugs.php">Drugs</a>
					</li>                        
					<li class="active">
						<strong>Manage Drugs</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				<span><a href="add-inventory.php"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> New Stock</span></button></a></span> &nbsp;
				<span><a href="manage-prices.php"><button class="btn btn-success" type="button"><i class="fa fa-money"></i>&nbsp;&nbsp;<span class="bold"> Drug Prices</span></button></a></span> &nbsp;
				<span><a href="add-drugs.php"><button class="btn btn-primary" type="button"><i class="fa fa-save"></i>&nbsp;&nbsp;<span class="bold"> Add drug</span></button></a></span>
				</p>
				</div>
		</div>
		
        <div class="wrapper wrapper-content">
		<form method="POST">
	
			
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
							$searchtermv = $dbconnect->real_escape_string($_POST['searchterm']);
								
										
					//$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE f_name like '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR id_no LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR residence LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%' BY reg_no DESC");
					
					//$searchtermv='28196441';
					$getdrugs = mysqli_query($dbconnect, "SELECT * FROM tbl_inventory WHERE inve_drugcode LIKE '%$searchtermv%' OR inve_batchno LIKE '%$searchtermv%' OR inve_invoiceno LIKE '%$searchtermv%' OR inve_purchaseprice LIKE '%$searchtermv%' OR inve_expirydate LIKE '%$searchtermv%'");
					
					$title='Search Results from the Inventory';
					}
					?>
					</div>						
					</div>
					</form>
				<div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $title;?></h5><i>(Use search functionality above to find more to the list)</i>
                    </div>
                    <div class="ibox-content">
					<table id="example" class="table table-striped table-bordered">
						<thead>
						<tr>
                           <th>#</th>
							<th>Code</th>
							<th>Name</th>
							<th>Current Stock</th>
							<th>Purchace price</th>
							 <?php 
                             $getschme=mysqli_query($dbconnect,"SELECT * FROM `tbl_paymentschemes`");
                            while($gcsch = mysqli_fetch_array($getschme)){
                             $schname = $gcsch['pscheme_name'];?>
                             <th><?php echo $schname;?></th>
                            <?php }?>
							
							
						</tr>
						</thead>
						<tbody>
						
						<?php 
                        $getsitems = mysqli_query($dbconnect, "SELECT * FROM tbl_drugs");
						if ($getsitems->num_rows > 0) {
                            $No=1;
                        while($gcn = mysqli_fetch_array($getsitems)){
                            $drugitem_code = $gcn['drugitem_code'];
                            $brand_name = $gcn['brand_name'];
                            $sql4 = "SELECT SUM(inve_qty) as inve_qty FROM `tbl_inventory` WHERE inve_drugcode='$drugitem_code' AND inve_qty>0";
                            $result4 = mysqli_query($dbconnect, $sql4);
                            $row = mysqli_fetch_assoc($result4);
                            $inve_qty= $row["inve_qty"];

                            ?>
						
						<?php "<tr class='gradeX'/>"; ?>
							<td><?php echo $No;?><?php  $No=$No+1;?></td>
							<td><?php echo $drugitem_code; ?></td>
                            <td><?php echo $brand_name; ?></td>
							<td><span class="badge badge-primary"><?php if($inve_qty==Null){echo "0";}else{echo $inve_qty;} ?></span></td>
                            <?php 
							
							
                             $getsbuyprice=mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` WHERE `inve_drugcode`='$drugitem_code'");
                             $getsbuypric = mysqli_fetch_array($getsbuyprice);
                             $inve_purchaseprice = $getsbuypric['inve_purchaseprice'];?>

							<td><?php echo $inve_purchaseprice; ?></td>
                             <?php 
							 
							 $getschme1=mysqli_query($dbconnect,"SELECT * FROM `tbl_paymentschemes`");
                            while($gcsch1 = mysqli_fetch_array($getschme1)){
							$drug_codeinloop=$drugitem_code;
							$schcode = $gcsch1['pscheme_code'];
                             $getsprice=mysqli_query($dbconnect,"SELECT * FROM `tbl_drug_prices` WHERE `drug_code`='$drug_codeinloop' AND `scheme`='$schcode'");
                            $gcprice = mysqli_fetch_array($getsprice);
                             $price = $gcprice['price'];?>
                             <td><?php echo $price;?></td>
                            <?php }?>							
						</tr>
                        <?php }} ?>
						
						</tbody>
						
						</table>
				
                   
						
                </div>
            </div>
            </div>
        </div>
		</form>
		<?php include 'includes/footer.php'?>
    </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
     
   <!-- <script src="assets/js/bootstrap.bundle.min.js"></script>
    --<script src="assets/js/jquery-3.6.0.min.js"></script>-->
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/custom.js"></script>
	
</body>
</html>