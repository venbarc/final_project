<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="index.php">Dashboard</a> |
                <a class="opacity-5 text-dark" href="class.php">Class</a> |
                <a class="opacity-5 text-dark" href="create_users.php">Create User</a> |
                <a class="opacity-5 text-dark" href="concerns.php">User Concerns</a> |
                <a class="opacity-5 text-dark" href="question_bank.php">Question Bank</a> |
                <a class="opacity-5 text-dark" href="login_user.php">Login As User</a> |
                <a class="opacity-5 text-danger" href="logout.php">Logout</a> 
            </li>
        </ol>
        <h6 class="font-weight-bolder mb-0">
            <?php
                if(basename($_SERVER['PHP_SELF']) === 'index.php') {
                    echo "<h2>Dashboard</h2>";
                }
                else
                if(basename($_SERVER['PHP_SELF']) === 'create_users.php') {
                    echo "<h2>Create Users</h2>";
                }
                else
                if(basename($_SERVER['PHP_SELF']) === 'concerns.php') {
                    echo "<h2>User Concerns</h2>";
                }
                else
                if(basename($_SERVER['PHP_SELF']) === 'class.php') {
                    echo "<h2>Class</h2>";
                }
                else
                if(basename($_SERVER['PHP_SELF']) === 'edit_user.php') {
                    echo "<h2>Edit User</h2>";
                }
                else
                if(basename($_SERVER['PHP_SELF']) === 'question_bank.php') {
                    echo "<h2>Question Bank</h2>";
                }
            ?>
        </h6>
    </nav>
    </div>
</nav>
<!-- End Navbar -->