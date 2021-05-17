<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
ini_set('log_errors',1);
error_reporting(E_ALL);

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user_loggedin"]) || $_SESSION["user_loggedin"] !== true){
    header("location: login.php");
    exit;
}

require '../classes/PostReader.php';
$obj = new PostReader();
$posts = $obj->getPosts();
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Felix Chen">

    <link rel="icon" type="image/png" href="../assets/images/logo.png">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        main {
            margin-top: 100px;
            margin-left: 50px;
            margin-right: 50px;
        }

        .wrapper{
            margin: 0 auto;
        }

        .page-header h2{
            margin-top: 0;
        }

        td {
            text-align:center;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Summer Jobs</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                </ul> 

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main role="main">
        <div class="wrapper">
            <a href="post-create.php" class="btn btn-success mb-4">Create Post</a>

            <?php if($posts): ?>
                <table class='table table-bordered' id='posts'>
                    <thead class="text-center">
                        <tr>
                            <th>Business Name</th>
                            <th>Position Name</th>
                            <th>Min. Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                        <tr style="background-color:<?php if($post['is_visible']) echo "#97f50a"; ?>" >
                            <td>
                              <?php echo $post['business_name']; ?>
                            </td>
                            <td>
                                <?php echo $post['position_name']; ?>
                            </td>
                            <td>
                                <?php echo $post['min_age']; ?>
                            </td>
                            <td>
                                <a href=<?php echo "post-update.php?post_id=".$post['post_id']; ?> title='Update Q&A' class='btn btn-primary'>Update</a>
                                <a href=<?php echo "post-delete.php?post_id=".$post['post_id']; ?> title='Delete Q&A' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>There are no posts at the moment.</p>
            <?php endif; ?>

            <br>

            <p>Rows highlighted in <mark style="background-color: #97f50a;"><b>green</b></mark> are currently displayed on the <a href="../index.php" target="_blank">main page</a> of the main site.</p>

        </div>
        
        <!-- /.container -->


        <!-- FOOTER -->
        <footer class="container">
            <!-- <p>© 2021 Felix Chen</p> -->
        </footer>
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