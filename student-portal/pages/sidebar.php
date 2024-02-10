<head>
    <link rel="stylesheet" type="text/css" href="../styles/sidebar.css"/>
    <?php include("../pages/header.php");?>
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
        </li>
        <li>
            <a href="reviews.php">
            <i class="fa-solid fa-file-medical"></i>
                <span>Review of Teaching Subjects</span>
            </a>
        </li>
        <li>
            <a href="subjectStudent.php">
            <i class="fa-solid fa-book"></i>
                <span>Subjects</span>
            </a>
        </li>
        <li>
            <a href="requestForm.php">
                <i class="fas fa-clipboard"></i>
                <span>Request Forms</span>
            </a>
        </li>
        <li>
            <a href="result.php">
            <i class="fa-solid fa-square-poll-vertical"></i>
                <span>View Grades</span>
            </a>
        </li>
        <li>
            <a href="teacherContact.php">
            <i class="fa-solid fa-address-book"></i>
                <span>Teacher's Contact</span>
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
