<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';
require_once '../vendor/fpdf/fpdf.php'; // Ensure FPDF is installed in this path

// Fetch tasks
$stmt = $pdo->prepare("SELECT name, description, deadline, priority, is_completed FROM tasks WHERE user_id = ? AND is_deleted = 0 ORDER BY deadline ASC");
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,'Task List Export',0,1,'C');
        $this->Ln(5);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Create PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

// Table header
$pdf->Cell(40,10,'Task Name',1);
$pdf->Cell(80,10,'Description',1);
$pdf->Cell(30,10,'Deadline',1);
$pdf->Cell(20,10,'Priority',1);
$pdf->Cell(20,10,'Status',1);
$pdf->Ln();

// Table content
$pdf->SetFont('Arial','',11);
foreach ($tasks as $task) {
    $status = $task['is_completed'] ? 'Completed' : 'Pending';
    $desc = strip_tags($task['description']);
    $desc = substr($desc, 0, 70) . (strlen($desc) > 70 ? '...' : '');

    $pdf->Cell(40,10,$task['name'],1);
    $pdf->Cell(80,10,$desc,1);
    $pdf->Cell(30,10,$task['deadline'],1);
    $pdf->Cell(20,10,$task['priority'],1);
    $pdf->Cell(20,10,$status,1);
    $pdf->Ln();
}

$pdf->Output('D', 'tasks_export_' . date('Y-m-d') . '.pdf');
exit;
?>
