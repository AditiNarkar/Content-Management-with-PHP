<?php

if(isset($_POST['submit'])){
    $post_title = $_POST['title'];
    $post_cat = $_POST['post_cat'];
    $post_user = $_POST['post_user'];
    $post_status = $_POST['status'];

    $post_img = $_FILES['image']['name'];
    $post_img_temp = $_FILES['image']['tmp_name']; //tmp_name is inbuilt

    $post_tags = $_POST['tags'];
    $post_cont = $_POST['cont'];
    $post_date = date('d-m-y');
    $post_cmt_count = 0;

    move_uploaded_file($post_img_temp, "../images/$post_img");

    $query = "INSERT INTO posts(post_cat_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_cmt_count, post_status) VALUES({$post_cat},'{$post_title}','{$post_user}',now(),'{$post_img}','{$post_cont}','{$post_tags}',{$post_cmt_count},'{$post_status}')";

    $insert_posts_query = mysqli_query($conn, $query);

    check($insert_posts_query);

    $edit_post_id=mysqli_insert_id($conn); //this function pulls out last created id on this page

    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$edit_post_id}'>View Post</a> or <a href='./posts.php'>Edit Other Post</a></p>";

}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">
            Title
        </label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_cat">Category</label>
        <select class="form-select" name="post_cat" id="post_cat">
        <?php
            $query="SELECT * FROM categories";
            $select_categories_query = mysqli_query($conn,$query);
            //check($select_a_categories_query);

            while($row = mysqli_fetch_assoc($select_categories_query))
            {
                $cat_id = $row['cat_id'];
                $cat_title = $row['title'];
                echo "<option value='{$cat_id}'> {$cat_title} </option>";
            }    
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_user">Users</label>
        <select class="form-select" name="post_user" id="post_cat">
        <?php
            $query="SELECT * FROM users";
            $select_users_query = mysqli_query($conn,$query);
            //check($select_a_categories_query);

            while($row = mysqli_fetch_assoc($select_users_query))
            {
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo "<option value='{$username}'> {$username} </option>";
            }    
        ?>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="author">
            Author
        </label>
        <input type="text" class="form-control" name="author">
    </div> -->

    <div class="form-group">
        <label for="status">
            Status
        </label>
        <select class="form-select" name="status" id="">
            <option value="published">published</option>
            <option value="draft">draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">
           Image
        </label>
        <input type="file" name="image" accept="image/*">
    </div>

    <div class="form-group">
        <label for="tags">
            Tags
        </label>
        <input type="text" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="summernote">
            Content
        </label>
        <textarea class="form-control" name="cont" id=""></textarea>
    </div>

    <div class="form-group">
        <input class ="btn btn-primary" type="submit" name="submit" value="Publish"> 
    </div>

</form>