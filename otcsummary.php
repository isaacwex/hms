<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/meta.php');?>
    <!--<link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="assets/css/datatables.min.css">
   

   <title>Served Patients - <?php echo $smart_name; ?></title>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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

			$currentyear = date("Y");
            $sqly = "SELECT SUM(sale_amount) AS total_salesy FROM `$table` WHERE YEAR(datee) = '$currentyear'";
            $resulty = mysqli_query($dbconnect, $sqly);
            $rowy = mysqli_fetch_assoc($resulty);
            $totalSalesy = $rowy['total_salesy'];

			$currentDate = date("Y-m-d");
            $sqld = "SELECT SUM(sale_amount) AS total_salesd FROM `$table` WHERE datee = '$currentDate'";
            $resultd = mysqli_query($dbconnect, $sqld);
            $rowd = mysqli_fetch_assoc($resultd);
            $totalSalesd = $rowd['total_salesd'];

			$sql5c = mysqli_query($dbconnect,"SELECT COUNT(*) as coun FROM `$table` WHERE datee = '$currentDate'");
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
                                <span class="label label-danger pull-right">Item flow</span>
                                <h5>Quantity sold</h5>
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
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Orders</h5>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white active">Today</button>
                                        <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                        <button type="button" class="btn btn-xs btn-white">Annual</button>

                                        <?php
                                            $startdate=date('Y/m/d');
                                            $enddate=date('Y/m/d');
                                            if(isset($_SESSION['datesearch'])){
                                              
                                            }
                                                $getsalecount =mysqli_query($dbconnect,"SELECT * FROM `$table`");
                                                $salecount=$getsalecount->num_rows;
                                                $sql4 = "SELECT SUM(sale_amount) as total FROM tbl_sales WHERE  `datee`>='$startdate' AND `datee`<='$enddate'";
                                                $result4 = mysqli_query($dbconnect, $sql4);
                                                $row = mysqli_fetch_assoc($result4);
                                                $total= $row["total"];
                                                $sql5 = "SELECT SUM(sale_amount) as mpesa FROM tbl_sales WHERE  sale_modeofpayment='MPESA' AND `datee`>='$startdate' AND `datee`<='$enddate'";
                                                $result5 = mysqli_query($dbconnect, $sql5);
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $mpesa= $row5["mpesa"];
                                                $sql7 = "SELECT SUM(sale_amount) as cash FROM tbl_sales WHERE sale_modeofpayment='CASH' AND `datee`>='$startdate' AND `datee`<='$enddate'";
                                                $result7 = mysqli_query($dbconnect, $sql7);
                                                $row7 = mysqli_fetch_assoc($result7);
                                                $cash= $row7["cash"];
                                                $other=$total-($mpesa+$cash);
                                                if($total!=0){$mpesaper=(100*$mpesa)/$total;}else{$mpesaper="0.00";}
                                                if($total!=0){$otherper=(100*$other)/$total;}else{$otherper="0.00";}
                                                if($total!=0){$cashper=(100*$cash)/$total;}else{$cashper="0.00";}
                                                ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ibox-content">
                                <div class="row">
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        
                                    <canvas class="flot-chart-content"  id="myChart" style="height:10%;"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                <?php if($table=="tbl_sales"){?>    
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins"><?php echo number_format($cash, 2); ?></h2>
                                            <small> <b>Cash Payments</b></small>
                                            <div class="stat-percent"><?php echo number_format($cashper, 2); ?>% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins "><?php echo number_format($mpesa, 2); ?></h2>
                                            <small> <b>Mpesa Payments</b></small>
                                            <div class="stat-percent"><?php echo number_format($mpesaper, 2); ?>% <i class="fa fa-level-down text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins "><?php echo number_format($other, 2); ?></h2>
                                            <small><b>Other Payment</b></small>
                                            <div class="stat-percent"><?php echo number_format($otherper, 2); ?>% <i class="fa fa-bolt text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        </ul> <?php }else{ ?>
                                            <ul class="stat-list">
                                    <?php
										$No = 0;
										$find_schemes = mysqli_query($dbconnect,"SELECT * FROM tbl_paymentschemes");
										while ($skim = mysqli_fetch_array($find_schemes)){
											
											$skim_id = $skim['pscheme_id'];
											$skim_code = $skim['pscheme_code'];
											$skim_name = $skim['pscheme_name'];
                                            $sqlscheme = "SELECT SUM(sale_amount) as schem FROM tbl_prescriptionsales";
                                                $resultscheme = mysqli_query($dbconnect, $sqlscheme);
                                                $rowscheme = mysqli_fetch_assoc($resultscheme);
                                                $schem= $rowscheme["schem"];
											?>
                                        
                                            <li>
                                            <h2 class="no-margins"><?php echo number_format($schem, 2); ?></h2>
                                            <small> <b><php echo $skim_name;?></b></small>
                                            <div class="stat-percent"><?php echo number_format($cashper, 2); ?>% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                         </li>
                                      
                                        <?php }?>
                                    </ul>
                                 <?php }?></div>

                                    </div>
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
                                        <h5>DRUGS SOLD <?php if($table=="tbl_sales"){echo "OVER THE COUNTER"; }else{echo "THROUGH PRESCRIPTION";}?></h5>
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
                                    
                                        <table id="example" class="table table-striped table-bordered">
                                            <thead class="table-dark">
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
		<?php 
            $startdate=date('Y/m/d');
            $enddate=date('Y/m/d');
            
                
                $currentDate = date('Y/04/21');
                $matare=array();
                $datampesa = array();
                $datacash = array();
                $dataother = array();
                for ($i = 0; $i < 7; $i++) {
                    $day= date('Y/m/d', strtotime("-$i day", strtotime($currentDate)));
                    $da=date('d',strtotime($day));
                    
                    
                    $matare[]=$da;
                    

                    $sqlmpes = "SELECT SUM(sale_amount) as dataa FROM `$table` WHERE `sale_modeofpayment`='MPESA' AND `datee`='$day'";
                    $resultmpe = $dbconnect->query($sqlmpes);
                    $rowmp = mysqli_fetch_assoc($resultmpe);
                    $gmpesa=number_format($rowmp['dataa'],1);
                    if($gmpesa<=0){$gmpesa=0;}

                    $sqlcash = "SELECT SUM(sale_amount) as dataa FROM `$table` WHERE `sale_modeofpayment`='CASH' AND `datee`='$day'";
                    $resultcash = $dbconnect->query($sqlcash);
                    $rowcash = mysqli_fetch_assoc($resultcash);
                    $gcash=number_format($rowcash['dataa'],1);
                    if($gcash<=0){$gcash=0;}

                    $sqlother = "SELECT SUM(sale_amount) as dataa FROM `$table` WHERE `sale_modeofpayment`!='MPESA' AND `sale_modeofpayment`!='CASH' AND `datee`='$day'";
                    $resultother = $dbconnect->query($sqlother);
                    $rowother = mysqli_fetch_assoc($resultother);
                    $gother=number_format($rowother['dataa'],1);
                    if($gother<=0){$gother=0;}
                    
                    $datampesa[]=$gmpesa;
                    $datacash[] = $gcash;
                    $dataother[] = $gother;
                  }
              
        include 'includes/footer.php'?>
    </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>


    <!-- Page-Level Scripts -->
    
<script>
const xValues = <?php echo json_encode($matare, JSON_NUMERIC_CHECK); ?>;
new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: <?php echo json_encode($datampesa, JSON_NUMERIC_CHECK);?>,
      borderColor: "red",
      fill: true
    }, { 
      data: <?php  echo json_encode($datacash, JSON_NUMERIC_CHECK);?>,
      borderColor: "green",
      fill: true
    }, { 
      data: <?php echo json_encode($dataother, JSON_NUMERIC_CHECK);?>,
      borderColor: "blue",
      fill: true
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>
    
   <!-- <script src="assets/js/bootstrap.bundle.min.js"></script>
    --<script src="assets/js/jquery-3.6.0.min.js"></script>-->
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>