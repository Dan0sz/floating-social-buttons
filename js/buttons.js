/**
 * @author Daan van den Bergh
 * @package social-share-buttons
 * @url https://daan.dev
 * @copyright Daan van den Bergh (c) 2019
 */

let $ssbWindow = jQuery(window);

$ssbWindow.scroll(function() {
    /**
     * Selectors we're going to use.
     */
    widget = jQuery('.share-buttons-container');
    widgetClone = jQuery('.share-buttons-container-clone');
    
    /**
     * Make sure widgetClone has correct width, since its
     * position is fixed.
     */
    widgetWidth = widget.width();
    widgetClone.width(widgetWidth);
    
    /**
     * Only appear if widget reaches top of screen.
     */
    navbarHeight = jQuery('nav.navbar').height();
    widgetOffset = widget.offset().top - navbarHeight;
    
    if ($ssbWindow.scrollTop() >= widgetOffset) {
        widget.css('opacity', '0');
        widgetClone.css('top', navbarHeight);
        widgetClone.show();
    } else {
        widget.css('opacity', '1');
        widgetClone.hide();
    }
});
