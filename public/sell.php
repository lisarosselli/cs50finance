<?php
    
    // configuration
    require("../includes/config.php");
    
    // selling from the sell page, after choosing a stock
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_SESSION["id"])
        {
            $holdings_results = query("SELECT * FROM holdings WHERE uid = ? AND symbol = ?;",
                                $_SESSION["id"], $_POST["symbol"]);
            
            
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
            $stock_info = lookup($holdings_results[0]["symbol"]);
            $total_sale_price = $stock_info["price"] * $holdings_results[0]["quantity"];
            
                
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
                                    $_SESSION["id"], 'SELL', $_POST["symbol"], $holdings_results[0]["quantity"], $stock_info["price"]);
            
            // commit
            if (empty($delete_result) && empty($user_update) && empty($transaction_result))
            {
                query("COMMIT");
            } else
            {
                query("ROLLBACK");
                apologize("Something went wrong with this transaction.");
            }
               
        }
        else
        {
            apologize("Session timed out.");
        }
 
        redirect("/cs50_finance/public/");
    } 
    else
    {
        $holdings_results;
        if ($_SESSION["id"])
        {
            $holdings_results = query("SELECT * FROM holdings WHERE uid = ?", $_SESSION["id"]); 
            if ($holdings_results !== false)
            {
                $_POST["holdings"] = $holdings_results;
            } 
            else
            {
                apologize("Could not acquire your stock data.");
            }
        }
    
        // render form
        render("sell_form.php", ["title" => "Sell Your Stocks!"]);
    }
    
?>
