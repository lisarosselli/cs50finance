<?php

    // configure
    include("../includes/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && $_SESSION["id"])
    {
        // do we have the (right) parameter?
        if (empty($_GET["s"]))
        {
            apologize("No parameter sent.");
        }
        
        $symbol = htmlspecialchars($_GET["s"]);
        $symbol = addslashes($symbol);
        $symbol = strtoupper($symbol);
        
        // ensure the stock is a valid one
        $valid_symbol = lookup($symbol);
        if ($valid_symbol == NULL || empty($valid_symbol))
        {
            apologize("Were you fiddling with the parameter?");
        }
        
        // ensure the user has this stock
        $holdings_results = query("SELECT * FROM holdings WHERE uid = ? AND symbol = ?;",
                                $_SESSION["id"], $symbol);
        if ($holdings_results === false || count($holdings_results) != 1)
        {
            apologize("None of that stock to sell.");
        }
        
        // get user data
        $user_data = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);     
        if ($user_data === false || count($user_data) != 1)
        {
            apologize("Cannot find user.");
        }
        
        // remember this row
        $rowid = $holdings_results[0]["id"];
                
        // get current price of the stock (buy low sell high, heh)
        //$stock_info = lookup($holdings_results[0]["symbol"]);
        $total_sale_price = $valid_symbol["price"] * $holdings_results[0]["quantity"];
   
        // begin
        $begin_result = query("BEGIN");
        if (!empty($begin_result))
        {
            apologize("Server error.");
        }
                
        // drop entry from holdings
        $delete_result = query("DELETE FROM holdings WHERE id = ?;", $rowid);
                
        // update user's cash
        $new_cash_total = $user_data[0]["cash"] + $total_sale_price;
        $user_update = query("UPDATE users SET cash = ? WHERE id = ?;", $new_cash_total, $_SESSION["id"]);
                
        // insert transaction entry into transactions
        $transaction_result = query("INSERT INTO transactions (uid, transaction_type, symbol, quantity, price) values(?, ?, ?, ?, ?);", 
                              $_SESSION["id"], 'SELL', $symbol, $holdings_results[0]["quantity"], $valid_symbol["price"]);
        // commit
        if (empty($delete_result) && empty($user_update) && empty($transaction_result))
        {
            query("COMMIT");
            redirect("/cs50_finance/public/");
        } else
        {
            query("ROLLBACK");
            apologize("Something went wrong with this transaction.");
        }
    }
    
    
?>
