import { Alpine } from "./3rd/alpine";

// UI
import { init as initNette } from "./ui/nette";

// CSS
import "./../css/tailwind.css";

window.addEventListener("load", () => {
	// Alpine global
	// @ts-ignore
	window.Alpine = Alpine;

	// Alpine data
	Alpine.data('layout', () => ({}));

	// Initialize Alpine
	Alpine.start();
});

document.addEventListener("DOMContentLoaded", () => {
	// UI
	initNette();
});

