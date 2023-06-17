// jQuery
(function($) {
    const $tooltip = $('.selected-works__tooltip');
    const $tooltipLabel = $('.selected-works__tooltip-label');
    const $selectedWorks = $('.selected-works');

    $('.selected-works__link').on('mouseenter', function() {
        const $this = $(this);
        const text = $this.find('span').html();
        const xy = $this.offset();
        const sizeTooltip = $tooltip.width() * 0.5;
        const sizeLeft = sizeTooltip - $this.width() * 0.5;
        const sizeTop = sizeTooltip + $this.height() * 0.5;
        const refXy = $selectedWorks.offset();
        $tooltipLabel.html(text);
        $tooltip.css({
            transform: 'translate(' + (xy.left - refXy.left - sizeLeft) + 'px, ' + (xy.top - refXy.top - sizeTop) + 'px)'
        });
    });
})(jQuery);

