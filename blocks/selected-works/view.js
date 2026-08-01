/**
 * Selected Works — vanilla hover tooltip (replaces jQuery + hoverIntent).
 */
( function () {
	const HOVER_DELAY = 50;

	/**
	 * @param {HTMLElement} root
	 */
	function initSelectedWorks( root ) {
		const tooltip = root.querySelector( '.selected-works__tooltip' );
		const tooltipLabel = root.querySelector(
			'.selected-works__tooltip-label'
		);
		const links = root.querySelectorAll( '.selected-works__link' );

		if ( ! tooltip || ! tooltipLabel || ! links.length ) {
			return;
		}

		let enterTimer = null;

		/**
		 * @param {HTMLElement} link
		 */
		function showTooltip( link ) {
			const label = link.querySelector( 'span' );
			if ( ! label ) {
				return;
			}

			const linkRect = link.getBoundingClientRect();
			const rootRect = root.getBoundingClientRect();
			const tooltipSize = tooltip.offsetWidth * 0.5;
			const sizeLeft = tooltipSize - linkRect.width * 0.5;
			const sizeTop = tooltipSize + linkRect.height * 0.5;
			const x = linkRect.left - rootRect.left - sizeLeft;
			const y = linkRect.top - rootRect.top - sizeTop;

			tooltipLabel.innerHTML = label.innerHTML;
			tooltip.style.transform = `translate(${ x }px, ${ y }px)`;
		}

		links.forEach( ( link ) => {
			link.addEventListener( 'pointerenter', () => {
				clearTimeout( enterTimer );
				enterTimer = setTimeout( () => {
					showTooltip( link );
				}, HOVER_DELAY );
			} );

			link.addEventListener( 'pointerleave', () => {
				clearTimeout( enterTimer );
			} );
		} );
	}

	document.addEventListener( 'DOMContentLoaded', () => {
		document
			.querySelectorAll( '.selected-works' )
			.forEach( ( root ) => initSelectedWorks( root ) );
	} );
} )();
