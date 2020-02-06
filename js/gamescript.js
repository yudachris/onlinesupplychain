
$(document).ready(function() {

    $("#play_pause").click(function() {
        $.ajax({
            url: "../gamecontroller/play_pause",
        }).done(function() {
            $("#prog-stat").text(" Game Is In Progress");           
        });
        
        
    });
});


$(document).ready(function(){

    $("#pl_log_switch").click(function(){
        $.ajax({
            url: "../gamecontroller/login_permit",
        });
    });

});

