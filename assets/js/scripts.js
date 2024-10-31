(function($) {
    $(document).ready(function() {
        $(this).on('click', '.button-map', function() {
            $(this).closest('label').trigger('click');
        });

        $(this).on('updated_checkout', function(event){
            $('.button-map').remove();
            $('.shipping_method').each(function(){
                var shippingMethod = $(this);
                var shippingMethodVal = shippingMethod.val();
                var button = false;

                if (shippingMethod.prop('checked') || $('.shipping_method').length==1) {
                    if (shippingMethodVal == 'ozon_shipping_method:pickup') {
                        button = '<span class="od-map-btn-wrapper"><button type="button" class="button alt button-map" data-od_popup="od-pickup-map-popup">Выбрать на карте</button></span>';
                    }

                    if (shippingMethodVal == 'ozon_shipping_method:postamat') {
                        button = '<span class="od-map-btn-wrapper"><button type="button" class="button alt button-map" data-od_popup="od-postamat-map-popup">Выбрать на карте</button></span>'
                    }

                    if (button) {
                        shippingMethod.closest('li').append(button)
                    }
                }
            });
        });

        $(this).on('click', '[data-od_popup]', function() {
            var id = $(this).data('od_popup');
            var popup = $('#' + id);

            if(popup.length) {
                popup.addClass('open');

                ymaps.ready(function () {
                    var sumLat = 0., sumLong = 0.;
                    var mapContentLayout = ymaps.templateLayoutFactory.createClass(
                        '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
                    );

                    if(id == 'od-pickup-map-popup') {
                        window.pickupPoints.forEach(function(point) {
                            sumLat += parseFloat(point.latitude);
                            sumLong += parseFloat(point.longitude);
                        });

                        window.pickupMap = new ymaps.Map(popup.data('map'), {
                            center: [sumLat / window.pickupPoints.length, sumLong / window.pickupPoints.length],
                            zoom: 8
                        }, {
                            searchControlProvider: 'yandex#search'
                        });

                        window.pickupPoints.forEach(function(point) {
                            pickupMap.geoObjects.add(new ymaps.Placemark([parseFloat(point.latitude), parseFloat(point.longitude)], {
                                hintContent: point.name,
                                balloonContentHeader: point.name,
                                balloonContentBody: point.address,
                                balloonContentFooter: '<button type="button" class="od-choose-point" data-point=\'' + JSON.stringify({
                                    type: 'pickup',
                                    id: point.id,
                                    name: point.name
                                }) + '\'>Выбрать</button>',
                            }, {
                                iconLayout: 'default#imageWithContent',
                                iconImageHref: window.ozonPluginUrl + '/assets/images/svg/pickup.svg',
                                iconImageSize: [48, 48],
                                iconImageOffset: [-24, -48],
                                iconContentOffset: [0, 0],
                                iconContentLayout: mapContentLayout
                            }));
                        });
                    } else if(id == 'od-postamat-map-popup') {
                        window.postamatPoints.forEach(function(point) {
                            sumLat += parseFloat(point.latitude);
                            sumLong += parseFloat(point.longitude);
                        });

                        window.postamatMap = new ymaps.Map(popup.data('map'), {
                            center: [sumLat / window.postamatPoints.length, sumLong / window.postamatPoints.length],
                            zoom: 8
                        }, {
                            searchControlProvider: 'yandex#search'
                        });

                        window.postamatPoints.forEach(function(point) {
                            postamatMap.geoObjects.add(new ymaps.Placemark([parseFloat(point.latitude), parseFloat(point.longitude)], {
                                hintContent: point.name,
                                balloonContentHeader: point.name,
                                balloonContentBody: point.address,
                                balloonContentFooter: '<button type="button" class="od-choose-point" data-point=\'' + JSON.stringify({
                                    type: 'postamat',
                                    id: point.id,
                                    name: point.name
                                }) + '\'>Выбрать</button>',
                            }, {
                                iconLayout: 'default#imageWithContent',
                                iconImageHref: window.ozonPluginUrl + '/assets/images/svg/pickup.svg',
                                iconImageSize: [48, 48],
                                iconImageOffset: [-24, -48],
                                iconContentOffset: [0, 0],
                                iconContentLayout: mapContentLayout
                            }));
                        });

                        var count = window.pickupPoints.length + window.postamatPoints.length;
                        if (count > 1) {
                            var bounds = postamatMap.geoObjects.getBounds();
                            postamatMap.setBounds(bounds);
                        }
                    }
                });
            }
        });

        $(this).on('click', '.od-popup-close', function() {
            $('.od-popup.open').removeClass('open');

            if(window.pickupMap !== undefined)
                window.pickupMap.destroy();

            if(window.postamatMap !== undefined)
                window.postamatMap.destroy();
        });

        $(this).on('click', '.od-choose-point', function() {
            var pointData = $(this).data('point');

            if($('[data-od_popup="od-' + pointData.type + '-map-popup"]').length) {
                $('#pickup-data').remove();
                $('#postamat-data').remove();

                $('[data-od_popup="od-' + pointData.type + '-map-popup"]').before(
                    '<span id="' + pointData.type + '-data">' +
                        '<input type="hidden" name="point[type]" value="' + pointData.type + '" />' +
                        '<input type="hidden" name="point[id]" value="' + pointData.id + '" />' +
                        '<span><b>' + pointData.name + '</b></span>' +
                    '</span>'
                );
            }

            $('.od-popup.open').removeClass('open');

            if(window.pickupMap !== undefined)
                window.pickupMap.destroy();

            if(window.postamatMap !== undefined)
                window.postamatMap.destroy();
        });
    });
})(jQuery)