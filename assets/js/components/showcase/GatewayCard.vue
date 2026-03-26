<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

defineProps<{
	eyebrow: string;
	title: string;
	description: string;
	href: string;
	status: string;
	highlights: string[];
	accent: "amber" | "cyan" | "violet";
}>();

const accentClasses = {
	amber: "from-yellow-300/20 via-yellow-400/5 to-transparent border-yellow-300/20 text-yellow-100 hover:border-yellow-300/40 hover:bg-yellow-300/10",
	cyan: "from-cyan-300/20 via-sky-400/5 to-transparent border-cyan-300/20 text-cyan-100 hover:border-cyan-300/40 hover:bg-cyan-300/10",
	violet: "from-violet-300/20 via-fuchsia-500/5 to-transparent border-violet-300/20 text-violet-100 hover:border-violet-300/40 hover:bg-violet-300/10",
};
</script>

<template>
	<Link :href="href" class="group block rounded-[1.75rem] border bg-white/5 p-6 transition duration-300" :class="accentClasses[accent]">
		<div class="space-y-5">
			<div class="flex items-center justify-between gap-4">
				<div>
					<p class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-400">
						{{ eyebrow }}
					</p>
					<h2 class="mt-3 text-2xl font-bold text-white sm:text-3xl">
						{{ title }}
					</h2>
				</div>
				<span class="rounded-full border border-white/10 bg-black/20 px-3 py-1 text-xs font-medium text-gray-200">
					{{ status }}
				</span>
			</div>

			<p class="text-base leading-7 text-gray-300">
				{{ description }}
			</p>

			<ul class="grid gap-2 text-sm leading-6 text-gray-300">
				<li v-for="highlight in highlights" :key="highlight" class="flex items-start gap-3">
					<span class="mt-1 h-2 w-2 rounded-full bg-current"></span>
					<span>{{ highlight }}</span>
				</li>
			</ul>

			<div class="pt-2 text-sm font-medium text-white transition group-hover:translate-x-1">
				Open module ->
			</div>
		</div>
	</Link>
</template>
