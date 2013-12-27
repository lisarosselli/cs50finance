<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="symbol">
                <option value=""> </option>

                
                <?php
                foreach($_POST["holdings"] as $holding)
                {
                    print("<option value='".$holding["symbol"]."'>".$holding["symbol"]."</option>");
                }
                
                
                ?>
                <!--
                <option value='GOOG'>GOOG</option><option value='SBUX'>SBUX</option> 
                //-->
                
                </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell</button>
        </div>
    </fieldset>
</form>
