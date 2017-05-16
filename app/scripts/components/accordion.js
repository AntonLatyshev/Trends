export function initAccordion() {
	if ($(window).width() < 1250) {
		jQuery('.nav').slideAccordion({
			activeClass: 'active-link',
	    opener: '> .parent > a',
			slider: '> .parent > ul',
			animSpeed: 300
		});
	}
}
