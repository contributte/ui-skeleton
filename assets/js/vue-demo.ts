import { createApp } from "vue";
import DemoApp from "./pages/Vue/DemoApp.vue";

const target = document.querySelector<HTMLElement>("#vue-demo");
const payload = document.querySelector<HTMLScriptElement>("#vue-demo-props");

if (target !== null) {
	const props = payload?.textContent ? JSON.parse(payload.textContent) : {};
	createApp(DemoApp, props).mount(target);
}
