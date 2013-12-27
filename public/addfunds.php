<?php
    // configuration
    include("../includes/config.php");
    
    // setup a message for the user as they enter in their guess
    if ($_SESSION["id"])
    {
        $user_data = query("SELECT * FROM users WHERE id = ?;", $_SESSION["id"]);
        
        if ($user_data === false && count($user_data) != 1)
        {
            apologize("Something wrong with user data.");
        }   
        
        $user = $user_data[0];
        $user_cash = round($user["cash"], 2);
        
        if ($user_cash > 20000)
        {
            $_POST["message"] = "Curb your enthusiasm! You've got enough money to work with!";
        } else if ($user_cash < 1000)
        {
            $_POST["message"] = "Better deposit more money so you can buy lunch for everyone!";
        } else
        {
            $_POST["message"] = "Guess Lisa's favorite food and get $1000 added to your account.";
        }   
        
    } else
    {
        apologize("Your session has expired.");
    }
    
    // evaluate user's guess
    if (!empty($_POST["guess"]))
    {
        if (strtolower($_POST["guess"]) == "sushi")
        {
            $deposit_result = query("UPDATE users SET cash = ? WHERE id = ?;",
                            ($user_cash + 1000), $_SESSION["id"]);
            if ($deposit_result === false)
            {
                apologize("Something went wrong with the deposit.");
            }                
            
            redirect("/cs50_finance/public/");
        } else
        {
            apologize("Nope that's not it.");
        }
        
    }

    render("addfunds_form.php", ["title" => "Add FUNds!"]);
?>
