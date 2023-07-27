<?php include 'inc/auth.php'; ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - <?php echo $smart_name;?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">SC+</h1>

            </div>
            <h3>Register to <?php echo $smart_name; ?></h3>
            <p>Create account to see it in action.</p>
            <form class="m-t" role="form" action="" method="post" name="register">
				<div class="form-group">
					<?php
					if(isset($_POST['register'])){
						if(empty($_POST['idno'])){
							echo "ID No should not be empty";
						}
						elseif(empty($_POST['email'])){
							echo "An email address is a MUST";
						}
						elseif(empty($_POST['pass'])){
							echo "Choose a password";
						}
						else {
							$firstName = $dbconnect->real_escape_string($_POST['fname']);
							$surName = $dbconnect->real_escape_string($_POST['sname']);
							$passcode = $_POST['pass'];

							$emailAddress = $dbconnect->real_escape_string($_POST['email']);
							$idno = $dbconnect->real_escape_string($_POST['idno']);
							$tel = $dbconnect->real_escape_string($_POST['phone']);
								
							$firstName = strip_tags($firstName);
							$surName = strip_tags($surName);
							$emailAddress = strip_tags($emailAddress);
							$idno = strip_tags($idno);
							$tel = strip_tags($tel);
							$passed = strip_tags(trim($passcode));
								
							$passWord = hash('sha256',$passed);
								
							$get_email = mysqli_query($dbconnect,"SELECT * FROM users WHERE email='$emailAddress'");
							$counte = mysqli_num_rows($get_email);
							
							if($counte >= 1 ){								
								echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button> Oops! The email $emailAddress already exists in the $smart_name system</div>";
							}
							else {
								if($stmt = $dbconnect->prepare("INSERT INTO users (f_name,s_name,email,id_no,password,phone) VALUES (?,?,?,?,?,?)")){
									$stmt->bind_param('ssssss',$firstName,$surName,$emailAddress,$idno,$passWord,$tel);
									$stmt->execute();
									
									echo "<div class=\"alert alert-success alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button> Successful registered . <a href=\"login.php\">Login Here</a> </div>";
								}
								else {
									echo "<div class=\"alert alert-danger alert-dismissable\"><button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">x</button> Oops! Error registering on $smart_name </div>";								
								}
							
							}
						
						}
					
					
					}
					
					
					?>
				</div>
                <div class="form-group">
                    <input type="text" name="fname" class="form-control" placeholder="First Name" required="">
                </div>
                <div class="form-group">
                    <input type="text" name="sname" class="form-control" placeholder="SurName" required="">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="pass" class="form-control" placeholder="Password" required="">
                </div>
                <div class="form-group">
                    <input type="text" required name="idno" class="form-control" placeholder="ID No" required="">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" required="">
                </div>
                <button type="submit" name="register" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Login</a>
            </form>
            <p class="m-t"> <small>Copyright &copy; 2016 - <?php echo date('Y'); ?>. <?php echo $smart_name; ?> Built with &hearts; <a href="htttp://www.imobtechnologies.co.ke" target="_blank">iMob Team</a></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
