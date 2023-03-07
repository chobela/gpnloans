<?php
$link = mysqli_connect("localhost", "u859960976_user", "theresa1", "u859960976_gpn");

/* check connection */
if (mysqli_connect_errno()) {

    exit();
}

$query = "SELECT DATE_ADD(due_date, INTERVAL loan_types.days + loan_types.grace_period DAY) AS newdate, loans.id AS loanid, loans.balance, (loan_types.interest/100 * loans.balance + loans.balance) AS newbalance FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id LEFT JOIN debtors ON loans.debtor = debtors.id WHERE DATE_ADD(loans.due_date, INTERVAL loan_types.grace_period DAY) < CURDATE() AND balance > 0 AND frozen = 0";


if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {

    	$amount = $row['balance'];
    	$newbalance = $row['newbalance'];
    	$newdate = $row['newdate'];
    	$loanid = $row['loanid'];

    	$query2 = "UPDATE loans SET amount = '$amount', balance = '$newbalance', due_date = '$newdate', reloan = reloan + 1  WHERE id = '$loanid'";

    	mysqli_query($link, $query2);
        
    }

    /* free result set */
    mysqli_free_result($result);
}

/* close connection */
mysqli_close($link);
?>