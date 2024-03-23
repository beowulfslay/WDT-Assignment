<!-- Navbar -->
<script src="avatar.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
            <img id="logo" alt="Logo" height="50" loading="lazy" src="logo.png"
            <?php if(isset($_SESSION['login'])){echo 'onload="generateAvatar(\'white\', \'#009578\');"';} ?> >
        </a>
        <div class="navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['admin'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="emp.php">Employees</a>
                    </li>
                 <?php } ?>
            </ul>
            <ul class="navbar-nav d-flex flex-row ms-auto me-3 align-items-center">
                <?php if (isset($_SESSION['login'])) { ?>
                    <li class="nav-item me-3 me-lg-0 dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i height="22" class="gg-menu-grid-r"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="add_emp.php">Add employee</a></li>
                        </ul>
                    </li>
                    <li class="nav-item me-3 me-lg-0 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="avatar" alt="Avatar" class="rounded-circle" height="22">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                            <li><a id="signout" class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>

                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            Login
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar -->