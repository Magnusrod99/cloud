<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<style>
/* Sidebar styling */
.sidebar {
    width: 220px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    background: linear-gradient(180deg, #000000ff, #101010ff);
    color: white;
    padding: 20px 0;
    transition: all 0.3s;
    z-index: 1000;
}

.sidebar h4 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
    color: #fff;
}

.sidebar .nav-link {
    color: white;
    padding: 12px 20px;
    margin: 5px 10px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    transition: 0.3s;
    font-weight: 500;
}

.sidebar .nav-link i {
    margin-right: 10px;
}

.sidebar .nav-link:hover {
    background: rgba(255,255,255,0.2);
    color: #fff;
    text-decoration: none;
    transform: scale(1.03);
}
</style>

<div class="sidebar">
    <a href="index.php"><h4>CampusVoice</h4></a>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a class="nav-link" href="index.php"><i class="bi bi-house-door-fill"></i> Home</a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link" href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
        </li>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <!-- Show register only if NOT logged in -->
            <li class="nav-item mb-2">
                <a class="nav-link" href="register.php"><i class="bi bi-pencil-square"></i> Register</a>
            </li>
        <?php endif; ?>

        <li class="nav-item mb-2">
            <a class="nav-link" href="complaints.php"><i class="bi bi-file-earmark-text-fill"></i> Complaints</a>
        </li>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Show logout only if logged in -->
            <li class="nav-item mb-2">
                <a class="nav-link" href="logout.php" onclick="return confirmLogout()">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        <?php else: ?>
            <!-- Show login if not logged in -->
            <li class="nav-item mb-2">
                <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            </li>
        <?php endif; ?>
    </ul>
</div>

<script>
function confirmLogout() {
    return confirm("⚠️ Are you sure you want to logout?");
}
</script>

<!-- Include Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
