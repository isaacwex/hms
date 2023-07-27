
<?php $getPatientsConsultations =mysqli_query($dbconnect, "SELECT * FROM tbl_queue q INNER JOIN tbl_registry p on q.queue_visitno=p.visit_no AND p.opno=q.queue_opno WHERE q.queue_to='$current_processstage' AND q.queue_status='$queuestatuscurrent'");?>
            <table class="table table-striped table-bordered table-hover dataTables-example1">
				<thead>
                    <tr>						
                        <th>Names</th>
                        <th>Details</th>
                        <th>Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $No = 0;
                    
                    while($gacC = mysqli_fetch_array($getPatientsConsultations)){
                    $No=$No+1;
                    $c_id = $gacC['reg_no'];
                    $fnames = $gacC['f_name'];
                    $lnames = $gacC['l_name'];
                    $id_number = $gacC['id_no'];
                    $phonenumber = $gacC['phone_no'];
                    $gender = $gacC['gender'];
                    $dob = $gacC['dob'];
                    $opno = $gacC['opno'];
                    $visitno = $gacC['visit_no'];
                    $reside = $gacC['residence'];
                    $visit_date = $gacC['visit_date'];
                    $todaydate = date('Y-m-d');
                    
                    $date1 = $dob;
                    $date2 = $todaydate;
                    $diff = date_diff(date_create($dob), date_create($todaydate));
                    $agess = $diff->format('%y');
                    ?>
                  <tr class='gradeX' onclick="myFunction('<?php echo $rrowname; ?>', '<?php echo $inve_drugcode; ?>', '<?php echo $inve_batchno; ?>',<?php echo $rrowprice; ?>)>"; ?>
                        <td><?php echo "$fnames $lnames"; ?></td>
                        <td>
                            <?php echo $opno; ?> | <?php echo $visitno; ?><br>
                            <?php echo "$gender";?>-<?php echo "$agess yrs";?><br>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>