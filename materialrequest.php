<?php include('includes/authenticate.php'); 
$requestingdeptcode=$_GET['reqdeptcode'];

    if(isset($_POST['submit1'])){
        $inve_id=$_POST['inve_id'];
        $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_inventory` WHERE `inve_id`='$inve_id'");
        $rrow2 = mysqli_fetch_array($name);
        $inve_drugcode = $rrow2['inve_drugcode'];
        $inve_postedqty = $rrow2['inve_qty'];
        $inve_qty=$_POST['quantity'];
        if($inve_postedqty>=$inve_qty){
                       
                        if(!isset($_SESSION['request'])){   
                        $inve_id=$_POST['requesting'];
                        $requesterid=$_POST['requestme'];}else{
                        $inve_id=$_SESSION['request'];
                        $requesterid=$_SESSION['requester'];
                        }
                        $req_expirydate = date('Y-m-d', strtotime('+7 days'));
                    if(!isset($_SESSION['request'])){
                        $_SESSION['request']=$inve_id;
                        $_SESSION['requester']=$requesterid;
                    }
                    $name =mysqli_query($dbconnect,"SELECT * FROM `tbl_drugs` WHERE `drugitem_code`='$inve_drugcode'");
                    $rrow2 = mysqli_fetch_array($name);
                    $rrowname = $rrow2['brand_name'];
                
                    if ($name->num_rows > 0) {
                        $sql = "INSERT INTO `tbl_materialsrequest_temp` (`tray_id`, `tray_deptcode`, `tray_itemcode`, `tray_requestedby`, `tray_qty`, `tray_expirydate`, `tray_dispatchedby`) VALUES (
                        '$inve_id',
                        '$requestingdeptcode',
                        '$inve_drugcode',
                        '$sidno',
                        '$inve_qty',
                        '$req_expirydate',
                        'pending')";
                        $result = $dbconnect->query($sql);?>
                        <?php // header("Location: materialrequest.php");
                      //  echo $inve_postedqty;
                    }else{
                        echo '<script>alert("their is a problem with the request")</script>';
                        header("Location: materialrequest.php?reqdeptcode=$requestingdeptcode");
                        
                    }
                }else{
                    $lessquantity="<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button><i class=\"fa fa-exclamation-triangle\"></i> Oops! Seems the stock quantity is not enough </div>";    
                }
    }
?>
<?php
	$result = mysqli_query($dbconnect,"SELECT * FROM tbl_dept_trays where `tray_deptcode`='$requestingdeptcode' and `tray_dispatchedby`!='approved' group by `tray_id`");
    $result2 = mysqli_query($dbconnect,"SELECT * FROM tbl_materialsrequest_temp where `tray_deptcode`='$requestingdeptcode' ");
	?>
<!DOCTYPE html>
<html>

<head>
    <?php include('includes/meta.php');?>	
    <title>Drug Catalog - <?php echo "$smart_name"; ?></title>	
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
				<h2>New request </h2>
				<ol class="breadcrumb">
					<li>
						<a href="#"> Submit Material Request (<?php echo $requestingdeptcode; ?>)</a>
					</li>                        
					<li class="active">
						<strong>New request</strong>
					</li>
				</ol>
			</div>
				<div class="col-lg-5">
				<p class="pull-right"><br>
				<!--<span><a href="labmaterials.php"><button class="btn btn-primary" type="button"><i class="fa fa-busket"></i>&nbsp;&nbsp;<span class="bold"> Materials</span></button></a></span>-->
				</p>
				</div>
		</div>
        <div class="wrapper wrapper-content">
                <div class="row">					
					<div class="row">	
                        <div class="ibox-title" style="margin-left: 1rem;margin-right:1rem;align-content:center;">
                           <h5>Select Items</h5>
                        </div>	
                        
                        <div class="row" style="background-color:#ffffff;margin-left: 1rem;margin-right:1rem;">
                            <div class="ibox float-e-margins">
                                
                                    <div class="col-md-6">
                                        <?php if(isset($lessquantity)){
                            echo $lessquantity;
                        }?>
                        <form action="materialrequest.php?reqdeptcode=<?php echo $requestingdeptcode; ?>" method="post">
                                           <div class="form-group" style="display:block;">
                                            <?php if(!isset($_SESSION['request'])){?>
                                            <input type="hidden" name="requesting" value="<?php echo $sid.time();?>" class="form-control">
                                            <?php }else{ ?>
                                            <input type="hidden" name="requesting" value="<?php echo $_SESSION['request'];?>" class="form-control"> <?php } ?>
                                            <?php if(!isset($_SESSION['request'])){?>
                                            <input type="hidden" name="requestme" placeholder="Enter name of your requester" value="<?php echo $sid;?>" class="form-control">  <?php }else{ ?><input type="hidden" name="requestme" value="<?php echo $_SESSION['requester'];?>" placeholder="Enter name of your requester" class="form-control"> <?php } ?>                                          <script>
                                                const quant=document.getElementById("myqty");
                                                const sel=document.getElementById("sel");
                                                sel.addEventListener("change",function(){
                                                quant.setAttribute("max",this.value);
                                             })
                                            </script>

                                                    <select data-placeholder="Choose drug..." name="inve_id" class="form-control chosen-select">
                                                    
                                                            <option selected value="">Select from List </option>
                                                            <?php
                                                        $getalllocations = mysqli_query($dbconnect,"SELECT * FROM tbl_inventory v INNER JOIN tbl_drugs D ON v.inve_drugcode=d.drugitem_code");
                                                        while($gal = mysqli_fetch_array($getalllocations)){
                                                            $product_code = $gal['drugitem_code'];
                                                            $brand_name = $gal['brand_name'];
                                                            $inve_batchno = $gal['inve_batchno'];
                                                            $inve_qty = $gal['inve_qty'];
                                                            $inve_id = $gal['inve_id'];
                                                            
                                                            ?>
                                                            <option value="<?php echo $inve_id; ?>" > <?php echo $brand_name; ?> | Batch- <?php echo $inve_batchno; ?>  | Available qty-<?php echo $inve_qty; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                   
                                            </div>
                                            <div class="form-group">
                                            <label><h4>Quantity</h4></label>
                                            <input type="number" name="quantity" class="form-control">
                                            </div>
                                            <div class="form-group">
                                             <p class="pull-right"><button class="btn btn-primary" type="submit" name="submit1" class="form-control btn btn-primary">Add to List</button></p>
                                            </div>
                                        </form>
                                       
                                    </div>
                                    <div class="col-md-6" style="height:40vh;overflow:scroll;" >
                                       
                                       <?php if(isset($_SESSION['request'])){?>	
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
								<tr><td colspan="7"><a href="submitrequest.php?request=<?php echo $_SESSION['request'];?>&reqdeptcode=<?php echo $requestingdeptcode; ?>" style="text-align:center;">
                                <a href="sessinvoice.php?page=request" class="btn btn-primary" style="text-align:center;">Clear</a> <p class="pull-right"> <a href="submitinvoice.php?page=r&invoice=<?php echo $_SESSION['request'];?>&reqdeptcode=<?php echo $requestingdeptcode; ?>"  class="btn btn-primary" style="text-align:center;">Submit Request</a></p>
                               
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
                                    <b>create new requests</b>
                                    </div>                                    
                                    <?php }?>
                                        </div>
                                    </div>
                        </div>
                     </div>

					<div class="row" >	
					<div class="col-lg-12" style="background-color:#ffffff;margin-left: 1rem;margin-right:1rem;">					
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div style="text-align: center;
                                        margin-top: 20px;
                                        color:green;
                                        font-size: large;">
                                        <b><u>PENDING REQUESTS</u></b>
                                        </div>
                            <p class="pull-right"></p>
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
									<th>Expiry Date</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$No = 0;
								
								while($gcn = mysqli_fetch_array($result)){
									$No=$No+1;
									$tray_id = $gcn['tray_id'];
									$tray_dispatchedby = $gcn['tray_dispatchedby'];
                                    $tray_expirydate = $gcn['tray_expirydate'];
								?>
								    <td><?php echo $No; ?></td>
									<td><?php echo $tray_id; ?></td>
									<td><?php echo $tray_dispatchedby; ?></td>
									<td><?php echo $tray_expirydate; ?></td>
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

</body>
</html>