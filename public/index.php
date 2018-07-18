<?php
    require_once __DIR__.'/../bootstrap/autoload.php';

    use Helper\Builder\ApiHelperBuilder;
    use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
    use Ivory\GoogleMap\Map;
    use Ivory\GoogleMap\Base\Coordinate;

    $db = MysqliDb::getInstance();
    $map->setCenter(new Coordinate(53.388, -8.627));
    $map->setMapOption('zoom', 8);
    $map->setStylesheetOption('width', '100%');
    $map->setStylesheetOption('height', '80%');

    echo $mapHelper->render($map);
    echo $apiHelper->render([$map]);


?>
