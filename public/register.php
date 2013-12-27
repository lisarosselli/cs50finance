<?php
    
    // configuration
    require("../includes/config.php");
    
    // if form was submitted    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["username"]))
        {
            apologize("Please choose a username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("Please select a password");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("Please confirm your password.");
        }
        
        if ($_POST["password"] !== $_POST["confirmation"])
        {
            apologize("Please enter a password and matching confirmation password.");
        }
        
        $safe_name = htmlspecialchars($_POST["username"]);
        $safe_name = addslashes($safe_name);
        
        $safe_pass = htmlspecialchars($_POST["password"]);
        $safe_pass = addslashes($safe_pass);
        
        $result = query("INSERT INTO users (username, hash, cash) values(?, ?, 10000.00)", 
                        $safe_name, crypt($safe_pass));
        
        echo $result;
        
        if ($result !== false)
        {
            $last_insert = query("SELECT LAST_INSERT_ID() AS id");
            $_SESSION["id"] = $rows[0]["id"];
            redirect("/");
        }
        
        // else, something went wrong in entering the new user
        apologize("Something went really wrong.\nMaybe you chose a username that's already registered.");
        
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }


?>
