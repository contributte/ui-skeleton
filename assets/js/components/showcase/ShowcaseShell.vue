<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

type NavigationItem = {
	key: string;
	label: string;
	href: string;
	active: boolean;
};

withDefaults(defineProps<{
	eyebrow: string;
	title: string;
	tagline: string;
	summary?: string;
	navigation?: NavigationItem[];
	theme?: "amber" | "cyan" | "violet";
}>(), {
	summary: "",
	navigation: () => [],
	theme: "amber",
});

const themeClasses = {
	amber: {
		pill: "border-yellow-300/30 bg-yellow-300/10 text-yellow-200",
		glow: "shadow-yellow-500/10",
		panel: "from-yellow-300/16 via-transparent to-sky-400/16",
		active: "border-yellow-300/40 bg-yellow-300/15 text-yellow-100",
	},
	cyan: {
		pill: "border-cyan-300/30 bg-cyan-300/10 text-cyan-200",
		glow: "shadow-cyan-500/10",
		panel: "from-cyan-300/16 via-transparent to-blue-500/16",
		active: "border-cyan-300/40 bg-cyan-300/15 text-cyan-100",
	},
	violet: {
		pill: "border-violet-300/30 bg-violet-300/10 text-violet-200",
		glow: "shadow-violet-500/10",
		panel: "from-violet-300/16 via-transparent to-fuchsia-500/16",
		active: "border-violet-300/40 bg-violet-300/15 text-violet-100",
	},
};
</script>

<template>
	<div class="min-h-screen overflow-hidden">
		<div class="mx-auto flex min-h-screen max-w-7xl flex-col px-6 py-8 sm:px-10 lg:px-12">
			<div class="mb-6 flex flex-wrap items-center justify-between gap-3 text-sm text-gray-400">
				<Link
					href="/"
					class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 font-medium text-gray-100 transition hover:border-white/20 hover:bg-white/10"
				>
					<span class="text-yellow-200">Signal Stack</span>
					<span class="text-gray-500">/</span>
					<span>Contributte UI Skeleton</span>
				</Link>

				<nav v-if="navigation.length > 0" class="flex flex-wrap gap-2">
					<Link
						v-for="item in navigation"
						:key="item.key"
						:href="item.href"
						class="rounded-full border px-4 py-2 transition"
						:class="item.active ? themeClasses[theme].active : 'border-white/10 bg-white/5 text-gray-300 hover:border-white/20 hover:bg-white/10 hover:text-white'"
					>
						{{ item.label }}
					</Link>
				</nav>
			</div>

			<div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 shadow-2xl backdrop-blur" :class="themeClasses[theme].glow">
				<div class="absolute inset-0 bg-gradient-to-br" :class="themeClasses[theme].panel"></div>
				<div class="relative px-8 py-10 md:px-12 md:py-14">
					<div class="max-w-4xl space-y-5">
						<p class="inline-flex items-center rounded-full border px-4 py-1 text-xs font-semibold uppercase tracking-[0.28em]" :class="themeClasses[theme].pill">
							{{ eyebrow }}
						</p>
						<h1 class="max-w-4xl text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">
							{{ title }}
						</h1>
						<p class="max-w-3xl text-lg leading-8 text-gray-200 sm:text-xl">
							{{ tagline }}
						</p>
						<p v-if="summary" class="max-w-3xl text-base leading-7 text-gray-400 sm:text-lg">
							{{ summary }}
						</p>
					</div>

					<div class="mt-10">
						<slot />
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
