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
                    <a class="navbar-brand" href="index.php?page=1">Sky Shop</a>
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
                            <a href="index.php?page=4">Admin</a>
                        </li>
                        <li <?=$page==5? 'class="active"':''?>>
                            <a href="index.php?page=5">Reports</a>
                        </li>
                        <li>
                            <form class="navbar-form navbar-left">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Login">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </form>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</nav>