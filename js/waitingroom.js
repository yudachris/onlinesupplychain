        setInterval(function(){
            $(document).ready(function(){
           $("#Retailer").load('../playerpartscontroller/waiting_retailer'); 
        });
        }, 5000);
        setInterval(function(){
            $(document).ready(function(){
           $("#Wholesaler").load('../playerpartscontroller/waiting_wholesaler'); 
        });
        }, 5000);
        setInterval(function(){
            $(document).ready(function(){
           $("#Distributor").load('../playerpartscontroller/waiting_distributor'); 
        });
        }, 5000);
        setInterval(function(){
            $(document).ready(function(){
           $("#Manufacturer").load('../playerpartscontroller/waiting_manufacturer'); 
        });
        }, 5000);
        
        setInterval(function(){
            $(document).ready(function(){
              $("#start").load('../playerpartscontroller/waiting_start');  
            });
        },5000);