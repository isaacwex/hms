<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo "$sfname $ssname";?></strong>
                             </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.php">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php?logout">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            HMS+
                        </div>
                    </li>
                    <li class="active">
                        <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
					<?php 
					if($user_l=='REGISTRY'||$user_l=='ADMINISTRATOR'){
					?>
                  
					<li>
                        <a href="registry.php"><i class="fa fa-calendar"></i> <span class="nav-label">Registry </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="registry.php"><i class="fa fa-plus"></i> <span class="nav-label">Current</span></a>
							</li>
							<li>
								<a href="registryreport.php"><i class="fa fa-plus"></i> <span class="nav-label"> History</span></a>
							</li>
						</ul>
                    </li>
					<?php
					}					
					if($user_l=='TRIAGE'||$user_l=='ADMINISTRATOR'||$user_l=='TREATMENTROOM'){
					?>
					
					<li>
						<a href="#"><i class="fa fa-hospital-o"></i> <span class="nav-label">Triage </span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="triage.php"><i class="fa fa-plus"></i> <span class="nav-label">Requests</span></a>
							</li>
							<li>
								<a href="servedpatients.php"><i class="fa fa-plus"></i> <span class="nav-label"> History</span></a>
							</li>
						</ul>
					</li>
					
					<?php
					}					
					if($user_l=='CONSULTATION'||$user_l=='ADMINISTRATOR'){
					?>
					<li>
                        <a href="#"><i class="fa fa-user-md"></i> <span class="nav-label">Consultation </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="consultations.php"><i class="fa fa-plus"></i> <span class="nav-label">Requests</span></a>
							</li>
							<li>
								<a href="servedpatients.php"><i class="fa fa-plus"></i> <span class="nav-label">History</span></a>
							</li>
						</ul>
                    </li>
					<?php
					}					
					if($user_l=='LABORATORY'||$user_l=='ADMINISTRATOR'){
					?>
					<li>
                        <a href="#"><i class="fa fa-road"></i> <span class="nav-label">Laboratory </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="laboratory.php"><i class="fa fa-plus"></i> <span class="nav-label">Patient Requests</span></a>
							</li>
							<li>
								<a href="labmaterials.php?deptcode=LABORATORY"><i class="fa fa-plus"></i> <span class="nav-label">Materials</span></a>
							</li>
							<li>
								<a href="servedpatients.php"><i class="fa fa-plus"></i> <span class="nav-label">Lab History</span></a>
							</li>
						</ul>
                    </li>
					<?php
					}					
					if($user_l=='TRIAGE'||$user_l=='ADMINISTRATOR'||$user_l=='TREATMENTROOM'){
					?>
					
					<li>
                        <a href="#"><i class="fa fa-medkit"></i> <span class="nav-label">Treatment Room </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="treatmentroom.php"><i class="fa fa-plus"></i> <span class="nav-label">Patient Requests</span></a>
							</li>
							<li>
								<!--<a href="materialrequest.php"><i class="fa fa-plus"></i> <span class="nav-label">Material</span></a>-->
							</li>
							<li>
								<a href="labmaterials.php?deptcode=TREATMENTROOM"><i class="fa fa-plus"></i> <span class="nav-label">Material</span></a>
							</li>
							<li>
								<a href="servedpatients.php"><i class="fa fa-plus"></i> <span class="nav-label"> History</span></a>
							</li>
						</ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-ambulance"></i> <span class="nav-label">Inpatient </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="inpatient.php"><i class="fa fa-plus"></i> <span class="nav-label">Requests</span></a>
							</li>
							<li>
								<a href="labmaterials.php?deptcode=INPATIENT"><i class="fa fa-plus"></i> <span class="nav-label">Materials</span></a>
							</li>
							<li>
								<a href="servedpatients.php"><i class="fa fa-plus"></i> <span class="nav-label"> History</span></a>
							</li>
						</ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-child"></i> <span class="nav-label">ANC </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="maternity.php"><i class="fa fa-plus"></i> <span class="nav-label">Requests</span></a>
							</li>
							<li>
								<a href="servedpatients.php"><i class="fa fa-plus"></i> <span class="nav-label"> History</span></a>
							</li>
						</ul>
                    </li>
					<?php
					}					
					if($user_l=='PHARMACY'||$user_l=='ADMINISTRATOR'){
					?>
						
					<li>
                        <a href="#"><i class="fa fa-file-text-o"></i> <span class="nav-label">Pharmacy </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							
                            <li><a href="newotc.php"><i class="fa fa-plus"></i> <span class="nav-label">OTC</span></a></li>
							<li><a href="pharmacy.php"><i class="fa fa-plus"></i> <span class="nav-label">OP Requests</span></a></li>
							<li><a href="pharmacyip.php"><i class="fa fa-plus"></i> <span class="nav-label">IP Requests</span></a></li>
                            <li><a href="pharmacyipophistory.php"><i class="fa fa-plus"></i> OP/IP History</a></li>
							<li><a href="drugs.php"><i class="fa fa-plus"></i> Drugs</a></li>
							<li><a href="inventory.php"><i class="fa fa-plus"></i> Recent Inventories</a></li>
							<li><a href="drugscurrentstock.php"><i class="fa fa-plus"></i> Stock & Prices</a></li>
                            <li><a href="sales.php"><i class="fa fa-plus"></i> Sales</a></li>
                            <li><a href="materialrequestapproval.php"><i class="fa fa-plus"></i> Dept Requests</a></li>
                            <li><a href="#"><i class="fa fa-plus"></i> Non-Pharms</a></li>
                            <li><a href="otcbill.php"><i class="fa fa-plus"></i> OTC Queue</a></li>
							
                            <li><a href="salesadmin.php"><i class="fa fa-plus"></i> Sales Report</a></li>
					</ul>
                    </li>
					<?php	
					}					
					if($user_l=='ADMINISTRATOR'){
					?>
					<li>
                        <a href="#"><i class="fa-solid fa-road"></i> <span class="nav-label">Dental </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="dental.php"><i class="fa fa-plus"></i> <span class="nav-label">Requests</span></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-plus"></i> <span class="nav-label"> History</span></a>
							</li>
						</ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-dot-circle-o"></i> <span class="nav-label">Physiotherapy </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="physiotherapy.php"><i class="fa fa-plus"></i> <span class="nav-label">Requests</span></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-plus"></i> <span class="nav-label"> History</span></a>
							</li>
						</ul>
                    </li>
						<li>
                        <a href="#"><i class="fa fa-photo"></i> <span class="nav-label">Radiology </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>
								<a href="radiology.php"><i class="fa fa-plus"></i> <span class="nav-label">Requests</span></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-plus"></i> <span class="nav-label"> History</span></a>
							</li>
						</ul>
                    </li>
					<?php
					}					
					if($user_l=='REGISTRY'||$user_l=='ADMINISTRATOR'){
					?>
					<li>
                        <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Billing </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						<li>
							<a href="billing.php"><i class="fa fa-plus"></i> <span class="nav-label">OP Bills</span></a>
						</li>
						<li>
							<a href="billingip.php"><i class="fa fa-plus"></i> <span class="nav-label">IP Bills</span></a>
						</li>
						<li> <a href="patientinvoices.php"><i class="fa fa-plus"></i>Pending Invoices</a></li>
						
						</ul>
                    </li>
					
					<?php
					}					
					if($user_l=='ADMINISTRATOR'){
					?>
					<li>
                        <a href="#"><i class="fa fa-cc-mastercard"></i> <span class="nav-label">Finance & Accounts </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						<li>
							<a href="petty.php"><i class="fa fa-plus"></i> <span class="nav-label">Petty Cash</span></a>
						</li>
						<li>
							<a href="servedpatients.php"><i class="fa fa-plus"></i> <span class="nav-label">Sale Summaries</span></a>
						</li>
						<li>
							<a href="billing.php"><i class="fa fa-plus"></i> <span class="nav-label">Profit and Loss</span></a>
						</li>
						<li>
							<a href="billing.php"><i class="fa fa-plus"></i> <span class="nav-label">Debtors</span></a>
						</li>
						</ul>
                    </li>
					<?php } ?>
					<li>
                        <a href="#"><i class="fa fa-folder-open"></i> <span class="nav-label">HR & Payroll </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
					<?php if($user_l=='ADMINISTRATOR'){ ?>
						<li>
							<a href="employees.php"><i class="fa fa-plus"></i> <span class="nav-label">Employees</span></a>
						</li>
						<li>
							<a href="payperiods.php"><i class="fa fa-plus"></i> <span class="nav-label">Paypoints</span></a>
						</li>
						<li>
							<a href="process-salary.php"><i class="fa fa-plus"></i> <span class="nav-label">Process Salary</span></a>
						</li>
						<li>
							<a href="paysliplist.php"><i class="fa fa-plus"></i> <span class="nav-label">Pay History</span></a>
						</li>
						<li>
							<a href="bands.php"><i class="fa fa-plus"></i> <span class="nav-label">Bands</span></a>
						</li>
					<?php }	?>
						<li>
							<a href="transactionentry.php"><i class="fa fa-plus"></i> <span class="nav-label">Salary Advance </span></a>
						</li>
						<li>
							<a href="paysliplist.php"><i class="fa fa-plus"></i> <span class="nav-label">Payslip </span></a>
						</li>
						<li>
							<a href="employees.php"><i class="fa fa-plus"></i> <span class="nav-label">My HR Profile </span></a>
						</li>
						
					<?php if($user_l=='ADMINISTRATOR'){ ?>
						<li>
							<a href="hrreports.php"><i class="fa fa-plus"></i> <span class="nav-label">HR Reports</span></a>
						</li>
					<?php }	?>
						</ul>
                    </li>
					
					<li>
                        <a href="#"><i class="fa fa-building"></i> <span class="nav-label">Leave Manager </span><span class="fa arrow"></span><span class="label label-warning pull-right"><?php echo $leavestoapprove; ?></span></a>
                        <ul class="nav nav-second-level">
						<li>
							<a href="leaveapplicationsrecent.php"><i class="fa fa-plus"></i> <span class="nav-label">Applications</span><span class="label label-primary pull-right"><?php echo $leavestoapprove; ?></span></a>
						</li>
						<li>
							<a href="leaveentitlements.php"><i class="fa fa-plus"></i> <span class="nav-label">Leave Register</span></a>
						</li>
						</ul>
                    </li>
					<?php		
					if($user_l=='ADMINISTRATOR'){
					?>
					 <li>
                        <a href="reports.php"><i class="fa fa-area-chart"></i> <span class="nav-label">Reports</a>
                        
                    </li>
					 
                    <li>
                        <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Master Settings</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <!--<li><a href="clinicservices.php"><i class="fa fa-plus"></i> Clinic Services</a></li>-->
                           <!---<li><a href="first_lab_services.php"><i class="fa fa-plus"></i> Lab Services</a></li>-->
                           <!-- <li><a href="first_nursingstation_services.php"><i class="fa fa-plus"></i> Nursing Station </a></li>-->
							
							
							
							<li><a href="add-service.php"><i class="fa fa-plus"></i> All Services </a></li>
							<li><a href="drugscurrentstock.php"><i class="fa fa-plus"></i> Drugs Stock </a></li>
							<li><a href="summary.php"><i class="fa fa-plus"></i> Drugs Summary </a></li>
							<li><a href="first_services.php"><i class="fa fa-plus"></i> Clinic Services </a></li>
                            <li><a href="vitalsigns.php"><i class="fa fa-plus"></i> Vital Signs</a></li>
							 <li><a href="payment_schemes.php"><i class="fa fa-plus"></i> Payment Schemes</a></li>
							<li><a href="drug-caterogies.php"><i class="fa fa-plus"></i>Drug Categories</a></li>
                            <li><a href="suppliers.php"><i class="fa fa-plus"></i> Suppliers</a></li>
                            <li><a href="logs.php"><i class="fa fa-plus"></i> Audit Tray</a></li>
                            
					</ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-gear"></i> <span class="nav-label"> Settings</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="campaigner.php"><i class="fa fa-plus"></i> Institution Profile</a></li>
							<li> <a href="profile.php"><i class="fa fa-plus"></i> User Profile</a></li>
						</ul>
                    </li>
					<?php
					}					
					?>	
                </ul>
            </div>
        </nav>