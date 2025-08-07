<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';
require_once '../libs/fpdf/fpdf.php';

if (!isset($_GET['id'])) {
    die('Invalid task ID');
}

$task_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ? AND is_deleted = 0");
$stmt->execute([$task_id, $_SESSION['user_id']]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    die('Task not found');
}

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Task Details', 0, 1, 'C');
$pdf->Ln(10);

// Task name
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Name:');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $task['name'], 0, 1);

// Deadline
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Deadline:');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $task['deadline'], 0, 1);

// Status
$status = $task['is_completed'] ? 'Completed' : 'Pending';
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Status:');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $status, 0, 1);

// Description
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Description:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $task['description']);

// Output PDF
$pdf->Output('D', 'task_' . $task['id'] . '.pdf');
exit;
?>
