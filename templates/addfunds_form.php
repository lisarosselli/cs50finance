<form action="addfunds.php" method="post">
    <fieldset style="align-content:center; width:200px; margin: auto;">
        <div class="form-group">
            
            <p><?=$_POST["message"] ?></p>
            <input class="form-control" name="guess" placeholder="Guess" type="text"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </fieldset>
</form>
<p id="hint">Hint: Lisa's favorite food is sushi.</p>
