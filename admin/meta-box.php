<?php

/**
 * @var array $data
 * @var \WC_Shipping_Rate $rate
*/

add_thickbox();
?>

<?php if(!empty($data['ozon']) && !empty($data['ozon']['number'])):?>
    <div class="order-info-wrapper">
        <div class="order-info">
            <?php _e(sprintf('Заказ создан под номером <b>№%s</b>', $data['ozon']['number']), OZON_PLUGIN_DOMAIN)?>
        </div>
        <?php if(!empty($data['ozon']['packages'])):?>
            <div class="order-packages">
                <?php foreach($data['ozon']['packages'] as $package):?>
                    <div class="order-package">
                        <div class="order-package-title"><?php echo htmlspecialchars($package['packageNumber']) ?></div>
                        <?php if(!empty($package['document'])):?>
                            <div class="order-package-document">
                                <?php _e(sprintf('Документ создан под номером <b>№%s</b>', $package['document']['name']), OZON_PLUGIN_DOMAIN)?>
                            </div>
                        <?php endif;?>
                        <div class="order-package-actions">
                            <?php if(!empty($package['sticker'])):?>
                                <a href="<?php echo htmlspecialchars($package['sticker']) ?>" target="_blank" class="button button-primary">
                                    <?php _e('Print Sticker', OZON_PLUGIN_DOMAIN)?>
                                </a>
                            <?php endif?>
                            <?php if(!empty($package['document']) && !empty($package['document']['url'])):?>
                                <a href="<?php echo htmlspecialchars($package['document']['url']) ?>" target="_blank" class="button button-primary">
                                    <?php _e('Print Document', OZON_PLUGIN_DOMAIN)?>
                                </a>
                            <?php else:?>
                                <button type="button" class="button button-primary" id="create-document"
                                        data-order="<?php echo htmlspecialchars($data['id']) ?>"
                                        data-posting="<?php echo htmlspecialchars($package['postingId']) ?>"
                                >
                                    <?php _e('Create Document', OZON_PLUGIN_DOMAIN)?>
                                </button>
                            <?php endif?>
                        </div>
                        <div class="order-package-history">
                            <div class="order-package-history-title"><?php _e('History', OZON_PLUGIN_DOMAIN)?></div>
                            <div class="order-package-history-rows">
                                <?php if ($package['history']):
                                    foreach($package['history'] as $row):
                                    $date = new \DateTime($row['moment'])?>
                                    <div class="order-package-history-row">
                                        <div class="history-date"><?php echo htmlspecialchars($date->format('d.m.Y H:i:s')) ?></div>
                                        <div class="history-status"><?php echo htmlspecialchars($row['action']) ?></div>
                                    </div>
                                <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    </div>
