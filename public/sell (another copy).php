<?php
    
    // configure
    include("../includes/config.php");

    $sell_symbol = NULL;

    dump($_SERVER["REQUEST_METHOD"]);
    // either a post or get request, but some action is requested
    if ($_SESSION["id"])
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // if the request comes from the sell_form
            $sell_symbol = $_POST["symbol"];   
        } else if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            // if the request comes from the portfolio page sell link
            $sell_symbol = (!empty($_GET["s"])) ? $_GET["s"] : NULL;
      
            if ($sell_symbol == NULL)
            {
                apologize("Did you fiddle with the URL parameter?");
            }
        } else
        {
            apologize("No symbol selected to sell.");
        }
        
        
        // Does the user have this stock to sell?
        $holdings_results = query("SELECT * FROM holdings WHERE uid = ? AND symbol = ?;",
                                $_SESSION["id"], $sell_symbol);
            
        //dump($holdings_results); // TODO remove
            
        if ($holdings_results === false || count($holdings_results) != 1)
        {
            apologize("None of that stock to sell.");
        } 
        
        
        // get user data
        $user_data = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
            
        //dump($user_data); // TODO remove
            
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
                                $_SESSION["id"], 'SELL', $sell_symbol, $holdings_results[0]["quantity"], $stock_info["price"]);
            
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
    
    
    function renderPage()
    {
        // if there is no request method, ie just coming to the page, no action requested
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
