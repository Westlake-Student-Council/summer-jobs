<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
ini_set('log_errors',1);
error_reporting(E_ALL);

require "classes/PostReader.php";
$obj = new PostReader();
$posts = $obj->getVisiblePosts();
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Felix Chen">

    <link rel="icon" type="image/png" href="assets/images/logo.png">

    <title>Summer Jobs</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <main role="main">
        <div class="wrapper">
            <img src="assets/images/logo.png" height="100px" class="mx-auto d-block">
    
            <h1 class="text-center mt-1 mb-3">Summer Jobs</h1>
            <!-- Search Bar -->
            <input class="form-control" id="myInput" type="text" placeholder="Search">
            <br>

            <?php if($posts): ?>
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th scope="col">Business Name</th>
                        <th scope="col">Position Name</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>

                <tbody id = "myTable">
                    <?php 
                    $cardCount = 0;
                    foreach ($posts as $post):
                        $cardCount++;
                    ?>
                    <tr class="text-center">
                        <td><?php echo $post["business_name"]; ?></td>
                        <td><?php echo $post["position_name"]; ?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $cardCount; ?>">More info</button>
                        
                            <!-- Modal -->
                            <div class="modal fade" id="modal<?php echo $cardCount; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $cardCount; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel<?php echo $cardCount; ?>">
                                                <?php echo $post["business_name"]; ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p><b>Pay: </b><br><?php echo  $post["pay"]; ?></p>
                                            <!-- <br> -->
                                            <p><b>Minimum Age: </b><br><?php echo $post["min_age"]; ?></p> 
                                            <p>
                                                <b>Location(s):</b>
                                                <br>
                                                <?php echo $post["location"]; ?>
                                            </p>
                                            <br>
                                            <div class="row px-2">
                                                <?php if($post["job_application_link"]):?>
                                                <a class="col btn btn-success mx-1" href="<?php echo $post["job_application_link"] ?>" target="_blank">Application Link</a>
                                                <?php endif; ?>

                                                <?php if($post["indeed_link"]):?>
                                                <a class="col btn btn-primary mx-1" href="<?php echo $post["indeed_link"] ?>" target="_blank">Indeed Link</a>
                                                <?php endif; ?>
                                            </div>
                                             
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>There are no summer job postings at the moment. Come back soon!</p>
            <?php endif; ?>

        </div>

    </main>

    <script>
    $(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <!-- ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/libraries/jquery-3.2.1.slim.min.js"></script>
    <!-- <script>window.jQuery || document.write('<script src="assets/libraries/jquery-3.2.1.slim.min.js"><\/script>')</script> -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>