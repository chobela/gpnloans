<?php
$link = mysqli_connect("localhost", "u471266640_userone", "Theres@1#", "u471266640_dbone");

/* check connection */
if (mysqli_connect_errno()) {

    exit();
}



$query = "SELECT loan_types.days AS days, DATE_ADD(due_date, INTERVAL loan_types.days + loan_types.grace_period DAY) AS newdate, loan_types.interest, loans.id AS loanid, loans.reloan, loans.frozen, loans.amount, loans.balance FROM loans LEFT JOIN loan_types ON loans.loantype = loan_types.id LEFT JOIN debtors ON loans.debtor = debtors.id WHERE DATE_ADD(loans.due_date, INTERVAL loan_types.grace_period DAY) < CURDATE() AND balance > 0";


if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {

        $amount = $row['balance']; // 625
        $interest = $row['interest'] / 100; // 0.25

        if ($row['reloan'] == 0) {

        $newbalance = ($interest * $row['amount']) + $row['balance']; // 750


        } else {

        $newbalance = ($interest * $row['balance']) + $row['balance']; //781.25

        }

        $loan_date = $row['newdate'];
        $newdate = $row['newdate'] + $row['days']; //22nd May
        $loanid = $row['loanid']; //loan ID
        $frozen = $row['frozen']; //frozen

        if ($frozen == '1'){

        $query2 = "UPDATE loans SET loan_date = '$loan_date', due_date = '$newdate' WHERE id = '$loanid'";

       mysqli_query($link, $query2);

        } else {

       $query2 = "UPDATE loans SET amount = '$amount', balance = '$newbalance', loan_date = '$loan_date', due_date = '$newdate', reloan = reloan + 1  WHERE id = '$loanid'";


       $query3 = "INSERT INTO statements (action, loanid, principal, balance, actiondate, loandate, duedate) VALUES ('3', $loanid, $amount, $newbalance, NOW(), $loan_date, $newdate)";

       mysqli_query($link, $query2);
       mysqli_query($link, $query3);

        }
    
    }

    /* free result set */
    mysqli_free_result($result);
}

/* close connection */
mysqli_close($link);
?>