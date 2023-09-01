<?php
include 'config.php'; // Siguruhing kasama ang database configuration

if (isset($_POST['cutoffID']) && isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $cutoffID = $_POST['cutoffID'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $Getprb = "SELECT payslip_report_tb.id,
    payslip_report_tb.cutoff_ID,
    payslip_report_tb.pay_rule,
    payslip_report_tb.empid,
    payslip_report_tb.col_frequency,
    payslip_report_tb.cutoff_startdate, 
    payslip_report_tb.cutoff_enddate, 
    payslip_report_tb.working_days, 
    payslip_report_tb.basic_hours, 
    payslip_report_tb.basic_amount_pay, 
    payslip_report_tb.overtime_hours, 
    payslip_report_tb.overtime_amount, 
    payslip_report_tb.transpo_allow, 
    payslip_report_tb.meal_allow, 
    payslip_report_tb.net_allowance, 
    payslip_report_tb.add_allow, 
    payslip_report_tb.allowances, 
    payslip_report_tb.number_leave, 
    payslip_report_tb.paid_leaves, 
    payslip_report_tb.holiday_pay, 
    payslip_report_tb.total_earnings, 
    payslip_report_tb.absence, 
    payslip_report_tb.absence_deduction, 
    payslip_report_tb.sss_contri, 
    payslip_report_tb.philhealth_contri, 
    payslip_report_tb.tin_contri, 
    payslip_report_tb.pagibig_contri, 
    payslip_report_tb.other_contri, 
    payslip_report_tb.total_late, 
    payslip_report_tb.tardiness_deduct, 
    payslip_report_tb.ut_time, 
    payslip_report_tb.undertime_deduct, 
    payslip_report_tb.number_lwop, 
    payslip_report_tb.lwop_deduct, 
    payslip_report_tb.total_deduction, 
    payslip_report_tb.net_pay,
    payslip_report_tb.date_time,
    employee_tb.empid,
    CONCAT(employee_tb.fname, ' ', employee_tb.lname) AS full_name FROM payslip_report_tb INNER JOIN
    employee_tb ON employee_tb.empid = payslip_report_tb.empid WHERE cutoff_ID = '$cutoffID' AND cutoff_startdate = '$startDate' AND cutoff_enddate = '$endDate'";
    $query_run = mysqli_query($conn, $Getprb);

    while ($row = mysqli_fetch_assoc($query_run)) {
        echo '<div class="table-responsive" style="width: 320%">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pay Rule</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Total Days</th>
                        <th>Total Hours</th>
                        <th>Overtime Hours</th>
                        <th>Overtime Pay</th>
                        <th>Transport</th>
                        <th>Meal</th>
                        <th>Internet</th>
                        <th>Other Allowance</th>
                        <th>Allowances</th>
                        <th>Number of Leave</th>
                        <th>Leave Pay</th>
                        <th>Holiday Pay</th>
                        <th>Total</th>
                        <th>Absent</th>
                        <th>Absent Deduction</th>
                        <th>Late</th>
                        <th>Late Deduction</th>
                        <th>Undertime</th>
                        <th>Undertime Deduction</th>
                        <th>LWOP</th>
                        <th>LWOP Deduction</th>
                        <th>SSS</th>
                        <th>Philhealth</th>
                        <th>TIN</th>
                        <th>Pag-Ibig</th>
                        <th>Other Government</th>
                        <th>Total Deduction</th>
                        <th>Salary Final Total</th>
                    </tr>
                </thead>
            <tbody>';
        echo '<tr>';
        echo '<td style="font-weight: 400;">' . $row['pay_rule'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['empid'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['full_name'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['working_days'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['basic_hours'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['overtime_hours'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['overtime_amount'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['transpo_allow'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['meal_allow'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['net_allowance'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['add_allow'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['allowances'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['number_leave'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['paid_leaves'] . '</td>';
        echo '<td style="font-weight: 400;">' . $row['holiday_pay'] . '</td>';
        echo '<td>' . $row['total_earnings'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['absence'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['absence_deduction'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['total_late'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['tardiness_deduct'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['ut_time'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['undertime_deduct'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['number_lwop'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['lwop_deduct'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['sss_contri'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['philhealth_contri'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['tin_contri'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['pagibig_contri'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['other_contri'] . '</td>';
        echo '<td style="font-weight: 400; color: red;">' . $row['total_deduction'] . '</td>';
        echo '<td>' . $row['net_pay'] . '</td>';
        echo '</tr>';
        echo '</div>';
    }
}
?>
