<!DOCTYPE html>
<html style="height:100%">
<head>
    <title>GPDB</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" media="screen">
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body class="container" style="height:98%">
<?php
    require_once __DIR__.'/../bootstrap/autoload.php';
    require_once __DIR__.'/../helpers/generateInfoWindowText.php';

    use Helper\Builder\ApiHelperBuilder;
    use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
    use Ivory\GoogleMap\Map;
    use Ivory\GoogleMap\Base\Coordinate;
    use Ivory\GoogleMap\Overlay\Animation;
    use Ivory\GoogleMap\Overlay\Icon;
    use Ivory\GoogleMap\Overlay\InfoWindow;
    use Ivory\GoogleMap\Overlay\Marker;
    use Ivory\GoogleMap\Overlay\MarkerShape;
    use Ivory\GoogleMap\Overlay\MarkerShapeType;
    use Ivory\GoogleMap\Overlay\Symbol;
    use Ivory\GoogleMap\Overlay\SymbolPath;

    $db = MysqliDb::getInstance();
    $points = $db->get('gp');
    foreach($points as $point){
        //var_dump($point);
        $marker = new Marker(
//            new Coordinate($point['longitude'], $point['latitude'])
            new Coordinate($point['longitude'], $point['latitude']),
//            Animation::BOUNCE,
//            new Icon(),
//            new Symbol(SymbolPath::CIRCLE),
//            new MarkerShape(MarkerShapeType::CIRCLE, [1.1, 2.1, 1.4]),
            null, null, null, null, ['clickable' => true]
        );
        $marker->setInfoWindow(new InfoWindow(generateInfoWindowText($point)));
        $map->getOverlayManager()->addMarker($marker);
    }

    $map->setCenter(new Coordinate(53.388, -8.627));
    $map->setMapOption('zoom', 8);

    echo $mapHelper->render($map);
    echo $apiHelper->render([$map]);

?>

<form action="#">
<div class="row">
<div class="input-field col s12 m6">
<p><label for="trans"><input type="checkbox" id="trans" /><span>Trans Friendly</span></label></p>
<p><label for="choice"><input type="checkbox" id="choice" /><span>Choice Friendly</span></label></p>
<p><label for="medicalCard"><input type="checkbox" id="medicalCard" /><span>Accepts Medical Card</span></label></p>
<p><label for="referral"><input type="checkbox" id="referral" /><span>Provides Referrals</span></label></p>
</div>
<div class="input-field col s12 m6">
	<select multiple>
		<option value="" disabled selected>Select County</option>
		<option value="cork">Cork</option>
	</select>
	<label>County:</label>
</div>
<div class="input-field col s12 m6">
<button class="right btn waves-effect waves-light" type="submit" name="action">Update<i class="material-icons right">send</i></button>
</div>
</div>
</form>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('select').formSelect();
	document.addEventListener('DOMContentLoaded', function(){
		var elems = document.querySelectorAll('select');
		var instances = M.FormSelect.init(elems, options);
	});
});
</script>
</body>
</html>
