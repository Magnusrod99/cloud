<?php
session_start();
require_once "db.php";
require_once "sidebar.php";

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Complaint options
$complaint_options = [
    "Classroom Issue", "Hostel Issue", "Fees Issue", "Library Issue",
    "Faculty Complaint", "Admin Complaint",
    "Sports Facility", "Labs Issue", "Internet/WiFi Issue",
    "Exam/Result Issue", "Others"
];

// Handle complaint submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO complaints (user_id, title, description, status) VALUES (?, ?, ?, 'Submitted')");
    $stmt->bind_param("iss", $user_id, $title, $description);
    $stmt->execute();
    $stmt->close();

    // Redirect to prevent resubmission on refresh
    header("Location: complaints.php");
    exit;
}

// Fetch user's complaints
$result = $conn->query("SELECT * FROM complaints WHERE user_id=$user_id ORDER BY created_at DESC");
$complaints_exist = $result->num_rows > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Complaints - CampusVoice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: #f5f5f5;
    padding-left: 240px; /* space for sidebar */
}
.container-main {
    max-width: 800px;
    margin: 50px auto;
}
.card-complaint {
    background: white;
    border-radius: 10px;
    margin-bottom: 20px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.progress {
    height: 12px;
    border-radius: 6px;
}
.progress-bar-submitted { background-color: #6c757d; }
.progress-bar-inprogress { background-color: #ffc107; }
.progress-bar-resolved { background-color: #28a745; }
.text-center-note { text-align:center; color: #888; margin-top:20px; }
.legend {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}
.legend span {
    display: flex;
    align-items: center;
    gap: 5px;
}
.legend .dot {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    display: inline-block;
}
.dot-submitted { background-color: #6c757d; }
.dot-inprogress { background-color: #ffc107; }
.dot-resolved { background-color: #28a745; }
</style>
</head>
<body>

<div class="container-main">
    <h2 class="text-center mb-4">📝 Submit a Complaint</h2>
    <div class="card p-4 mb-5">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Select Complaint Type</label>
                <select class="form-select" name="title" required>
                    <option value="">--Select--</option>
                    <?php foreach($complaint_options as $opt): ?>
                        <option value="<?= htmlspecialchars($opt); ?>"><?= htmlspecialchars($opt); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Your Complaint (Optional description)</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Describe your issue (optional)"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Complaint</button>
        </form>
    </div>

    <h3 class="mb-3 text-center text-secondary">📝 Your Complaints</h3>

    <!-- Progress Legend -->
    <div class="legend">
        <span><div class="dot dot-submitted"></div> Submitted</span>
        <span><div class="dot dot-inprogress"></div> In Progress</span>
        <span><div class="dot dot-resolved"></div> Resolved</span>
    </div>

    <?php if($complaints_exist): ?>
        <?php while($complaint = $result->fetch_assoc()):
            $status = $complaint['status'];
            $progress = ($status == 'Submitted') ? 33 : (($status == 'In Progress') ? 66 : 100);
        ?>
        <div class="card-complaint">
            <div class="d-flex justify-content-between mb-2">
                <h5><?= htmlspecialchars($complaint['title']); ?></h5>
                <span class="badge 
                    <?= $status=='Submitted'?'bg-secondary':($status=='In Progress'?'bg-warning text-dark':'bg-success'); ?>">
                    <?= $status; ?>
                </span>
            </div>
            <?php if(!empty($complaint['description'])): ?>
                <p><?= htmlspecialchars($complaint['description']); ?></p>
            <?php endif; ?>
            <small class="text-muted">Submitted on: <?= $complaint['created_at']; ?></small>
            <div class="progress mt-2">
                <div class="progress-bar <?= $status=='Submitted'?'progress-bar-submitted':($status=='In Progress'?'progress-bar-inprogress':'progress-bar-resolved'); ?>" 
                    role="progressbar" style="width: <?= $progress ?>%;" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center-note">You have not submitted any complaints yet.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
