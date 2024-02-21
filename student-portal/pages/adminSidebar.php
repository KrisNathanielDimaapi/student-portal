<head>
    <link rel="stylesheet" type="text/css" href="../styles/sidebar.css"/>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var currentLocation = window.location.href;

            var menuLinks = document.querySelectorAll('.menu a');

            menuLinks.forEach(function (link) {
                if (link.href === currentLocation) {
                    link.parentElement.classList.add('active');
                }
            });
        });
    </script>
</head>

<nav>
    <div class="logo">
    <img src="../images/bths_logo.ico">
    <span class="nav-item">Bauan Technical High School<br>Student Portal</span>
    </div>
    <ul class="menu">
        <!-- <li>
            <a href="classes.php">
            <i class="fa-solid fa-people-roof"></i>
                <span>Classes</span>
            </a>
        </li>
        <li>
            <a href="subject.php">
            <i class="fa-solid fa-book"></i>
                <span>Subjects</span>
            </a>
        </li> -->
        <li>
            <a href="student.php">
            <i class="fas fa-clipboard"></i>
                <span>Student Records</span>
            </a>
        </li>
        <li>
            <a href="teacher.php">
            <i class="fa-solid fa-chalkboard-user"></i>
                <span>Teacher Records</span>
            </a>
        </li>
        <li>
            <a href="accountManagement.php">
            <i class="fa-solid fa-address-card"></i>
                <span>Account Management</span>
            </a>
        </li>
        <li class="logout">
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>