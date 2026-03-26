import "./../css/tailwind.css";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import { init as initNette } from "./ui/nette";

declare global {
	interface Window {
		__uiSkeletonBooted?: boolean;
		Alpine: typeof Alpine;
	}
}

if (!window.__uiSkeletonBooted) {
	Alpine.plugin(collapse);
	window.Alpine = Alpine;
	Alpine.start();
	initNette();
	window.__uiSkeletonBooted = true;
}
