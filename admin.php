<?php
require_once "db.php";

// Fetch all complaints with user info
$complaints = $conn->query("
    SELECT c.id, u.name AS student_name, u.department, c.title, c.description, c.status, c.created_at
    FROM complaints c
    JOIN users u ON c.user_id = u.id
    ORDER BY c.created_at DESC
");

// Handle status update
if (isset($_POST['update_status'])) {
    $complaint_id = $_POST['complaint_id'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE complaints SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $complaint_id);
    $stmt->execute();
    header("Location: admin.php"); // refresh page to show updated status
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - CampusVoice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f0f2f5; }
.container { margin-top: 40px; }
.card { border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
.table th, .table td { vertical-align: middle; }
.status-select { width: 150px; }
</style>
</head>
<body>
<div class="container">
    <h2 class="mb-4 text-center">Admin Dashboard - Manage Complaints</h2>
    <div class="card p-4">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Department</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if($complaints->num_rows > 0): ?>
                    <?php while($row = $complaints->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <span class="badge 
                                    <?php 
                                        echo $row['status'] == 'Pending' ? 'bg-warning' : 
                                             ($row['status'] == 'In Progress' ? 'bg-info' : 'bg-success'); 
                                    ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="complaint_id" value="<?php echo $row['id']; ?>">
                                    <select name="status" class="form-select status-select mb-2">
                                        <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                                        <option value="In Progress" <?php if($row['status']=='In Progress') echo 'selected'; ?>>In Progress</option>
                                        <option value="Resolved" <?php if($row['status']=='Resolved') echo 'selected'; ?>>Resolved</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-primary btn-sm w-100">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No complaints submitted yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
