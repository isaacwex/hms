<?php include('includes/authenticate.php'); ?>
<?php
	//$result = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays where `tray_requestedby`='$sid' and `tray_dispatchedby`!='approved' group by `tray_id`");
	$result = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays where `tray_dispatchedby`!='approved' group by `tray_id`");
    $result2 = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays where `tray_id`='$sid' and `tray_dispatchedby`!='approved'");
	//$result = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays where `tray_dispatchedby`!='approved' group by `tray_id`");
   // $result2 = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays where `tray_dispatchedby`!='approved' group by `tray_id``tray_dispatchedby`!='approved'");
	?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>	
    <title>Departmental Requests - <?php echo "$smart_name"; ?></title>	
	<!-- Data Tables -->	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<link href="css/plugins/chosen/chosen.css" rel="stylesheet">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
    <script>
			function opendrug() {
				// Get the modal element
				var modal = document.getElementById("myModal");
				// Set the modal content
				var nameElement = document.getElementById("name");
				nameElement.innerText = name;
				var cart2element = document.getElementById("cart2");
				cart2element.value = cart;
				var drugid2 = document.getElementById("drugid2");
				drugid2.value = drugid;
				// Show the modal
				$(modal).modal("show");
			}
		</script>
        <script>
    function showResult(str) {
        if (str.length==0) {
            document.getElementById("livesearch").innerHTML="";
            document.getElementById("livesearch").style.border="0px";
            return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET","approveitems.php?tray="+str,true);
        xmlhttp.send();
        }
        function approve(a,b) {
        //alert(a);
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                showResult(b);
            }
        }
        xmlhttp.open("GET","checkapprovedtray.php?tray="+b+"&item="+a);
        xmlhttp.send();
        }
        function mydata(str) {
            document.getElementById("livesearch").innerHTML="";
            document.getElementById("livesearch").style.border="0px";
            
        }
         // Define an array to store the cart items
       
    </script>
</head>

<body>
    <div id="wrapper">
    <!-- Navigation -->
	<?php include('includes/sidebar.php');?>
    <!-- Navigation -->

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('includes/top-nav.php'); ?>
        </div>
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-7">
				<h2>Check requests</h2>
				<ol class="breadcrumb">
					<li>
						<a href="drugs.php"> Approve Material Request</a>
					</li>                        
					<li class="active">
						<strong>New request</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				
				</p>
				</div>
		</div>
        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">					
						
                        <div class="ibox-title" style="margin-left: 1rem;margin-right:1rem;align-content:center;">
                           <h5>Approve Material request</h5>
                        </div>	
                        
                        <div class="row" style="background-color:#ffffff;margin-left: 1rem;margin-right:1rem;">
                            <div class="ibox float-e-margins">
                                
                                    <div class="col-md-6">
                                            <div class="form-group">
                                            <input type="text" name="req" placeholder="Search by request tray Id" class="form-control">
                                            </div>
                                            <div class="row">
                                          

                            <?php if($result->num_rows > 0){?>
                           <table class="table table-striped table-bordered table-hover dataTables-example" style="margin-left: 1rem;margin-right:1rem;" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Request ID</th>
									<th>Status </th>
									<th>Department</th>
                                    <th>#</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								
								while($gcn = mysqli_fetch_array($result)){
									$No=$No+1;
									$tray_id = $gcn['tray_id'];
									$tray_dispatchedby = $gcn['tray_dispatchedby'];
                                    $tray_deptcode = $gcn['tray_deptcode'];
								?><tr style="cursor: pointer;" onclick="showResult(<?php echo  $tray_id;?>)">
								    <td><?php echo $No; ?></td>
									<td><?php echo $tray_id; ?></td>
									<td><?php echo $tray_dispatchedby; ?></td>
									<td><span class="badge badge-primary"><?php echo $tray_deptcode; ?></span></td>
                                    <td><button>Open</button></td>
									<!--<td><button class="btn-xs btn-primary"><a href="edit-county.php?county_id=<?php //echo $county_code; ?>"><i class="fa fa-pencil"></i> Edit </a></button> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button></td>-->
								</tr>
								<?php
								}?>
                                </tbody>
								</table> 
                            <?php }else{ ?>
                                    <div style="text-align: center;
                                    font-size: 24px;
                                    margin-top: 20px;
                                    align-items: center;
                                    color:green;
                                    font-size: large;">
                                    <b>You have no Pending requests</b>
                                    </div>
                                <?php } ?>
								
								                       
							</div>
                                    
                                    
                                    </div>
                                    <div class="col-md-6 well well-sm" style="min-height:75vh;overflow:scroll;" id="livesearch" >
                                       
                                       <?php if($result2->num_rows > 0){?>	
                           <table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Drug Name</th>
									<th>Quantity</th>
                                    <th>Date</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								
								while($gcn2 = mysqli_fetch_array($result2)){
									$No=$No+1;
									$tray_itemcode = $gcn2['tray_itemcode'];
									$tray_qty = $gcn2['tray_qty'];
                                    $tray_expirydate = $gcn2['tray_expirydate'];
                                    $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$tray_itemcode '");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
								?>
								    <td><?php echo $No; ?></td>
									<td><?php echo $rrowname; ?></td>
									<td><?php echo $tray_qty; ?></td>
									<td><?php echo $tray_expirydate; ?></td>
									<!--<td><button class="btn-xs btn-primary"><a href="edit-county.php?county_id=<?php //echo $county_code; ?>"><i class="fa fa-pencil"></i> Edit </a></button> | <button class="btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button></td>-->
								</tr>
								<?php
								}
								?>
								<tr><td colspan="7"><a href="submitrequest.php?request=<?php echo $_SESSION['request'];?>" style="text-align:center;">
                                <a href="sessinvoice.php?page=request" class="btn btn-primary" style="text-align:center;">Clear</a> <p class="pull-right"> <a href="submitinvoice.php?page=r&invoice=<?php echo $_SESSION['request'];?>"  class="btn btn-primary" style="text-align:center;">Submit Request</a></p>
                               
							</a></td></tr>
								</tbody>
								</table>
                                <?php } else{ ?> 
                                    <div style="text-align: center;
                                    font-size: 24px;
                                    margin-top: 20px;
                                    align-items: center;
                                    color:green;
                                    font-size: large;">
                                    <b>Item list will be displayed here</b>
                                    </div>                                    
                                    <?php }?>
                                        </div>
                                    </div>
                        </div>
                     </div>
			</div>
        </div>

		<?php include 'includes/footer.php'?>

        </div>
    </div>

   <?php include 'includes/footer-scripts.php';?>
<script>
        
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

    </script>
 <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>
  <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

        });
    </script>
	
</body>
</html>