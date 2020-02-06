			     <table class="table table-stripped">
                <thead>
                  <tr>
                    <th>Week Count</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($prev_demand as $pd) {
                      echo "<tr>";
                      echo "<td>Week ". $pd->turn_count ."</td>";
                      echo "<td>". $pd->amount ."</td>";
                      echo "</tr>";
                    }
                    ?>
                </tbody>
             </table>