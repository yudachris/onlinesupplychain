
<?php
if($current_demand === "no"){
  echo "<h3>No Active Demand</h3>";
}
else{
  echo "<table class='table table-stripped'>
    <thead>
      <tr>
        <th>Week Count</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Week ". $current_demand->turn_count ."</td>
        <td>". $current_demand->amount ."</td>
      </tr>          
    </tbody>
</table>";
}

?>