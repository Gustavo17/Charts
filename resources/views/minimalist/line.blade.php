<?php

$graph = '
	<svg ';
    if ($model->responsive) {
        $graph .= "width='100%' height='100%'";
    } else {
        $graph .= $model->height ? "height='$model->height' " : '';
        $graph .= $model->width ? "width='$model->width' " : '';
    }
    $graph .= " id='$model->id'></svg>
	<script>
		$(function() {
			var data = [
				"; for ($i = 0; $i < count($model->values); $i++) {
        $graph .= '{x: "'.$model->labels[$i].'", y: '.$model->values[$i];
        $graph .= ' },';
    }
                $graph .= '
			];

			var xScale = new Plottable.Scales.Category();
			var yScale = new Plottable.Scales.Linear();

			var plot = new Plottable.Plots.Line()
			  .addDataset(new Plottable.Dataset(data))
			  .x(function(d) { return d.x; }, xScale)
			  .y(function(d) { return d.y; }, yScale)
			  '; $graph .= $model->colors ? ".attr('stroke', \"".$model->colors[0].'")' : ''; $graph .= "
			  .renderTo('svg#$model->id');

			window.addEventListener('resize', function() {
			  plot.redraw();
			});
		});
	</script>
";

return $graph;
