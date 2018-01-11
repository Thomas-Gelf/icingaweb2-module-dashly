(function(Icinga) {

    var Dashly = function(module) {
        this.module = module;
        this.initialize();
        this.module.icinga.logger.debug('Dashly module loaded');
    };

    Dashly.prototype = {
        initialize: function()
        {
            this.module.on('rendered', this.rendered);
        },

        rendered: function (event) {
            var $container = $(event.target);
            if ($container.closest('.gridster').length > 0) {
                // Event triggered from sub-element?
                return;
            }

            $container.find('.gridster').gridster({
                widget_base_dimensions: [160, 160],
                // widget_base_dimensions: ['auto', 'auto'],
                widget_selector: '.gridster-dashlet',
                // autogenerate_stylesheet: true,
                min_cols: 1,
                max_cols: 6,
                widget_margins: [5, 5],
                resize: {
                    enabled: true
                }
            });

            $('.gridster > div > div.container', $container).each(function(idx, el) {
                var $element = $(el);
                var $url = $element.data('icingaUrl');
                if (typeof $url !== 'undefined') {
                    icinga.loader.loadUrl($url, $element).autorefresh = true;
                }
            });
        }
    };

    Icinga.availableModules.dashly = Dashly;

}(Icinga));
