<?php

    // configuration
    require("../includes/config.php"); 
    
    // if session
    // grab usefule information for the table and $_POST it for use
    // in portfolio php
    
    if ($_SESSION["id"])
    {
        // get all transactions for user
        $transactions = query("SELECT * FROM transactions WHERE uid = ?;", $_SESSION["id"]);
        
        if ($transactions !== false)
        {
            $_POST["transactions"] = $transactions;
        }
    }

    // render history 
    render("history.php", ["title" => "Transaction History"]);

?>
