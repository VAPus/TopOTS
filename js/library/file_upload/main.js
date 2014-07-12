var FormFileUpload = function () {

    return {
        //main function to initiate the module
        init: function () {

            // Initialize the jQuery File Upload widget:
            jQuery('#fileupload').fileupload({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: 'server/php/'
            });

            // Load existing files:
            // Demo settings:
            jQuery.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: jQuery('#fileupload').fileupload('option', 'url'),
                dataType: 'json',
                context: jQuery('#fileupload')[0],
                maxFileSize: 5000000,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)jQuery/i,
                process: [{
                        action: 'load',
                        fileTypes: /^image\/(gif|jpeg|png)jQuery/,
                        maxFileSize: 20000000 // 20MB
                    }, {
                        action: 'resize',
                        maxWidth: 1440,
                        maxHeight: 900
                    }, {
                        action: 'save'
                    }
                ]
            }).done(function (result) {
                jQuery(this).fileupload('option', 'done')
                    .call(this, null, {
                    result: result
                });
            });

            // Upload server status check for browsers with CORS support:
            if (jQuery.support.cors) {
                jQuery.ajax({
                    url: 'server/php/',
                    type: 'HEAD'
                }).fail(function () {
                    jQuery('<span class="alert alert-error"/>')
                        .text('Upload server currently unavailable - ' +
                        new Date())
                        .appendTo('#fileupload');
                });
            }

            // initialize uniform checkboxes  
            App.initUniform('.uniform');
        }

    };

}();