<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('soloist_calendar_calendar_show', new Route('/show/{slug}/{year}-{month}.html', array(
        '_controller'   => 'SoloistCalendarBundle:Default:showMonth',
        'year'          => date('Y'),
        'month'         => date('n')
    )
));

$collection->add('soloist_calendar_calendar_show_all', new Route('/show/{year}-{month}.html', array(
        '_controller'   => 'SoloistCalendarBundle:Default:showMonth',
        'year'          => date('Y'),
        'month'         => date('n')
    )
));

return $collection;
