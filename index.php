
<?php
        session_start();
        error_reporting(0);
        include('includes/config.php');
        if(isset($_POST['signin'])) {

            $uname=$_POST['username'];
            $password=md5($_POST['password']);
            $sql ="SELECT EmailId,Password,Status,id FROM employee_table WHERE EmailId=:uname and Password=:password";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
            $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);

            if($query-> rowCount() > 0) {
                foreach ($results as $result) {
                    $status=$result->Status;
                    $_SESSION['eid']=$result->id;
                }
                if($status==0){
                    $msg="Your account is Inactive. Please contact admin";
                }else{
                    $_SESSION['emplogin']=$_POST['username'];
                    echo "<script type='text/javascript'> document.location = 'myprofile.php'; </script>";
                }
            }else{
                echo "<script>alert('Your Email and Password do not match.');</script>";
            }
        }

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Title -->
        <title>Home Page</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <div class="loader-bg"></div>
        <div class="mn-content fixed-sidebar">
            
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div><h4 style="color: #D34747; margin-left: 330px; font-weight:bold">Leave Management System</h4></div>

                          <div style="width:50%; margin-top:30px; margin:auto;">
                              <div class="card white darken-1">

                                  <div class="card-content ">
                                      <span class="card-title" style="font-size:20px; color: #D34747;">Employee Login</span>
                                         <?php if($msg){?><div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                       <div class="row">
                                           <form class="col s12" name="signin" method="post">
                                               <div class="input-field col s12">
                                                   <input id="username" type="text" name="username" class="validate" autocomplete="off" required >
                                                   <label for="email"> Enter Employee username</label>
                                               </div>
                                               <div class="input-field col s12">
                                                   <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                   <label for="password"> Enter Password</label>
                                               </div>

                                               <div class="field-group" >
                                                   <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> 
                                                    style=" appearance: none; border: none; outline: none;" checked/>
                                                    <label for="remember-me" style="margin-top:40px;">Remember login?</label>
                                                </div>

                                               <div class="col s12 m-t-sm" style=" margin-top: 20px; margin-left:170px;">
                                                   <input type="submit" name="signin" value="Login" class="waves-effect waves-light btn" style="background-color:green ; margin: auto;">
                                               </div>
                                           </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover"></div>

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>

    </body>
</html>
