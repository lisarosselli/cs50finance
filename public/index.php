<?php

    // configuration
    require("../includes/config.php"); 
    
    // if session
    // grab usefule information for the table and $_POST it for use
    // in portfolio php
    
    if ($_SESSION["id"])
    {
        // get all the stock holdings for the logged in user
        $holdings_result = query("SELECT * FROM holdings WHERE uid = ?", $_SESSION["id"]);
        
        // append the stock name to each array
        foreach($holdings_result as $holding)
        {
            $lookup = lookup($holding["symbol"]);
            $holding["name"] = $lookup["name"];
            $_POST["holdings"][] = $holding;
        }
        
        // get basic user data from users table
        $user_info = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        $_POST["user_info"] = $user_info;
    }

    // render portfolio
    render("portfolio.php", ["title" => "Portfolio"]);

?>
