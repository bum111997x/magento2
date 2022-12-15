/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Checkout/js/view/summary/abstract-total'
], function (viewModel) {
    'use strict';

    return viewModel.extend({
        defaults: {
            displayArea: 'after_details',
            template: 'Cowell_ProductShippingMethod/checkout/summary/item/details/shipping_fee'
        },

        /**
         * @param {Object} quoteItem
         * @return {*|String}
         */
        getValue: function (quoteItem) {
            console.log(quoteItem.extension_attributes)
            return this.getFormattedPrice(quoteItem.extension_attributes.payment_fee);
        }
    });
});
