<?php include('includes/authenticate.php'); ?>
<!DOCTYPE html>
<html>
<head>
     <?php include('includes/meta.php');?>
	
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

   <title>Consultation - <?php echo $smart_name; ?></title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
    <script>
        function showResult(str) {
			if (str.length==0) {
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("names").innerHTML=this.responseText;
				document.getElementById("names").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","searchdrug.php?q=0");
			xmlhttp.send();
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("names").innerHTML=this.responseText;
				document.getElementById("names").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","consultationtble.php?q="+str,true);
			xmlhttp.send();
			}
			 // Define an array to store the cart items
		</script>
		<script>
			function myFunction(name,id,b,p) {
			if (id.length==0) {
				document.getElementById("details").innerHTML="";
				document.getElementById("details").style.border="0px";
				return;
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("details").innerHTML=this.responseText;
				document.getElementById("details").style.border="0px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","consultation_details.php?i="+id+"&n="+name+"&batch="+b+"&p="+p+"&img=drug.jpg");
			xmlhttp.send();
			}
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
			$current_processstage='CONSULTATION';
			$queuestatuscurrent='1';
			//$getPatientsConsultations = mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_consultations r ON r.consultation_opno=q.queue_opno AND r.consultation_visitno=q.queue_visitno INNER JOIN tbl_registry p ON q.queue_visitno=p.visit_no AND q.queue_opno=p.opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			$getPatientsConsultations =mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry p on q.queue_visitno=p.visit_no AND p.opno=q.queue_opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");
			
			
			$title='Patients for Consultation';

		?>	
                
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div>
                            <span class="pull-right text-right">
                            <small>Average value of sales in the past month in: <strong>United states</strong></small>
                            <br/>All sales: 162,862</span>
                            <h3 class="font-bold no-margins">
                                Half-year revenue margin
                            </h3>
                            <small>Sales marketing.</small>
                        </div>
                        <div class="m-t-sm">

                        </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="row">
                        
                        </div>
                        <div class="table-responsive" id="names">
                        
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Consultation Details </h5>
                        <div class="ibox-tools" id="details">
                         working   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
				
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