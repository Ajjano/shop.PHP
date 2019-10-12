<?php
include_once 'classes.php';
$user='';
if(isset($_POST['login_btn'])){
    if(($row=Tools::login($_POST['login'], $_POST['password']))!=false){
        $user=$row['login'];
        if($row['role_id']=='1')
            $_SESSION["login"]="admin";
        else if($row['role_id']=='2')
            $_SESSION["login"]="user";
    }
}
if(isset($_POST['logout_btn'])){
    session_unset();
    session_destroy();
}
?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php?page=1">Shop</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php $page=$_GET['page']?$_GET['page']:1?>
                        <li <?=($page==1)? 'class="active"':''?>>
                            <a href="index.php?page=1">Catalog</a>
                        </li>
                        <li <?=$page==2? 'class="active"':''?>>
                            <a href="index.php?page=2">Cart</a>
                        </li>
                        <li <?=$page==3? 'class="active"':''?>>
                            <a href="index.php?page=3">Registration</a>
                        </li>
                        <li <?=$page==4? 'class="active"':''?>>
                        <?php if(isset($_SESSION['login'])&&$_SESSION['login']=='admin'):?>
                            <a href="index.php?page=4">Admin</a>
                            <?php else:?>
                            <a href="index.php?page=4" style="pointer-events: none">Admin</a>
                            <?php endif;?>
                        </li>
                        <li <?=$page==5? 'class="active"':''?>>
                            <a href="index.php?page=5">Reports</a>
                        </li>

                        <li>
                            <?php if(!isset($_SESSION['login'])):?>
                            <form method="post" class="navbar-form navbar-left">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="login" placeholder="Login">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <button type="submit" name="login_btn" class="btn btn-warning">Log in</button>
                            </form>
                            <?php else:?>
                                <form method="post" class="navbar-form navbar-left">
                                    <span style="color: gray;"><?=$user?></span>
                                    <button type="submit" name="logout_btn" class="btn btn-warning">Log out</button>
                                </form>
                            <?php endif;?>
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</nav>