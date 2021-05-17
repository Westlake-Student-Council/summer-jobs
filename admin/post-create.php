<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
ini_set('log_errors',1);
error_reporting(E_ALL);

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user_loggedin"]) || $_SESSION["user_loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$post_id = "";

require "../classes/PostCreation.php";
$obj = new PostCreation($post_id);

// Define variables and initialize with empty values
$business_name = "";
$position_name = "";
$pay = "";
$min_age = "";
$job_application_link = "";
$indeed_link = "";
$location = "";
$is_visible = "";

$business_name_error = "";
$position_name_error = "";
$pay_error = "";
$min_age_error = "";
$job_application_link_error = ""; 
$indeed_link_error = "";
$location_error = "";
$is_visible_error = "";


// Processing form data when form is submitted
if(isset($_POST["post_id"]) && !empty($_POST["post_id"])){

    // Validate business_name
    $business_name = trim($_POST["business_name"]);
    $business_name_error = $obj->setBusinessName($business_name);

    // Validate position_name
    $position_name = trim($_POST["position_name"]);
    $position_name_error = $obj->setPositionName($position_name);

    // Validate pay 
    $pay = trim($_POST["pay"]);
    $pay_error = $obj->setPay($pay);

    // Validate min_age 
    $min_age = trim($_POST["min_age"]);
    $min_age_error = $obj->setMinAge($min_age);

    // Validate job_application_link 
    $job_application_link = trim($_POST["job_application_link"]);
    $job_application_link_error = $obj->setJobApplicationLink($job_application_link);

    // Validate indeed_link 
    $indeed_link = trim($_POST["indeed_link"]);
    $indeed_link_error = $obj->setIndeedLink($indeed_link);

    // Validate location 
    $location = trim($_POST["location"]);
    $location_error = $obj->setLocation($location);

    // Check is_public
    $is_visible = trim($_POST["is_visible"]);
    $is_visible_error = $obj->setIsVisible($is_visible);

    // Check input errors before inserting in database
    if(empty($business_name_error) 
    && empty($position_name_error) 
    && empty($pay_error) 
    && empty($min_age_error) 
    && empty($job_application_link_error)
    && empty($indeed_link_error) 
    && empty($location_error)
    && empty($is_visible_error) 
    ) {
        if($obj->addPost()) {
            header("location: dashboard.php");
            exit();
        } 
        else {
            echo "Something went wrong. Please try again later.";
        }
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Felix Chen">

    <link rel="icon" type="image/png" href="../assets/images/logo.png">

    <title>Create Post</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
            margin-bottom: 50px;
        }

        main {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <main>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2>Create Post</h2>
                        </div>
                        <p>Please edit the input values and submit to create a post.</p>
                    
                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                            <!--field for business_name-->
                            <div class="form-group <?php echo (!empty($business_name_error)) ? 'has-error' : ''; ?>">
                                <label><b>Business Name</b></label>
                                <input name="business_name" class="form-control" value="<?php echo $business_name; ?>">
                                <span class="help-block"><?php echo $business_name_error;?></span>
                            </div>

                            <!--field for position_name-->
                            <div class="form-group <?php echo (!empty($position_name_error)) ? 'has-error' : ''; ?>">
                                <label><b>Position Name</b></label>
                                <input name="position_name" class="form-control" value="<?php echo $position_name; ?>">
                                <span class="help-block"><?php echo $position_name_error;?></span>
                            </div>

                            <!--field for pay-->
                            <div class="form-group <?php echo (!empty($pay_error)) ? 'has-error' : ''; ?>">
                                <label><b>Pay</b></label>
                                <input type="text" name="pay" class="form-control" value="<?php echo $pay; ?>">                          
                                <span class="help-block"><?php echo $pay_error;?></span>
                            </div>

                            <!--field for min_age-->
                            <div class="form-group <?php echo (!empty($min_age_error)) ? 'has-error' : ''; ?>">
                                <label><b>Min. Age</b></label>
                                <input type="text" name="min_age" class="form-control" value="<?php echo $min_age; ?>">                          
                                <span class="help-block"><?php echo $min_age_error;?></span>
                            </div>

                            <!--field for job_application_link-->
                            <div class="form-group <?php echo (!empty($job_application_link_error)) ? 'has-error' : ''; ?>">
                                <label><b>Job Application Link</b></label>
                                <input type="text" name="job_application_link" class="form-control" value="<?php echo $job_application_link; ?>">                          
                                <span class="help-block"><?php echo $job_application_link_error;?></span>
                            </div>

                            <!--field for indeed_link-->
                            <div class="form-group <?php echo (!empty($indeed_link_error)) ? 'has-error' : ''; ?>">
                                <label><b>Indeed Link</b></label>
                                <input type="text" name="indeed_link" class="form-control" value="<?php echo $indeed_link; ?>">                          
                                <span class="help-block"><?php echo $indeed_link_error;?></span>
                            </div>

                            <!--field for location-->
                            <div class="form-group <?php echo (!empty($location_error)) ? 'has-error' : ''; ?>">
                                <label><b>Location(s)</b></label>
                                <textarea type="text" name="location" class="form-control"><?php echo $location; ?></textarea>                          
                                <span class="help-block"><?php echo $location_error;?></span>
                            </div>

                            <!--field for is_visible-->
                            <div class="form-group <?php echo (!empty($is_visible_error)) ? 'has-error' : ''; ?>">
                                <label for="is_visible"><b>Is this ready to be publically displayed?&nbsp;</b></label>
                                <input type="radio" name="is_visible" value="0" checked > Not yet.&nbsp;&nbsp;
                                <input type="radio" name="is_visible" value="1" > Yes!
                                <span class="help-block"><?php echo $is_visible_error;?></span>
                            </div>

                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>"/>
                            <input type="submit" class="btn btn-primary" value="Update!">
                            <a href="dashboard.php" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- <?php include '../footer.php';?> -->
    </main>

    <!-- Bootstrap Core JavaScript -->
    <!-- ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/libraries/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../assets/libraries/jquery-slim.min.js"><\/script>')</script>
    <script src="../assets/libraries/popper.min.js"></script>
    <script src="../assets/libraries/bootstrap.min.js"></script>

</body>
</html>
