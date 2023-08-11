<?php include "includes/admin_header.php";?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            <h1 class="page-header"> Hello! Admin <small>Author</small> </h1>

<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Writer</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Response To</th>
            <th>Date</th>
            <th>Status</th>
            <!-- <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th> -->
        </tr>
    </thead>
    <tbody>

    <?php

    $query="SELECT * FROM comments WHERE cmt_post_id =". mysqli_real_escape_string($conn,$_GET['id'])."";
    $select_all_cmts_query = mysqli_query($conn,$query);
    check($select_all_cmts_query);
        while($row = mysqli_fetch_assoc($select_all_cmts_query))
    {
        $cmt_id = $row['cmt_id'];
        $cmt_cont = $row['cmt_content'];
        $cmt_writer = $row['cmt_writer'];
        $cmt_email = $row['cmt_email'];
        $cmt_date = $row['cmt_date'];
        $cmt_post_id = $row['cmt_post_id'];
        $cmt_status = $row['cmt_status'];
        
        echo "<tr>";
        echo "<td>{$cmt_id}</td>";
        echo "<td>{$cmt_writer}</td>";
        echo "<td>{$cmt_cont}</td>";
        echo "<td>{$cmt_email}</td>";

        $query="SELECT * FROM posts WHERE post_id = $cmt_post_id";
        $select_a_cmt_post_query = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($select_a_cmt_post_query))
        {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id=$cmt_post_id'>{$post_title}</a></td>";
        }
    
        echo "<td>{$cmt_date}</td>";
        echo "<td>{$cmt_status}</td>";
    
        echo "<td><a href='post_cmts.php?approve={$cmt_id}&id=". $_GET['id']."'>Approve</a></td>";
        echo "<td><a href='post_cmts.php?unapprove={$cmt_id}&id=". $_GET['id']."'>Unapprove</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Confirm Deletion');\" href='post_cmts.php?delete={$cmt_id}&id=". $_GET['id']."'>Delete</a></td>";
        echo "</tr>";
    }

    ?>

    </tbody>
</table>

<?php

if(isset($_GET['approve'])){
    $a_cmt_id = $_GET['approve'];
    $query = "UPDATE comments SET cmt_status='approved' WHERE cmt_id=$a_cmt_id";
    $approve_query = mysqli_query($conn, $query);
    if(!$approve_query) die(mysqli_error($conn));
    header("Location: comments.php");
}


if(isset($_GET['unapprove'])){
    $u_cmt_id = $_GET['unapprove'];
    $query = "UPDATE comments SET cmt_status='unapproved' WHERE cmt_id=$u_cmt_id";
    $unapprove_query = mysqli_query($conn, $query);
    if(!$unapprove_query) die(mysqli_error($conn));
    header("Location: comments.php");
}

//delete cmt query
if(isset($_GET['delete'])){
    $del_cmt_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE cmt_id={$del_cmt_id}";
    $del_cmt_query = mysqli_query($conn, $query);
    header("Location: post_cmts.php?id=".$_GET['id']."");
}

?>
</div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
  
<?php include "includes/admin_footer.php"; ?>