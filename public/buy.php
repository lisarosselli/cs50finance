<?php

    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check for decent user input
        if (empty($_POST["symbol"]) || !is_string($_POST["symbol"]))
        {
            apologize("Please enter a symbol.");
        }
        else if (empty($_POST["shares"]) || !is_numeric($_POST["shares"]) || !preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Please enter a share quantity.");
        }
        
        
        $symbol_array = lookup($_POST["symbol"]);
        
        
        // if the stock symbol cannot be found, alert user
        if (empty($symbol_array))
        {
            apologize("Cannot find stock symbol.");
        }
        
        
        // otherwise proceed to the transaction
        
        // 1. get the user's data (cash, really)
        $user_data = query("SELECT * from users where id = ?;", $_SESSION["id"]);
        
        if ($user_data === false || count($user_data) > 1)
        {
            apologize("Something went terribly wrong in accessing your data.");
        }
        
        // set a variable that leads to the first (and only) row returned
        $this_user = $user_data[0];
        
        $total_cash_needed = $symbol_array["price"] * $_POST["shares"];
        
        // check if the user has enough money for the transaction
        if ($total_cash_needed > $this_user["cash"]) 
        {
            apologize("Seems as though you don't have enough money.");
        }
        
        
        // 2. does the user hold this stock already?
        $user_symbol_holding = query("SELECT * FROM holdings WHERE uid = ? AND symbol = ?;", 
                                $this_user["id"], $symbol_array["symbol"]);
                                
                                
        //$begin_result = query("BEGIN");
        $update_insert_success = false;
        
        if (count($user_symbol_holding) == 0)
        {
            $update_insert_success = query("INSERT INTO holdings (uid, symbol, price, quantity) values(?, ?, ?, ?);", 
                                    $this_user["id"], $symbol_array["symbol"], $symbol_array["price"], $_POST["shares"]);
        } 
        else if (count($user_symbol_holding ) == 1)
        {
            $user_symbol_entry = $user_symbol_holding[0];
            $new_quantity = $user_symbol_entry["quantity"] + $_POST["shares"];
            $update_insert_success = query("UPDATE holdings SET price = ?, quantity = ? where id = ?;",
                            $symbol_array["price"], $new_quantity, $user_symbol_entry["id"]);
        }
        
        // enter row into transactions table
        $transactions_result = query("INSERT INTO transactions (uid, transaction_type, symbol, quantity, price) values(?, ?, ?, ?, ?);", 
                                $this_user["id"], 'BUY', $symbol_array["symbol"], $_POST["shares"], $symbol_array["price"]);
        
        // update user with cash left on hand
        $cash_left = $this_user["cash"] - $total_cash_needed;
        $user_update_result = query("UPDATE users SET cash = ? WHERE id = ?;",
                                $cash_left, $this_user["id"]);
        $commit_result = false;                        
                                
        // redirect back to portfolio or alert that something went wrong                        
        if (count($user_update_result) == 0 && count($update_insert_success) == 0)
        {
            $commit_result = query("COMMIT");
            redirect("/cs50_finance/public/");
        } else
        {
            $commit_result = query("ROLLBACK");
            apologize("Something went wrong with this transaction.");
        }      
    }
    else
    {
        // render form
        render("buy_form.php", ["title" => "Buy Some Stocks!"]);
    }
?>
