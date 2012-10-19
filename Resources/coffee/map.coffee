(($) ->

    class GMap
        constructor: (container)->
            @$container  = $(container)
            @lat         = parseFloat(@$container.data('lat'))
            @longit      = parseFloat(@$container.data('long'))
            @zoom        = parseInt(@$container.data('zoom'))
            @info        = @$container.data('info')
            @plotInfo    = @$container.data('plot')

            options = {
                zoom:                @zoom,
                center:              new google.maps.LatLng(@lat, @longit),
                mapTypeId:           google.maps.MapTypeId.ROADMAP,
                mapTypeControl:      false,
                overviewMapControl:  false,
                panControl:          false,
                scaleControl:        false,
                rotateControl:       false,
                zoomControlOptions:  { style: 'SMALL' },
                streetViewControl:   false
            }
            @gmap = new google.maps.Map(container, options)

            @addInfoWindow(@lat, @longit, @info) if (@info)
            @addPlot(@lat, @longit, @plotInfo) if (@plotInfo)

        addInfoWindow: (lat, longit, text) ->
            infoWindow = new google.maps.InfoWindow({
                maxWidth: parseInt(@$container.width() / 2.5, 10)
            });
            infoWindow.setContent(text)
            infoWindow.setPosition(new google.maps.LatLng(lat, longit))
            infoWindow.open(@gmap)

        addPlot: (lat, longit, text) ->
            plotInfo = new google.maps.Marker;
            plotInfo.setPosition(new google.maps.LatLng(lat, longit))
            plotInfo.setTitle(text) if text?
            plotInfo.setMap(@gmap)

    $.fn.gmap = ->
        this.each ->
            new GMap(this)

    $(window).load ->
        $('[data-behavior="map"]').gmap()

)(jQuery)
