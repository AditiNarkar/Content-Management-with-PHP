<?php

if(isMethod('post'))
{
    if(isset($_POST['login']))
    {
        if(isset($_POST['username']) && isset($_POST['pwd']))
            login($_POST['username'], $_POST['pwd']);
        
        else
            redirect("index");
    }
}


?>

<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search_input.php" method="post">
            <div class="input-group">
                <input name="search_input" type="text" class="form-control">
                <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <div class="well">
        
    <?php if(isset($_SESSION['role'])): ?>
        <h4>Hello <?php echo $_SESSION['username']; ?> </h4>
        <h4>Logged in as <?php echo $_SESSION['role']; ?> </h4>

        <a href="includes/logout.php" class="btn btn-primary">Log Out</a>
    
    <?php else: ?>

        <h4>Log In </h4>
        <form method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input name="pwd" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">
                        Log In 
                    </button>
                </span>
            </div>

            <div class="form-group">
                <a href="forgot_pwd.php?forgot=<?php echo uniqid(true); ?>">Forgot Password? </a>
            </div>
            
        </form>
        <!-- /.input-group -->

    <?php endif; ?>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                
                <?php

                $query="SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($select_all_categories_query))
                {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['title'];
                    echo "<li><a href='../category/$cat_id'>{$cat_title}</a></li>";
                }
                ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <!-- <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div> -->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php //include "widget.php"; ?>

</div>