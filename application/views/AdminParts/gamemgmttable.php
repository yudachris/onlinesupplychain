<script>
                        $(document).ready(function(){
                           $('form#saveform').on('submit',function(){
                           var that = $(this),
                            url= that.attr('action'),
                            type = that.attr('method'),
                            data = {};
                            
                            that.find('[name]').each(function(index, value){
                                var that = $(this),
                                name = that.attr('name'),
                                value = that.val();
                                
                                data[name] = value;
                            });
                            
                            $.ajax({
                               url : url,
                               type : type,
                               data : data,
                               success:function(){
                                   alert("Your setting has been saved!");
                                   $("#input").val("");
                               }
                            });
                           return false; 
                        }); 
                        });
                        
                        
                    </script>
                    
                
                    
  <form action="/OnlineBeerGame/adminpartscontroller/delete_item" method="post">
<div class="col-lg-9">
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Normal Price</th>
                <th>In-game Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($shop_list as $sl) {

                echo "<tr>";
                echo "<td>" . $sl->good_id . "</td>";
                echo "<td>" . $sl->good_name . "</td>";
                echo "<td>" . $sl->good_price . "</td>";
                echo "<td>" . $sl->ingame_good_price . "</td>";
                echo "<td>
                        <button role='submit' class='btn btn-danger' id='buttton" . $sl->good_id . "'>
                    <small><span class='glyphicon glyphicon-trash'></span></small>
                </button>
                            </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</form>
