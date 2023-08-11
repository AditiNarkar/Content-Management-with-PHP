<?php
if(isset($_GET['edit_id'])){
    $edit_post_id = $_GET['edit_id'];

    $query="SELECT * FROM posts WHERE post_id = $edit_post_id";
    $select_a_post_query = mysqli_query($conn,$query);
    check($select_a_post_query);

    while($row = mysqli_fetch_assoc($select_a_post_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_user = $row['post_user'];
        $post_category = $row['post_cat_id'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_cmt_count = $row['post_cmt_count'];
        $post_status = $row['post_status'];
    }
}

if(isset($_POST['update'])){
    $post_title = $_POST['title'];
    $post_user = $_POST['user'];
    $post_category = $_POST['post_cat'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_content = $_POST['cont'];
    $post_tags = $_POST['tags'];
    $post_status = $_POST['status'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $query="SELECT * FROM posts WHERE post_id = $edit_post_id";
        $select_img = mysqli_query($conn, $query);
        while($r = mysqli_fetch_assoc($select_img)){
            $post_image = $r['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_cat_id = '{$post_category}', ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_date = now(), ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_status = '{$post_status}' ";
    $query .= "WHERE post_id = {$edit_post_id} ";

    // $query = "UPDATE posts SET post_cat_id = '{$post_category}',post_title = '{$post_title}',post_author = '{$post_author}',post_date = now(), ";
    // $query .= "post_image = '{$post_image}',post_content = '{$post_content}',post_tags = '{$post_tags}',post_status = '{$post_status}' WHERE post_id = {$edit_post_id} ";

    $update_post_query = mysqli_query($conn, $query);
    if(!$update_post_query){ die("failed".mysqli_error($conn)); }
    echo "<p class='bg-success'>Post Updated. <a href='../my_post.php?p_id={$edit_post_id}'>View Post</a> or <a href='./my_posts.php'>Edit Other Post</a></p>";

}

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">
            Title
        </label>
        <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_cat">Category</label>
        <select class="form-control" name="post_cat" id="post_cat">
        
        <?php
            $query="SELECT * FROM categories";
            $select_categories_query = mysqli_query($conn,$query);
            //check($select_a_categories_query);

            while($row = mysqli_fetch_assoc($select_categories_query))
            {
                $cat_id = $row['cat_id'];
                $cat_title = $row['title'];
                //echo "<option value='{$cat_id}'> {$cat_title} </option>";

                if($cat_id == $post_category)
                {
                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                }
                else
                {
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
            
        ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_user">Users</label>
        <select class="form-select" name="user" id="post_cat">
        
        <?php
            $query="SELECT * FROM users";
            $select_users_query = mysqli_query($conn,$query);
            //check($select_a_categories_query);

            while($row = mysqli_fetch_assoc($select_users_query))
            {
                $user_id = $row['user_id'];
                $username = $row['username'];
                //echo "<option value='{$username}'> {$username} </option>";

                if($username == $post_user)
                {
                    echo "<option selected value='{$username}'>{$username}</option>";
                }
                else
                {
                    echo "<option value='{$username}'>{$username}</option>";
                }
                
            }    
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="status">
            Status
        </label>
        <select class="form-control" name="status" id="">
            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php
            if($post_status == 'published'){
                echo "<option value='draft'>draft</option>";
            }
            else {
                echo "<option value='published'>published</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <img width=200 src="../images/<?php echo $post_image; ?>"> <input type="file" name="image">
    </div>
    <?php echo $post_image; ?>

    <div class="form-group">
        <label for="tags">
            Tags
        </label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="cont">
            Content
        </label>
        <textarea class="form-control" name="cont" id=""><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class ="btn btn-primary" type="submit" name="update" value="Update"> 
    </div>

</form>