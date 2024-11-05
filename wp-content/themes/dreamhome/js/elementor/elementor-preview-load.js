;(function($) {
    "use strict";

    jQuery(document).ready(function(){
        //Header
        elementor.settings.page.addChangeCallback( 'style_header', handleReloadPreview );
    });

    function handleReloadPreview ( newValue ) {
        elementor.saver.saveEditor({
            status: elementor.settings.page.model.get('post_status'),
            onSuccess: () => {
                elementor.reloadPreview();

                elementor.once("preview:loaded", function() {
                    elementor.getPanelView().setPage("page_settings");
                });
            }
        })
    }

})(jQuery);