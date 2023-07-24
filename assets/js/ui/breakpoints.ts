/**
 * sm => 640px
 * md => 768px
 * lg => 1024px
 * xl => 1280px
 * 2xl => 1536px
 */

export function isMobile() {
	return window.matchMedia("(max-width: 639px)").matches;
}

export function isTablet() {
	return window.matchMedia("(min-width:640px) and (max-width: 1023px)").matches;
}

export function isDesktop() {
	return window.matchMedia("(min-width: 1024px)").matches;
}
