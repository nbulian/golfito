
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawBasic);
    
    function drawBasic() {
    
        var chart_data = [ ['Player', 'One', 'Two', 'Three', 'Miss', { role: 'annotation' }] ];
        @foreach($comparison as $item)
            chart_data.push( [ '{{ $item->name }}' , {{ $item->single }}, {{ $item->two }}, {{ $item->three }}, {{ (($item->single+$item->two+$item->three)-$item->shots) }}, '{{ (($item->single+($item->two*2)+($item->three*3))) }} ptos' ] ); 
        @endforeach
        
        var data = google.visualization.arrayToDataTable(chart_data);
        
        var options = {
            isStacked: 'absolute',
            legend: { position: 'top', maxLines: 3 },
            title: "Head to Head - All time",
            series: {
                0:{color:'#ECC946'},
                1:{color:'#9EEC46'},
                2:{color:'#04B419'},
                3:{color:'#EC6446'}
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<div class="row">
    <div class="clearfix"></div>    
    <div class="col-md-10">
        <div id="chart_div" style="width: 100%;min-height: 450px;"></div>
    </div>
</div>