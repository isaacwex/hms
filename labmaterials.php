<?php include('includes/authenticate.php'); ?>
<?php
	$currentdeptcode=$_GET['deptcode'];
	$result = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays where `tray_deptcode`='$currentdeptcode' and `tray_dispatchedby`='approved' group by `tray_itemcode`");
    //$result2 = mysqli_query($dbconnect,"SELECT * FROM tbl_materialsrequest_temp where `tray_requestedby`='$sid' ");
	?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>	
    <title>Material Requests - <?php echo "$smart_name"; ?></title>	
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
        xmlhttp.open("GET","druginvent.php?q="+str,true);
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
				<h2>Approved Materials</h2>
				<ol class="breadcrumb">
					<li>
						<a href="materialrequest.php"> Lab Material</a>
					</li>                        
					<li class="active">
						<strong>My Materials</strong>
					</li>
				</ol>
			</div>
            <p class="pull-right"><br>
				<span><a href="materialrequest.php?reqdeptcode=<?php echo $currentdeptcode; ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold"> Material Request</span></button></a></span>
				</p>
				
		</div>
        <div class="wrapper wrapper-content">
                <div class="row">					
										<div class="row" >	
					<div class="col-lg-12" style="background-color:#ffffff;margin-left: 1rem;margin-right:1rem;">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            
						</div>
                        <div class="ibox-content">
                           <div class="row">
                                          

                            <?php if($result->num_rows > 0){?>
                           <table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<!--<th><input type="checkbox" id="selectall" class="i-checks"></th>-->
									<th>S/NO</th>
									<th>Request ID</th>
									<th>Status </th>
									<th>Requested Qty</th>
									<th>Available Qty</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								
								while($gcn = mysqli_fetch_array($result)){
									$No=$No+1;
									$tray_itemcode = $gcn['tray_itemcode'];
									$tray_dispatchedby = $gcn['tray_dispatchedby'];
                                    $tray_qty = $gcn['tray_qty'];
                                    $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$tray_itemcode'");$rrow2 = mysqli_fetch_array($name);$rrowname = $rrow2['brand_name'];
                                    
								?>
								    <td><?php echo $No; ?></td>
									<td><?php echo $rrowname; ?></td>
									<td><span class="badge badge-success"><?php echo $tray_dispatchedby; ?></span></td>
									<td><?php echo $tray_qty; ?></td>
									
									<td><span class="badge badge-success"><?php 
									//code for getting the tests to be here
									
									echo $tray_qty; 
									?></span>
									</td>
									<td>View Usage</td>
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
                                    <b>Out of Material. please request for materials</b>
                                    </div>
                                <?php } ?>
								
								                       
							</div>
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
                responsive: true,
                "dom": 'T<"clear">lfrtip'
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

        });
    </script>
</body>
</html>