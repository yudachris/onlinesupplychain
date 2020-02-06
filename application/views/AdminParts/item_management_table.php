<table class='table table-hover'>
<thead>
    <tr>
        <th>Item ID</th>
        <th>Item Name</th>
        <th>Price</th>
        
    </tr>  
</thead>
<tbody>
        <?php
        $y=1;
        foreach($items as $it){
            echo "<tr>
            <td>". $it->good_id ."</td>
            <td>". $it->good_name ."</td>
            <td>". $it->price ." Points</td>
            
            </tr>";
        }
        $y=$y+1;
        ?>
</tbody>
</table>