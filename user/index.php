<?php include "includes/user_header.php";?>
    <div id="wrapper">



        <!-- Navigation -->
 
        <?php include "includes/user_navigation.php" ?>
        
   
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                       
                        <h1 class="page-header">
                            Welcome to User                     
                            
                            <small> <?php 
                            if(isset($_SESSION['username'])) {
                                $user_username = $_SESSION['username'];
                            echo $_SESSION['username'];}?></small>
                        </h1>


     
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
                      
                      <?php 

                        $query = "SELECT * FROM posts WHERE post_user='{$user_username}'";
                        $select_all_user_post = mysqli_query($connection,$query);
                        $post_count = mysqli_num_rows($select_all_user_post);

                      echo  "<div class='huge'>{$post_count}</div>"

                        ?>


                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
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

                                      <?php 

                                    $query = "SELECT * FROM comments WHERE comment_author='{$user_username}'";
                                    $select_all_user_comments = mysqli_query($connection,$query);
                                    $comment_count = mysqli_num_rows( $select_all_user_comments);

                                  echo  "<div class='huge'>{$comment_count}</div>"

                                    ?>

           
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
                    </div>
                
                <!-- /.row -->
                
                
    <?php 

 $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_user='{$user_username}'";
$select_all_published_posts = mysqli_query($connection,$query);
$post_published_count = mysqli_num_rows($select_all_published_posts);
                                     
                                      
$query = "SELECT * FROM posts WHERE post_status = 'draft' AND post_user='{$user_username}'";
$select_all_draft_posts = mysqli_query($connection,$query);
$post_draft_count = mysqli_num_rows($select_all_draft_posts);


$query = "SELECT * FROM comments WHERE comment_status = 'unapproved' AND comment_author='{$user_username}'";
$unapproved_comments_query = mysqli_query($connection,$query);
$unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);

$query = "SELECT * FROM comments WHERE comment_status = 'approved' AND comment_author='{$user_username}'";
$approved_comments_query = mysqli_query($connection,$query);
$approved_comment_count = mysqli_num_rows($approved_comments_query);
    ?>
                
                <div class="row">
                    
                    <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
            <?php
                                      
    $element_text = ['My Posts','Active Posts','Draft Posts', 'My Comments', 'Approved Comments','Pending Comments'];
    $size_element_text = sizeof($element_text);
    $element_count = [$post_count,$post_published_count, $post_draft_count, $comment_count,$approved_comment_count,$unapproved_comment_count];


    for($i =0;$i < $size_element_text; $i++) {
    
        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
     
    
    
    }
                                                            
            ?>
               
     
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
                   
                   
  <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    
                    
                    
                    
                    
                </div>

  

            </div>
            <!-- /.container-fluid -->

        </div>
        
    
        <!-- /#page-wrapper -->
        
    <?php include "includes/user_footer.php" ?>
