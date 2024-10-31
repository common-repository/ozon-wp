(function($) {
    $(document).ready(function() {
        $(this).on('click', '#change-shipping-method', function() {
            $('.change-shipping-form').show();
            $(this).hide();
        });

        $(this).on('click', '.button-map', function() {
            $(this).closest('label').trigger('click');
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

            $('.shipping-info-point').text(pointData.name);
            $('#save-shipping-method').data('point', $(this).data('point'));

            $('.od-popup.open').removeClass('open');

            if(window.pickupMap !== undefined)
                window.pickupMap.destroy();

            if(window.postamatMap !== undefined)
                window.postamatMap.destroy();
        });

        $(this).on('change', '[name="ozon_order[rate]"]', function() {
            $('.shipping-info-title').text($('[name="ozon_order[rate]"]:checked').next().children('.rate-name').text());
            $('.shipping-info-point').empty();
            $('#save-shipping-method').data('point', '');
        });

        $(this).on('click', '#save-shipping-method', function() {
            const orderID = $(this).data('order');
            const pointData = $(this).data('point');

            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'od_update_shipping',
                    order_id: orderID,
                    method: $('[name="ozon_order[rate]"]:checked').val(),
                    title: $('[name="ozon_order[rate]"]:checked').data('name'),
                    cost: $('[name="ozon_order[rate]"]:checked').data('cost'),
                    variant: $('[name="ozon_order[rate]"]:checked').data('variant'),
                    point: pointData
                },
                dataType: 'json',
                beforeSend: function (response) {
                    $('#ozon-wp-panel').addClass('loading');
                },
                complete: function (response) {
                    $('#ozon-wp-panel').removeClass('loading');
                },
                success: function(response) {
                    if(response.type == 'error')
                        alert(response.message);
                    else
                        window.location.reload();
                },
                error: function() {
                    alert('Возникла ошибка. Попробуйте, пожалуйста, позже.');
                }
            })
        });

        $(this).on('change', '[name="ozon_order[type]"]', function() {
            if($('[name="ozon_order[type]"]:checked').val() == 'LegalPerson')
                $('#company-wrapper').show();
            else
                $('#company-wrapper').hide();
        });

        /*$(this).on('change', '[name="ozon_order[full_paid]"]', function() {
            if($('[name="ozon_order[full_paid]"]').prop('checked'))
                $('#paid-amount-wrapper').hide();
            else
                $('#paid-amount-wrapper').show();
        });*/

        $(this).on('click', '#send-order', function() {
            const orderID = $(this).data('order');

            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: $('<form />').append( $('[name^="ozon_order"], .ozon_form').clone() ).serialize().replace('ozon_action', 'action'),
                dataType: 'json',
                beforeSend: function (response) {
                    $('#ozon-wp-panel').addClass('loading');
                },
                complete: function (response) {
                    $('#ozon-wp-panel').removeClass('loading');
                },
                success: function(response) {
                    if(response.type == 'error')
                        alert(response.message);
                    else {
                        alert(response.message);

                        window.location.reload();
                    }
                },
                error: function() {
                    alert('Возникла ошибка. Попробуйте, пожалуйста, позже.');
                }
            })
        });

        $(this).on('click', '#create-document', function() {
            const orderID = $(this).data('order');
            const postingID = $(this).data('posting');

            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'od_create_document',
                    order_id: orderID,
                    posting: postingID
                },
                dataType: 'json',
                beforeSend: function (response) {
                    $('#ozon-wp-panel').addClass('loading');
                },
                complete: function (response) {
                    $('#ozon-wp-panel').removeClass('loading');
                },
                success: function(response) {
                    if(response.type == 'error')
                        alert(response.message);
                    else {
                        alert(response.message);

                        window.location.reload();
                    }
                },
                error: function() {
                    alert('Возникла ошибка. Попробуйте, пожалуйста, позже.');
                }
            })
        });
    });
})(jQuery)