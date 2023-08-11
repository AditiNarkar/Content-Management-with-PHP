<form action="" method="post">
    <div class="form-group">

        <?php

        if(isset($_GET['edit'])){

            $cat_id = $_GET['edit'];

            $query="SELECT * FROM categories WHERE cat_id = $cat_id";
            $select_a_categories_query = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($select_a_categories_query))
            {
                $update_cat_id = $row['cat_id'];
                $update_cat_title = $row['title'];
            }

        ?>

        <input value="<?php if(isset($update_cat_title)){ echo $update_cat_title; } ?>"class="form-control" type="text" name ="cat_title">
                                
        <?php } 
        //update query
        if(isset($_POST['edit'])){

            $update_cat_title = $_POST['cat_title'];

            $query1 = mysqli_prepare($conn, "UPDATE categories SET title=? WHERE cat_id=?");
            
            mysqli_stmt_bind_param($query1, 'si', $update_cat_title, $update_cat_id);

            mysqli_stmt_execute($query1);

            if(!$query1){ die("error.".mysqli_error($conn));}

            // $query = "UPDATE categories SET title='{$update_cat_title}' WHERE cat_id={$update_cat_id} ";
            // $update_cat_query = mysqli_query($conn,$query);
             
            header("Location:categories.php"); //refreshes page
        }

                                    
        ?>

    </div>
    <div class="form-group">
     <input class="btn btn-primary" type="submit" name ="edit" value="Update category">
     </div>
</form>