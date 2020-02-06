<script type="text/javascript">
    $(document).ready(function(){
        var chart = new CanvasJS.Chart("invChart",
        {

            title:{
                text: "Inventory Statistics",
                fontSize: 20,
                fontFamily: 'Poppins', 
            },
                        animationEnabled: true,
            axisX:{
                titleFontFamily: 'Poppins',
                labelFontFamily: 'Poppins',
                gridColor: "Silver",
                tickColor: "silver",
                

            },                        
                        toolTip:{
                          shared:true,
                          content: function(e){
                    var body = new String;
                    var head ;
                    for (var i = 0; i < e.entries.length; i++){
                        var  str = "<span style= 'color:"+e.entries[i].dataSeries.color + "'> " + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + " unit(s)</strong><br/>" ; 
                        body = body.concat(str);
                    }
                    head = "<span style = 'color:DodgerBlue; '><strong>"+ (e.entries[0].dataPoint.label) + "</strong></span><br/>";

                    return (head.concat(body));
                }
                        },
            theme: "theme2",
            axisY: {
                title:"Unit",
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
                name: "Inventory",
                markerType: "circle",
                color: "#4da6ff",
                dataPoints: [
                <?php
                foreach($statistics as $stat){
                    echo "{label: 'Week ". $stat->turn_count ."' , y: ". $stat->current_inventory ."},";
                }
                ?>
                ]
            },
            {        
                type: "line",
                showInLegend: true,
                name: "Excessive Inventory",
                color: "#e6e600",
                lineThickness: 2,
                markerType: "triangle",
                dataPoints: [
                <?php
                foreach($statistics as $stat){
                    echo "{label: 'Week ". $stat->turn_count ."' , y: ". $stat->current_excess_inventory ."},";
                }
                ?>
                ]
            },
            {        
                type: "line",
                showInLegend: true,
                name: "Backlog",
                color: "#ff4d4d",
                lineThickness: 2,
                markerType: "cross",
                dataPoints: [
                <?php
                foreach($statistics as $stat){
                    echo "{label: 'Week ". $stat->turn_count ."' , y: ". $stat->current_backlog ."},";
                }
                ?>
                ]
            }

            
            ],
          legend:{
            cursor:"pointer",
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
</script>
<div id='invChart' style='height: 300px;'>

</div>
