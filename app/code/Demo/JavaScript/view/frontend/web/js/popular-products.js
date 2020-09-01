define([
        'jquery',
        'uiComponent',
        'ko',
        'mage/translate'
    ], function ($, Component, ko, $t) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Demo_JavaScript/popular-products',
                title: $t('MAX'),
                products: [],
            },
            getTitle: function () {
                return this.title;
            }
        });
    }
);
