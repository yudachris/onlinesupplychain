<script type="text/javascript">
$(document).ready(function(){
    $(document).ready(function(){
        var chart = new CanvasJS.Chart("costChart",
        {

            title:{
                text: "Cost Statistics",
                fontSize: 20,
                fontFamily: 'Poppins',
            },
                        animationEnabled: true,
            axisX:{

                gridColor: "Silver",
                titleFontFamily: 'Poppins',
                labelFontFamily: 'Poppins',
                tickColor: "silver",
                valueFormatString: "DD/MMM"

            },                        
                        toolTip:{
                          shared:true,
                          FontFamily: 'Poppins',
                          content: function(e){
                    var body = new String;
                    var head ;
                    for (var i = 0; i < e.entries.length; i++){
                        var  str = "<span style= 'color:"+e.entries[i].dataSeries.color + "'> " + e.entries[i].dataSeries.name + "</span>: $<strong>"+  e.entries[i].dataPoint.y + "</strong><br/>" ; 
                        body = body.concat(str);
                    }
                    head = "<span style = 'color:DodgerBlue; '><strong>"+ (e.entries[0].dataPoint.label) + "</strong></span><br/>";

                    return (head.concat(body));
                }
                        },
            theme: "theme2",
            axisY: {
                title:"Cost ($)",
                titleFontFamily: 'Poppins',
                labelFontFamily: 'Poppins',
                gridColor: "Silver",
                tickColor: "silver"
            },
            legend:{
                verticalAlign: "center",
                horizontalAlign: "right"
            },
            data: [
            {        
                type: "line",
                showInLegend: true,
                lineThickness: 2,
                name: "Inventory Cost",
                markerType: "circle",
                color: "#4da6ff",
                dataPoints: [
                <?php
                foreach($statistics as $stat){
                    echo "{label: 'Week ". $stat->turn_count ."' , y:  ". $stat->current_inventory_cost ."},";
                }
                ?>
                ]
            },
            {        
                type: "line",
                showInLegend: true,
                name: "Excessive Inventory Cost",
                color: "#e6e600",
                lineThickness: 2,
                markerType: "triangle",
                dataPoints: [
                <?php
                foreach($statistics as $stat){
                    echo "{label: 'Week ". $stat->turn_count ."' , y: ". $stat->current_excess_inv_cost ."},";
                }
                ?>
                ]
            },
            {        
                type: "line",
                showInLegend: true,
                name: "Backlog Cost",
                color: "#ff4d4d",
                lineThickness: 2,
                markerType: "cross",
                dataPoints: [
                <?php
                foreach($statistics as $stat){
                    echo "{label: 'Week ". $stat->turn_count ."' , y: ". $stat->current_backlog_cost ."},";
                }
                ?>
                ]
            }

            
            ],
          legend:{
            cursor:"pointer",
            FontFamily: 'Poppins',
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else{
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
        });

chart.render();
    });

});
</script>
<div id='costChart' style='height: 300px;'>

</div>
