<div class="row">
    
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Total Inventory Cost</th>
                    <th>Total Backlog Cost</th>
                    <th>Total Cost</th>
                    <th>Credit Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($team as $t){
                    
                    echo "<tr>";
                    echo "<td><b>". $t->team_code ."</b></td>";
                    echo "<td>$". $t->accum_i_cost ."</td>";
                    echo "<td>$". $t->accum_b_cost ."</td>";
                    echo "<td>$". $t->total_cost ."</td>";
                    echo "<td>$". $t->team_credit ."</td>";
                    echo "<td>". $t->status ."</td>";                
                    echo "</tr>";
                    
                }
                ?>
            </tbody>
        </table>
    
</div>