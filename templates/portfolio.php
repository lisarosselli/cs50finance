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
            <th>Sell</th>
            <th>Buy More</th>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>

    <tbody>
    
    <?php

        if (!empty($_POST["holdings"]))
        {
            foreach($_POST["holdings"] as $holding)
            {
                $total = money_format("$%i", $holding["price"] * $holding["quantity"]);
                print("<tr>");
                print("<td><a href='/sell_direct.php?s={$holding["symbol"]}'>Sell</a></td>");
                print("<td>Buy More</td>");
                print("<td>{$holding["symbol"]}</td>");
                print("<td>{$holding["name"]}</td>");
                print("<td>{$holding["quantity"]}</td>");
                print("<td>{$holding["price"]}</td>");
                print("<td>".$total."</td>");
            }
        } else
        {
            print("<tr>");
            print("<td colspan='7'>No stocks to report.</td>");
            print("</tr>");
        }
        
    ?>
    
  
    <tr>
        <td colspan="6">CASH</td>
        <td><?=money_format("$%i", $_POST["user_info"][0]["cash"]) ?></td>
    </tr>
    </tbody>

</table>

<div>
    <a href="logout.php">Log Out</a>
</div>
