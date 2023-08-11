<?php include "includes/admin_header.php";?>


<!-- <script>
    toastr.success('Have fun storming the castle!', 'Viewing Admin as')
</script> -->


<?php
  require '../vendor/autoload.php';

  $options = array(
    'cluster' => 'ap2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '75fb58cd2d49c1a5169d',
    'eb3c1ad94289c23d989c',
    '1246263',
    $options
  );

//   $data['message'] = 'Hello '. $_SESSION['username'];
//   $pusher->trigger('my-channel', 'my-event', $data);
?>

<div id="wrapper">


    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>
    
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> <?php echo $_SESSION['role']; ?> Dashboard
                        
                        <br><small>Admin Id: <?php echo $_SESSION['user_id'];?></small>
                        <small>Admin name: <?php echo $_SESSION['username'];?></small>
                    </h1>

                    <!-- <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol> -->

                    
                </div>
            </div>
            <!-- /.row -->

        <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        
                        <div class='huge'><?php echo $post_count = count_rec('posts'); ?></div>

                        <div>Posts</div>
                        </div>
                    </div>
                </div>
                <a href="./posts.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">

                        <div class='huge'><?php echo $cmt_count = count_rec('comments'); ?></div>     

                        <div>Comments</div>
                        </div>
                    </div>
                </div>
                <a href="comments.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">

                        <div class='huge'><?php echo $user_count = count_rec('users'); ?></div> 

                        <div> Users</div>
                        </div>
                    </div>
                </div>
                <a href="users.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        
                        <div class='huge'><?php echo $cat_count = count_rec('categories'); ?></div> 
                            <div>Categories</div>
                        </div>
                    </div>
                </div>
                <a href="categories.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php

    $draft_post_count = check_condition('posts', 'post_status', 'draft');

    $pub_post_count = check_condition('posts', 'post_status', 'published');

    $unapp_cmt_count = check_condition('comments', 'cmt_status', 'unapproved');

    $sub_count = check_condition('users', 'role', 'Subscriber');
    
    ?>

    <div class="row">
        <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
            
            <?php
            
            $text = ['All Posts','Active Posts','Draft Post', 'Comments','Pending Comments', 'Users','Subscribers', 'Categories'];
            $count = [$post_count, $pub_post_count, $draft_post_count, $cmt_count, $unapp_cmt_count, $user_count, $sub_count, $cat_count];

            for($i=0; $i<8; $i++){
                echo "['{$text[$i]}'" . "," . "{$count[$i]}],";
            }
            
            ?>

            ]);

            var options = {
            title: '',
            is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
        </script>
        <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>