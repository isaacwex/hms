<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
   <title>Served Patients - <?php echo $smart_name; ?></title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
		
		<script>
			function myscheme() {
			document.getElementById("data1").innerHTML="";	
			var c=document.getElementById("cat").value;	
			var start=document.getElementById("start").value;	
			var end=document.getElementById("end").value;
			if(c=="otc"){
				window.location.replace("summary.php?table=tbl_sales&start="+start+"&end="+end);
			}else{
				window.location.replace("summary.php?table=tbl_prescriptionsales&start="+start+"&end="+end);
			}}
				
		</script>
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
		$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry r INNER JOIN tbl_paymentschemes p ON r.scheme_code=p.pscheme_code WHERE visit_status='1' ORDER BY reg_no DESC limit 30");
		$title='Newly Added Patients';
		?>
		
        <div class="wrapper wrapper-content">
		<form method="POST">
	
				
				<form role="form" method="post">
					<div class="col-sm-12">													
					<?php
						if(isset($_POST['new-search'])){
							
							$searchtermv = $dbconnect->real_escape_string($_POST['searchterm']);
								
										
					//$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE f_name like '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR id_no LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR residence LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%' BY reg_no DESC");
					
					//$searchtermv='28196441';
					$getPatients = mysqli_query($dbconnect, "SELECT * FROM tbl_registry WHERE id_no LIKE '%$searchtermv%' OR phone_no LIKE '%$searchtermv%' OR f_name LIKE '%$searchtermv%' OR l_name LIKE '%$searchtermv%' OR opno LIKE '%$searchtermv%'");
					
					$title='Search Results from the List';
					}
					?>
					</div>
			<div class="row">		
				<div class="col-sm-4"> 
					<div class="form-group">
						<label>Start Date</label>
						<input type="date" name="startdate" value="<?php echo date();?>" id="start" placeholder="Start Date" class="form-control datepicker">
					</div>
				</div>
					<div class="col-sm-4"> 
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" value="<?php echo date();?>"  id="end" placeholder="End Date" class="form-control datepicker">
						</div>
					</div>
				
				
				
				<div class="col-sm-4"> 
					<div class="form-group">
					<label>Pharmaceutical Sales</label>
					<select name="dischargestate" required class="form-control" id="cat" onchange="myscheme()">
							<option value="otc" >choose  </option>
							<option value="otc" >OVER THE COUNTER </option>
							<option value="prescription" >HOSPITAL PRESCRIPTIONS </option>
					</select>
					</div>				
				</div>
				
				
				
				
			</div>
					</form>
				
		<div class="row">
				
                <div class="col-lg-12" id="data1">
						
				<div class="row">
		<div class="col-lg-7">
		<?php
			if(!isset($_GET['table'])){
				$table="tbl_sales";
			}else{
				$table=$_GET['table'];
			}
		?>
		<h2><b>SUMMARY FOR <?php if($table=="tbl_sales"){echo "OVER THE COUNTER SALES "; }else{echo "PRESCRIBED PHARMACEUTICAL SALES";}?></b></h2>
		</div>
		</div>
        <div class="row">
			<?php
			
			
			$currentMonth = date("m");
            $sqlm = "SELECT SUM(sale_amount) AS total_salesm FROM `$table` WHERE MONTH(datee) = '$currentMonth'";
            $resultm = mysqli_query($dbconnect, $sqlm);
            $rowm= mysqli_fetch_assoc($resultm);
            $totalSalesm = $rowm['total_salesm'];

			$currentyear = date("y");
            $sqly = "SELECT SUM(sale_amount) AS total_salesy FROM `$table`";
            $resulty = mysqli_query($dbconnect, $sqly);
            $rowy = mysqli_fetch_assoc($resulty);
            $totalSalesy = $rowy['total_salesy'];

			$currentDate = date("Y-m-d");
            $sqld = "SELECT SUM(sale_amount) AS total_salesd FROM `$table` WHERE datee = '$currentDate'";
            $resultd = mysqli_query($dbconnect, $sqld);
            $rowd = mysqli_fetch_assoc($resultd);
            $totalSalesd = $rowd['total_salesd'];

			$sql5c = mysqli_query($dbconnect,"SELECT COUNT(*) as coun FROM `$table`");
			$row1c = mysqli_fetch_assoc($sql5c);
			$coun= $row1c["coun"];
			
			?>
			
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Annual</span>
                                <h5>Income</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format($totalSalesy, 2);?></h1>
                                <div class="stat-percent font-bold text-success"></div>
                                <small>Total income</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Monthly</span>
                                <h5>Income</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format($totalSalesm, 2);?></h1>
                                <div class="stat-percent font-bold text-info"></div>
                                <small>This Month's income</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Today</span>
                                <h5>Income</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format($totalSalesd, 2);?></h1>
                                <div class="stat-percent font-bold text-navy"></div>
                                <small>Todays sales</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Low value</span>
                                <h5>User activity</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $coun; ?></h1>
                                <div class="stat-percent font-bold text-danger"></div>
                                <small>Items sold totaly</small>
                            </div>
                        </div>
            </div>
        </div>
       

                <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Drugs sold <?php if($table=="tbl_sales"){echo "OVER THE COUNTER"; }else{echo "THROUGH PRESCRIPTION";}?></h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                    
                                        <table id="myTable" class="table table-hover no-margins  dataTables-example">
                                            <thead>
                                            <tr>
                                            <th width="5%">#</th>
                                            <th class="drug-th" width="35%">Name</th>
                                            <th class="quy-th" width="20%">Item Code</th>
                                            <th class="size-th" width="20%">Quantity</th>
                                            <th class="total-th" width="20%">Total prize</th>
                                            
                                            </tr>
                                            </thead>
                                            <tbody>
                                    <?php $getsitems =mysqli_query($dbconnect,"SELECT * FROM `$table` group by sale_itemcode");
                                    if ($getsitems->num_rows > 0) {
                                            $No=0;
                                        while($gcn = mysqli_fetch_array($getsitems)){
                                            $sale_itemcode = $gcn['sale_itemcode'];
                                            $sale_amount = $gcn['sale_amount'];
                                            $sql4 = "SELECT SUM(sale_amount) as totalprice FROM `$table` WHERE sale_itemcode='$sale_itemcode'";
                                            $result4 = mysqli_query($dbconnect, $sql4);
                                            $row = mysqli_fetch_assoc($result4);
                                            $totalprice= $row["totalprice"];
                                            $quantity=$result4->num_rows;
                                            $getsname =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$sale_itemcode'");
                                            $gcn = mysqli_fetch_array($getsname);
                                            $name=$gcn['brand_name']; ?>
                                            <tr>
                                                <td><?php  $No=$No+1;?><?php echo $No;?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $sale_itemcode; ?></td>
                                                <td class="text-navy"> <?php 
                                                $sql5 = mysqli_query($dbconnect,"SELECT COUNT(*) as itemcount FROM `$table` WHERE sale_itemcode='$sale_itemcode'");
                                                $row1 = mysqli_fetch_assoc($sql5);
                                                $itemcount= $row1["itemcount"];
                                                echo $itemcount; ?></td>
                                                <td class="text-navy"> <?php echo number_format($totalprice, 2); ?></td>
                                            </tr>
                                    <?php }} ?>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
					
				</div>
        </div>
		</form>
		<?php include 'includes/footer.php'?>
    </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
   <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
       <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });
    </script>
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
</body>
</html>