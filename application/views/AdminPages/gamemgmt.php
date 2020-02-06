<body>
    <div class="container">
        <div class="page-header" style="text-align: right;">
            <h2>Game Management</h2>
        </div>
        <ul class="nav nav-tabs">
            <li class='active'><a data-toggle="tab" href="#menu2">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Item Shop</a></li>
            <li><a data-toggle="tab" href="#menu3">
                    <span class="glyphicon glyphicon-list-alt"></span> Game Difficulty Setting (Coming Soon)</a></li>

        </ul>


        <div class="tab-content">
            <!--ITEMS MANAGEMENT-->
            <div id="menu2" class="tab-pane fade in active">
                <h3><strong>Items</strong> Management</h3>
                <div class='row'>
                <div class='col-lg-7 col-md-7 col-sm-7' id='item_table'>
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

                </div>
                <div class='col-lg-5 col-md-5 col-sm-5'>
                    <div class='panel panel-primary'>
                    <div class='panel-heading'><strong>Edit</strong> Item</div>
                    <div class='panel-body'>
                        <script type="text/javascript">
                        $(document).ready(function(){

                            $("form#changeprice").on('submit',function(){
                            var y = confirm('Are You Sure?');
                            if(y==true){
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
                            
                            var change = $.ajax({
                               url : url,
                               type : type,
                               data : data,
                               
                            });
                            change.done(function(){
                                $("#item_table").load("../adminpartscontroller/item_table");
                                $("#price_field").val('');
                                alert('Price Changed!');
                            });
                            return false;
                            }
                            else{
                                return false;
                            }
                            
                            });
                        });
                    </script>
                    <form action='../admin/change_price' method='post' id='changeprice'>
                        <div class='form-group'>
                            <label>Item ID:</label>
                            <select class='form-control' name='good_id'>
                                <option value='G1'>G1</option>
                                <option value='G2'>G2</option>
                                <option value='G3'>G3</option>
                            </select>
                        </div>
                        <div class='form-group'>
                            <label>Price:</label>
                            <input id='price_field' class='form-control' name='good_price' type='number' min='0' placeholder='Change price to..'>
                        </div>
                        <button role='submit' class='btn btn-primary'>Change</button>
                    </form>
                    </div>
                    </div>
                </div>
                </div>
  
            </div>
            <!--END OF ITEMS MANAGEMENT-->
            <!--START OF DIFFICULTY MANAGEMENT-->
            <div id="menu3" class="tab-pane fade in">
                <h1 style="margin-top: 10%; text-align: center;">Coming Soon..</h1>
                
                
                
            </div>
            <!--END OF DIFFICULTY MANAGEMENT-->
            
        </div>
    </div>
</body>