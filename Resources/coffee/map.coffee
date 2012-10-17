(($, gmap) ->

    class Map
        constructor: (container)->
            @$container  = $(container)
            @lat         = parseFloat(@$container.data('lat'))
            @long        = parseFloat(@$container.data('long'))
            @zoom        = parseInt(@$container.data('zoom'))
            @info        = @$container.data('info')
            @plot        = @$container.data('plot')

            options = {
                zoom:                @zoom,
                center:              new google.maps.LatLng(@lat, @long),
                mapTypeId:           google.maps.MapTypeId.ROADMAP,
                mapTypeControl:      false,
                overviewMapControl:  false,
                panControl:          false,
                scaleControl:        false,
                rotateControl:       false,
                zoomControlOptions:  { style: 'SMALL' },
                streetViewControl:   false
            }
            @map = new google.maps.Map(container, options)

            @addInfoWindow(@lat, @long, @info) if (@info)
            @addPlot(@lat, @long, @plot) if (@plot)

        addInfoWindow: (lat, long, text) ->
            infoWindow = new google.maps.InfoWindow({
                maxWidth: parseInt(@$container.width() / 2.5, 10)
            });
            infoWindow.setContent(text);
            infoWindow.setPosition(new google.maps.LatLng(lat, long));
            infoWindow.open(@map);

        addPlot: (lat, long, text) ->
            plot = new google.maps.Marker;
            plot.setPosition(new google.maps.LatLng(lat, long))
            plot.setTitle(text) if text?
            plot.setMap(@map)

    $.fn.map = ->
        this.each ->
            new Map(this)

    $(window).load ->
        $('[data-behavior="map"]').map()

)(jQuery)