<?php else:?>
    <div class="change-wrapper">
        <?php if(!empty($data['shipping']['title'])):?>
            <div class="shipping-info-wrapper">
                <?php if(!empty($data['shipping']['title'])):?>
                    <div class="shipping-info-title"><?php echo htmlspecialchars($data['shipping']['title']) ?></div>
                <?php endif;?>
                <?php if(!empty($data['shipping']['point']) && !empty($data['shipping']['point']['data'])):?>
                    <div class="shipping-info-point"><?php echo htmlspecialchars($data['shipping']['point']['data']->name) ?></div>
                <?php endif;?>
                <?php if(!empty($data['shipping']['address'])):?>
                    <div class="shipping-info-point"><?php echo htmlspecialchars($data['shipping']['address']) ?></div>
                <?php endif;?>
            </div>
        <?php endif?>
        <div class="od-form change-shipping-form">
            <?php if(!empty($data['shipping']['rates'])):?>
                <div class="form-row">
                    <?php foreach($data['shipping']['rates'] as $rate):
                        $rate_meta = $rate->get_meta_data();
                    ?>
                        <label>
                            <input type="radio" name="ozon_order[rate]" value="<?php echo htmlspecialchars($rate->get_id()) ?>"
                                <?php echo (!empty($data['shipping']['title']) && ($data['shipping']['title'] == $rate->get_label())) ? 'checked' : ''?>
                                data-name="<?php echo htmlspecialchars($rate->get_label()) ?>"
                                data-cost="<?php echo htmlspecialchars($rate->get_cost()) ?>"
                                data-variant="<?php echo htmlspecialchars($rate_meta['delivery_variant_id']) ?? 0?>"
                            />
                            <span><span class="rate-name"><?php echo $rate->get_label()?></span> (<b><?php echo wc_price($rate->get_cost())?></b>)</span>
                            <?php if ($rate->get_id() === 'ozon_shipping_method:pickup'):?>
                                <script>
                                    window.pickupPoints = [];

                                    <?php foreach($rate->get_meta_data() as $meta_data):?>
                                        pickupPoints.push({
                                          id: '<?php echo htmlspecialchars($meta_data->id); ?>',
                                          name: '<?php echo htmlspecialchars($meta_data->name); ?>',
                                          address: '<?php echo htmlspecialchars($meta_data->address); ?>',
                                          latitude: '<?php echo htmlspecialchars($meta_data->latitude); ?>',
                                          longitude: '<?php echo htmlspecialchars($meta_data->longitude); ?>'
                                        });
                                    <?php endforeach;?>
                                </script>
                                <a href="javascript:void(0);" class="button-map" data-od_popup="od-pickup-map-popup">
                                    <?php _e('Select on map', OZON_PLUGIN_DOMAIN)?>
                                </a>
                            <?php elseif ($rate->get_id() === 'ozon_shipping_method:postamat'):?>
                                <script>
                                    window.postamatPoints = [];

                                    <?php foreach($rate->get_meta_data() as $meta_data):?>
                                    postamatPoints.push({
                                        id: '<?php echo htmlspecialchars($meta_data->id); ?>',
                                        name: '<?php echo htmlspecialchars($meta_data->name); ?>',
                                        address: '<?php echo htmlspecialchars($meta_data->address); ?>',
                                        latitude: '<?php echo htmlspecialchars($meta_data->latitude); ?>',
                                        longitude: '<?php echo htmlspecialchars($meta_data->longitude); ?>'
                                    });
                                    <?php endforeach;?>
                                </script>
                                <a href="javascript:void(0);" class="button-map" data-od_popup="od-postamat-map-popup">
                                    <?php _e('Select on map', OZON_PLUGIN_DOMAIN)?>
                                </a>
                            <?php endif;?>
                        </label>
                    <?php endforeach;?>
                </div>
                <div class="form-row form-row-submit">
                    <button type="button" class="button button-primary" id="save-shipping-method"
                        data-order="<?php echo htmlspecialchars($data['id']) ?>"
                        <?php echo (!empty($data['shipping']['point']) ? 'data-point=\''. $data['shipping']['point']['json'] .'\'' : '')?>>
                        <?php _e('Save', OZON_PLUGIN_DOMAIN)?>
                    </button>
                </div>
            <?php endif?>
        </div>
        <a href="javascript:void(0);" id="change-shipping-method"><?php _e('Change')?></a>
    </div>
    <div class="create-order-form-wrapper">
        <div class="od-form create-order-form">
            <input type="hidden" name="ozon_action" value="od_send_order" class="ozon_form">
            <input type="hidden" name="ozon_order[order_id]" value="<?= $data['id'] ?>">

            <div class="form-row">
                <label for="order_name"><?php _e('Buyer First Name', OZON_PLUGIN_DOMAIN)?></label>
                <input type="text" name="ozon_order[first_name]" id="order_name" value="<?php echo htmlspecialchars($data['first_name']) ?>" />
            </div>
            <div class="form-row">
                <label for="order_name"><?php _e('Buyer Last Name', OZON_PLUGIN_DOMAIN)?></label>
                <input type="text" name="ozon_order[last_name]" id="order_name" value="<?php echo htmlspecialchars($data['last_name']) ?>" />
            </div>
            <div class="form-row">
                <label for="order_phone"><?php _e('Buyer Phone', OZON_PLUGIN_DOMAIN)?></label>
                <input type="text" name="ozon_order[phone]" id="order_phone" value="<?php echo htmlspecialchars($data['phone']) ?>" />
            </div>
            <div class="form-row">
                <label for="order_email"><?php _e('Buyer E-mail', OZON_PLUGIN_DOMAIN)?></label>
                <input type="text" name="ozon_order[email]" id="order_email" value="<?php echo htmlspecialchars($data['email']) ?>" />
            </div>
            <div class="form-row">
                <div><?php _e('Buyer Type', OZON_PLUGIN_DOMAIN)?></div>
                <label>
                    <input type="radio" name="ozon_order[type]" value="NaturalPerson" <?php if(empty($data['company'])):?>checked<?php endif; ?> />
                    <span><?php _e('Individual', OZON_PLUGIN_DOMAIN)?></span>
                </label>
                <label>
                    <input type="radio" name="ozon_order[type]" value="LegalPerson" <?php if(!empty($data['company'])):?>checked<?php endif; ?> />
                    <span><?php _e('Legal', OZON_PLUGIN_DOMAIN)?></span>
                </label>
            </div>
            <div class="form-row" id="company-wrapper" <?php echo (empty($data['company']) ? 'style="display: none;"' : '')?>>
                <label for="order_legal_name"><?php _e('Buyer Legal Name', OZON_PLUGIN_DOMAIN)?></label>
                <input type="text" name="ozon_order[legal_name]" id="order_legal_name" value="<?php echo htmlspecialchars($data['company']) ?>" />
            </div>
            <div class="form-row">
                <label for="order_email"><?php _e('Package Weight (kg)', OZON_PLUGIN_DOMAIN)?></label>
                <input type="text" name="ozon_order[package_weight]" id="order_package_weight"
                       value="
                       <?php echo htmlspecialchars(wc_get_weight($data['package']['weight'], 'kg', 'g')) ?>" />
            </div>
            <div class="form-row">
                <label for="package_length"><?php _e('Package Dimensions (cm)', OZON_PLUGIN_DOMAIN)?></label>
                <div class="form-column-flex">
                    <input type="text" name="ozon_order[package_length]" id="package_length" value="<?php echo htmlspecialchars(wc_get_dimension($data['package']['length'], 'cm', 'mm')) ?>" />
                    <span>x</span>
                    <input type="text" name="ozon_order[package_width]" id="package_width" value="<?php echo htmlspecialchars(wc_get_dimension($data['package']['width'], 'cm', 'mm')) ?>" />
                    <span>x</span>
                    <input type="text" name="ozon_order[package_height]" id="package_height" value="<?php echo htmlspecialchars(wc_get_dimension($data['package']['height'], 'cm', 'mm')) ?>" />
                </div>
            </div>
            <div class="form-row">
                <label for="packages">Товары в заказе</label>
                <div class="form-column-flex">
                    <a href="/?TB_inline&inlineId=my_id&width=600&height=550" class="thickbox">Управление товарами</a>
                </div>

                <div id="my_id" style="display:none;">
                    <h3>Товары в заказе</h3>

                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Артикул</th>
                                <th>Объявленная ценность</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                            </tr>
                        </thead>

                        <tbody>
                            <? $i = 0; foreach($data['basket'] as $itemBasket) { ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="ozon_order[basket][<?= esc_html($itemBasket['id']) ?>][title]" value="<?= $itemBasket['title'] ?>">
                                        <?= $itemBasket['title'] ?> [<?= $itemBasket['id'] ?>]
                                    </td>
                                    <td><input type="text" name="ozon_order[basket][<?= esc_html($itemBasket['id']) ?>][artnumber]" value="<?= esc_html($itemBasket['artnumber']) ?>"></td>
                                    <td><input type="text" name="ozon_order[basket][<?= esc_html($itemBasket['id']) ?>][cost]" value="<?= esc_html($itemBasket['cost']) ?>" style="width: 80px; text-align: right;"></td>
                                    <td><input type="text" name="ozon_order[basket][<?= esc_html($itemBasket['id']) ?>][price]" value="<?= esc_html($itemBasket['price']) ?>" style="width: 80px; text-align: right;" readonly="readonly"></td>
                                    <td><input type="text" name="ozon_order[basket][<?= esc_html($itemBasket['id']) ?>][quantity]" value="<?= esc_html($itemBasket['quantity']) ?>" style="width: 60px; text-align: right;" readonly="readonly"></td>
                                </tr>
                            <? $i++;} ?>
                        </tbody>
                    </table>

                    <div style="padding-top: 50px">
                        <button class="button blue" onclick="jQuery('#TB_closeWindowButton').trigger('click'); return false;">Закрыть</button>
                    </div>
                </div>
            </div>
            <?php if(!empty($data['shipping']['from_places'])):?>
                <div class="form-row">
                    <label for="order_from_place"><?php _e('From Warehouse', OZON_PLUGIN_DOMAIN)?></label>
                    <select name="ozon_order[from_place]" id="order_from_place">
                        <?php foreach($data['shipping']['from_places'] as $place):?>
                            <option value="<?php echo htmlspecialchars($place['id']) ?>"><?php echo $place['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            <?php endif;?>
            <div class="form-row">
                <label>
                    <input type="checkbox" name="ozon_order[full_paid]" value="1" <?php echo $data['full_paid'] ? 'checked' : '' ?> />

                    <span><?php _e('Full paid', OZON_PLUGIN_DOMAIN)?></span>
                </label>
            </div>
    <!--        <div class="form-row" id="paid-amount-wrapper">-->
    <!--            <label for="order_email">--><?//= sprintf(__('Payed (%s)', OZON_PLUGIN_DOMAIN), get_woocommerce_currency_symbol())?><!--</label>-->
    <!--            <input type="text" name="ozon_order[paid_amount]" id="order_paid_amount" value="--><?//= $data['paid_amount']?><!--" />-->
    <!--        </div>-->

            <div class="form-row">
                <label>
                    <input id="ozon_allow_uncovering" type="checkbox" name="ozon_order[allow_uncovering]" value="1" <?php echo $data['allow_uncovering'] || $data['chst'] ? 'checked' : '' ?> onchange="document.getElementById('ozon_chst').checked = this.checked" />
                    <span>Разрешить вскрытие отправления</span>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <input id="ozon_chst" type="checkbox" name="ozon_order[chst]" value="1" <?php echo $data['chst'] || $data['allow_uncovering'] ? 'checked' : '' ?> onchange="document.getElementById('ozon_allow_uncovering').checked = this.checked" />
                    <span>Разрешить частичную выдачу</span>
                </label>
            </div>


            <div class="form-row form-row-submit">
                <button type="button" class="button button-primary" id="send-order"
                    data-order="<?php echo htmlspecialchars($data['id']) ?>">
                    <?php _e('Send Order', OZON_PLUGIN_DOMAIN)?>
                </button>
            </div>
        </div>
    </div>
<?php endif;