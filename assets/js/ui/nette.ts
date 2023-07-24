import naja from "naja";
import netteForms from "nette-forms";

naja.uiHandler.addEventListener("interaction", (event) => {
	if (event.detail.element.hasAttribute("data-confirm")
		&& !window.confirm(event.detail.element.getAttribute("data-confirm"))
	) {
		event.preventDefault();
	}
});

export function init() {
	naja.formsHandler.netteForms = netteForms;
	naja.initialize();
}
