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
        <li>
            <a href="reviews.php">
            <i class="fa-solid fa-file-medical"></i>
                <span>Review of Teaching Subjects</span>
            </a>
        </li>
        <li>
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
        </li>
        <li>
            <a href="student.php">
            <i class="fas fa-clipboard"></i>
                <span>Student Record</span>
            </a>
        </li>
        <li>
            <a href="result.php">
            <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Results</span>
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