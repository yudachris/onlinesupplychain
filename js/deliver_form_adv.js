$(document).ready(function(){
        $("#deliv-form").on('submit',function(){
            var x = $("#del_amount").val();
            var y = confirm("Your delivery amount is: "+x+"\nAre you sure?");
            if(y==true){
                
                $('#submit_deliv').attr('disabled',true).removeClass('btn-success').addClass('btn-warning').html("<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Please Wait...");
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
                
                var posting = $.ajax({
                   url : url,
                   type : type,
                   data : data,
                   
                });
                posting.done(function(){
                    $('#del_amount').attr('disabled',true).attr('placeholder', 'Delivery Sent.');
                    $('#submit_deliv').removeClass('btn-warning').addClass('btn-success').html("<span class='glyphicon glyphicon-ok-circle'></span> Delivered</button>");
                    $('#phase_panel').load('../playerpartscontroller/phase');
                    $('#dlv_post').load('../playerpartscontroller/posted_deliver');
                    $('#onhand_inv').load('../playerpartscontroller/onhand_inventory');
                    $('#backlog').load('../playerpartscontroller/backlog_panel');
                    alert('Product Successfuly Delivered!\nPlease wait until week change.');
                });
               
                return false;
            }
            else{
                return false;
            }
        });
    });