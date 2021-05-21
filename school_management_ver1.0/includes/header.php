<!-- Navbar -->
<nav
	class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
	<div class="container-fluid">
		<div class="navbar-wrapper" id="div-img">
			<a class="navbar-brand" href="process.php" id="welcome">Welcome
                <?php
                if (isset($_SESSION['username'])) {
                    $selectUser = selectElementFrom("users", "*", "username = '$_SESSION[username]'");
                    $user = $selectUser->fetch_assoc();
                    if (isset($user['representName'])){
                        echo "$user[representName]!";
                    } else {
                        echo "$user[username]!";
                    }

                    if (isset($user['img-personal'])) {
                        $srcImg = $user['img-personal'];
                        echo "<img src='$srcImg' id='img-user'/>";
                    } else {
                        $srcImg = "";
                    }
                } else {
                    $_SESSION['permission'] = false;
                }
                ?>
            </a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			aria-controls="navigation-index" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="sr-only">Toggle navigation</span> <span
				class="navbar-toggler-icon icon-bar"></span> <span
				class="navbar-toggler-icon icon-bar"></span> <span
				class="navbar-toggler-icon icon-bar"></span>
		</button>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;">
                        <i class="material-icons">notifications</i> Notifications
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php">
                        <button type="button" name="logout" class="btn btn-primary">
                            <i class="material-icons">logout</i> Logout
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
