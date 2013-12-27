<ul class="nav nav-pills">
    <li class="username">User: <?=getUsername(); ?></li>
    <li><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li><a href="sell.php">Sell</a></li>
    <li><a href="addfunds.php">Add Funds!</a></li>
    <li><a href="history.php">History</a></li>
    <li><a href="logout.php"><strong>Log Out</strong></a></li>
</ul>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
    
    <?php
   
        if (!empty($_POST["transactions"]))
        {   
            foreach($_POST["transactions"] as $transaction)
            {
                $datestr = strtotime($transaction["datetime"]);
                $fdate = date("m/d/y g:i A", $datestr);
                
                print("<tr>");
                print("<td>{$transaction["transaction_type"]}</td>");
                print("<td>{$fdate}</td>");
                print("<td>{$transaction["symbol"]}</td>");
                print("<td>{$transaction["quantity"]}</td>");
                print("<td>{$transaction["price"]}</td>");
                print("</tr>");
            }
            
        } else
        {
            print("<tr>");
            print("<td colspan='5'>No transactions to report.</td>");
            print("</tr>");
        }
        
    ?>

    </tbody>

</table>

<div>
    <a href="logout.php">Log Out</a>
</div>
