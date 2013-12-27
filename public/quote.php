<?php

    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["symbol"] !== false)
        {
            $quote_array = lookup($_POST["symbol"]);
            
            if (empty($quote_array))
            {
                apologize("Symbol not found!");
            }
            else
            {
                $_POST["symbol"] = $quote_array;
                render("quote_view.php", ["title" => "Quote View"]);
            }
        }
    }
    else
    {
        // render form
        render("quote_form.php", ["title" => "Quote"]);
    }

?>
