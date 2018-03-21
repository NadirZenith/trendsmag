/* 
 * add menu switcher and hide menu below given width
 */
;
(function ($, window, document, undefined) {

    var pluginName = 'nzMenuReplace';

    function Plugin(element, options) {

        this.element = element;
        this._name = pluginName;
        this._defaults = $.fn.nzMenuReplace.defaults;
        this.options = $.extend({}, this._defaults, options);

        this.init();
    }

    $.extend(Plugin.prototype, {
        init: function () {
            this.buildCache();
            this.bindEvents();
            /*this.onScreenResize();*/
        },
        destroy: function () {
            this.unbindEvents();
            this.$element.removeData();
        },
        buildCache: function () {
            this.$element = $(this.element);
            this.$window = $(window);

            this.$icon_btn = $('<a class="nzMenuReplace"></a>').append(this.options.tpl.icon);

            this.$element.after(
                    this.$icon_btn
                    );
        },
        bindEvents: function () {
            var plugin = this;

            plugin.$window.on('resize' + '.' + plugin._name, function () {
                plugin.onScreenResize.call(plugin);
            });

            plugin.$icon_btn.on('click' + '.' + plugin._name, function () {
                plugin.onBtnClick.call(plugin);
            });
        },
        unbindEvents: function () {
            this.$element.off('.' + this._name);
        },
        onScreenResize: function () {
            if (this.$window.width() < this.options.min_width) {
                this.$element.css({
                    opacity: '0',
                    visibility: 'hidden'
                });

                this.$icon_btn.show();
            } else {
                this.$element.css({
                    opacity: '1',
                    visibility: 'visible'
                });

                this.$icon_btn.hide();
            }
        },
        onBtnClick: function () {
            if (this.$element.css('opacity') == 1) {
                this.$element.css({
                    opacity: '0',
                    visibility: 'hidden'
                });

            } else {
                this.$element.css({
                    opacity: '1',
                    visibility: 'visible'
                });
            }
        }
    });

    $.fn.nzMenuReplace = function (options) {
        this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
        return this;
    };

    $.fn.nzMenuReplace.defaults = {
        tpl: {
            icon: '<i class="fa fa-align-justify"></i>'
        },
        min_width: 768
    };

})(jQuery, window, document);