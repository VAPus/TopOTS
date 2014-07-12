var App = function () {

    var handleUniform = function () {
        if (!jQuery().uniform) {
            return;
        }
        var test = jQuery("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
        if (test.size() > 0) {
            test.each(function () {
                    if (jQuery(this).parents(".checker").size() == 0) {
                        jQuery(this).show();
                        jQuery(this).uniform();
                    }
                });
        }
    }

    return {
        init: function () {
            handleUniform();   
        },

        // initializes uniform elements
        initUniform: function (els) {

            if (els) {
                jQuery(els).each(function () {
                        if (jQuery(this).parents(".checker").size() == 0) {
                                jQuery(this).show();
                                jQuery(this).uniform();
                            }
                        });
                } else {
                    handleUniform();
                }

        }

    };

}();
