<?php
    $formatted_quote = money_format("$%i", $_POST["symbol"]["price"]);        
    echo "<p>A share of ".$_POST['symbol']['name'] .", (". 
            $_POST['symbol']['symbol'] ."), costs <b>". $formatted_quote ."</b>.</p>";
?>

<p><a href="buy.php">Buy some?</a></p>
