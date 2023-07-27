<?php 
session_start();
include 'inc/auth.php';

/**** Redirect to secure page if logged in ***/
if(isset($_SESSION['email']) != ""){
	header('location:index.php');
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - <?php echo "$campaigner_name - $smart_name"; ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<style>
		::placeholder {
		  color: black;
		  opacity: 1; /* Firefox */
		}

		:-ms-input-placeholder { /* Internet Explorer 10-11 */
		 color: black;
		}

		::-ms-input-placeholder { /* Microsoft Edge */
		 color: black;
		}
		
		body {
			background-image: url("bg.jpg");
			background-repeat: no-repeat, repeat;
			background-size: cover;

		}
		.designed {
			width: auto;
			border: 1px solid #000;
			padding: 20px;
			border-radius: 10px 40px;
			background:#61105f;
			opacity: 0.5;
			align: center;
		}
		
		.designed input {
			border-radius: 4px;
			color: black;
		}
		.designed input[type=text]:focus {
			  border: 1px solid black;
			  border-radius: 4px;
			  color: black;
			}
		
		.designed input[type=password]:focus {
			  border: 1px solid black;
			  border-radius: 4px;
			  color: black;
			}
		
		.designed placeholder {
			color: black;
		}
		
		.design4 {
			color: white;
			font-weight:bold;
			opacity: 1;
		}
		
		.designed p {
			color: white;
		}
		
		.designed .logo-name {
			font-size: 80px;
			padding: 4px;
		}
		
		.designed button {
			background: black;
			color: white;
			opacity: 1;
		}
		
		.designed button:hover {
			background: blue;
			color: white;
			border:1px solid #blue;
			opacity: 1;
		}
	</style>

</head>

<body>

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div class="designed">
            <div>
                <h2 class="logo-name">HMS+</h2>

            </div>
			<h2 class="design4"><?php echo $smart_name; ?></h2>
            
            <p>Login to continue</p>
            <form class="m-t" role="form" name="login" action="" method="post">
				<div class="form-group">
					<?php
					if(isset($_POST['sc_login'])){
						$sc_username = $_POST['sc_email'];
						$sc_pass = $_POST['sc_pass'];
						
						$sc_username = strip_tags(trim($sc_username));
						$sc_pass = strip_tags(trim($sc_pass));
						
						$sc_passec = hash('sha256', $sc_pass);
						
						if($stmt = $dbconnect->prepare("SELECT id,f_name,id_no, s_name, email,phone FROM tbl_users WHERE id_no=? AND password=? AND active='activated'")){
							$stmt->bind_param('ss',$sc_username, $sc_passec);
							$stmt->execute();
							$stmt->bind_result($userid,$fname,$idno, $sname,$email,$phone);
							$stmt->store_result();
							$stmt->fetch();
							
							if($num_of_rows = $stmt->num_rows >= 1){
								$_SESSION['id'] = $userid;
								$_SESSION['firstname'] = $fname;
								$_SESSION['lastname'] = $sname;
								$_SESSION['email'] = $email;
								$_SESSION['phone'] = $phone;								
								$loggedIn = $_SESSION['email'];
							
							//  in seconds autologout
							// Taking current system Time
							$_SESSION['start'] = time(); 
							$_SESSION['logged_in']=time();
							// Destroying session after 1 minute
							$_SESSION['expire'] = $_SESSION['start'] + (1 * 3000) ; 
							$_SESSION['last_activity'] = time();
							header('Location: login.php');

							//Record the logs for login
							$actorid=$email;
							$actorname=$fname;
							$actiontime=date("Y-m-d H:m");
							$action="Logged in";
							if($stmt = $dbconnect->prepare("INSERT INTO log_table (user_id_no,user_name,time,action) VALUES (?,?,?,?)")){
								$stmt->bind_param('ssss',$actorid,$actorname,$actiontime,$action);
								$stmt->execute();
									echo "Action Logged.....................";
								}
							else{
							}
								
							//end of redirect in 	
								echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button><i class=\"fa fa-check-circle-o\"></i> Welcome back $fname. You're now signed in</div>";
								
								echo '<META HTTP-EQUIV="Refresh" content="0; URL=index.php">';
																
							}
							else {
								echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button> <i class=\"fa fa-exclamation-triangle\"></i> Username and password does not match! Confirm and try again</div>";
							}
						
						}
					
					}
					
					?>
				</div>
                <div class="form-group">
                    <input type="text" name="sc_email" class="form-control" placeholder="ID Number" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="sc_pass" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" name="sc_login" class="btn btn-primary block full-width m-b buttoned">Login</button>

            </form>
            <p class="m-t"> <small>Copyright &copy; <?php echo date('Y'); ?>. <?php echo $smart_name; ?> <br>Built with &hearts; <a href="mailto: isaacwex@gmail.com tel:0729522550" target="_blank">Dewex Enterprise Solutions</a></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
