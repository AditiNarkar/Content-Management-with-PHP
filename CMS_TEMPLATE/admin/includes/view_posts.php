<?php

include ("delete_modal.php");
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $value){
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options){
            case 'published': 
                $query="UPDATE posts SET post_status='published' WHERE post_id={$value}";
                $pub_status = mysqli_query($conn, $query);
                break;
            
            case 'draft':
                $query="UPDATE posts SET post_status='draft' WHERE post_id={$value}";
                $draft_status = mysqli_query($conn, $query);
                break;
            case 'delete': 
                $query="DELETE FROM posts WHERE post_id={$value}";
                $draft_status = mysqli_query($conn, $query);
                break;
            
            case 'clone': 
                $query="SELECT * FROM posts WHERE post_id={$value}";
                $select_post_query = mysqli_query($conn,$query);
                check($select_post_query);
                while($row = mysqli_fetch_assoc($select_post_query))
                {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_category = $row['post_cat_id'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_cmt_count = $row['post_cmt_count'];
                    $post_status = $row['post_status'];

                    if(empty($post_tags))
                    {
                        $post_tags = "NA";
                    }
                }
                $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_cmt_count, post_status) VALUES({$post_category},'{$post_title}','{$post_author}', '{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}',{$post_cmt_count},'{$post_status}')";

                $clone_post_query = mysqli_query($conn, $query);

                check($clone_post_query);
                break;

        }
    }
}
?>

<form action="" method="post">

<table class="table table-bordered table-hover table-striped">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="clo-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post"> Add New </a>
    </div>

    <thead>
        <tr>
            <th><input type="checkbox" id="select"></th>
            <th>ID</th>
            <th>Title</th>
            <th>User</th>
            <th>Category</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comment Count</th>
            <th>Date</th>
            <th>Status</th>
            <th>Views</th>
        </tr>
    </thead>
    <tbody>

    <?php

   // $query="SELECT * FROM posts ORDER BY post_id DESC";

   $user = current_user();

    $query="SELECT posts.post_id, posts.post_title, posts.post_author,  posts.post_user, posts.post_cat_id, posts.post_date, posts.post_image, posts.post_content, posts.post_tags, posts.post_status,  posts.views, posts.post_cmt_count, categories.cat_id, categories.title FROM posts LEFT JOIN categories ON posts.post_cat_id = categories.cat_id WHERE post_user = '$user' ORDER BY post_id DESC";

    $select_all_posts_query = mysqli_query($conn,$query);
    check($select_all_posts_query);
        while($row = mysqli_fetch_assoc($select_all_posts_query))
    {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_category = $row['post_cat_id'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_cmt_count = $row['post_cmt_count'];
        $post_status = $row['post_status'];
        $views = $row['views'];
        $cat_id = $row['cat_id'];
        $cat_title = $row['title'];
        
        echo "<tr>";
        ?>
        
        <td><input class='checkBoxes' type='checkbox' id='select' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
        
        <?php
        echo "<td>{$post_id}</td>";

        
        echo "<td>{$post_title}</td>";

        if(!empty($post_user)) 
        {
            echo "<td>{$post_user}</td>";
        }
        elseif(!empty($post_author))
        {
            echo "<td>{$post_author}</td>";
        }

        // $query="SELECT * FROM categories WHERE cat_id = $post_category";
        // $select_a_categories_query = mysqli_query($conn,$query);
        // while($row = mysqli_fetch_assoc($select_a_categories_query))
        // {
        //     $cat_id = $row['cat_id'];
        //     $cat_title = $row['title'];
             echo "<td>{$cat_title} - {$cat_id}</td>";
        // }

        $post_img = image_placeholder($post_image);
    
        echo "<td><img width=200 src='../images/{$post_img}' alt='N.A.'></td>";
        
        echo "<td>{$post_tags}</td>";

        $query = "SELECT * FROM comments WHERE cmt_post_id = $post_id";
        $cmt_count_query = mysqli_query($conn, $query);

        $row = mysqli_fetch_array($cmt_count_query);
        //$cmt_id = $row['cmt_id'];
        $post_cmt_count = mysqli_num_rows($cmt_count_query);

        echo "<td><a href='post_cmts.php?id=$post_id'>{$post_cmt_count}</a></td>";

        echo "<td>{$post_date}</td>";
        echo "<td>{$post_status}</td>";

        echo "<td><a href='posts.php?reset_id=$post_id'>{$views}</a></td>";
        
    
        echo "<td><a class = 'btn btn-primary' href='../post.php?p_id=$post_id'>View Post</a></td>";
        echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&edit_id={$post_id}'>Edit</a></td>";

        // echo "<td><a onClick=\"javascript: return confirm('Confirm Deletion');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
        ?>

        <form method = "post">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

            <?php
           echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete' ></td>";
            ?>

        </form>

        <?php

        // echo "<td><a rel='$post_id' href='javascript:void(0)' class='del_link'>Delete</a></td>";
        
        echo "</tr>";
    }

    ?>

    </tbody>
</table>
</form>

<?php
//delete post query
if(isset($_POST['delete']))
{
    $del_post_id = $_POST['post_id'];
    $query = "DELETE FROM posts WHERE post_id={$del_post_id}";
    $del_post_query = mysqli_query($conn, $query);
    header("Location: posts.php");
}

if(isset($_GET['reset_id']))
{
    $views_post_id = $_GET['reset_id'];
    $query = "UPDATE posts SET views = 0 WHERE post_id =".mysqli_real_escape_string($conn,$_GET['reset_id'])."";
    $views_post_query = mysqli_query($conn, $query);
    //if(!$views_post_query) die(mysqli_error($conn));
    header("Location: posts.php");
}

?>

<script>
    $(document).ready(function()
    {
        $(".del_link").on('click', function()
        {
            var id = $(this).attr("rel");
            var del_url = "'posts.php?delete="+ id +"";

            $(".delete_modal_link").attr("href",del_url);

            $("#exampleModalCenter").modal('show');
            
        });
    });
</script>