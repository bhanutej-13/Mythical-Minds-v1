<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set spreadsheet headers
    $sheet->setCellValue('A1', 'Full Name');
    $sheet->setCellValue('B1', 'Username');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'Password');
    $sheet->setCellValue('E1', 'Confirm Password');

    // Add data to the spreadsheet
    $sheet->setCellValue('A2', $name);
    $sheet->setCellValue('B2', $username);
    $sheet->setCellValue('C2', $email);
    $sheet->setCellValue('D2', $password);
    $sheet->setCellValue('E2', $confirmPassword);

    // Create a writer and save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'signups.xlsx';

    // Save the file
    if (file_exists($fileName)) {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileName);
        $sheet = $spreadsheet->getActiveSheet();
        $lastRow = $sheet->getHighestRow();
        $sheet->setCellValue('A' . ($lastRow + 1), $name);
        $sheet->setCellValue('B' . ($lastRow + 1), $username);
        $sheet->setCellValue('C' . ($lastRow + 1), $email);
        $sheet->setCellValue('D' . ($lastRow + 1), $password);
        $sheet->setCellValue('E' . ($lastRow + 1), $confirmPassword);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    }

    $writer->save($fileName);

    echo "Signup data saved successfully!";
}
?>
