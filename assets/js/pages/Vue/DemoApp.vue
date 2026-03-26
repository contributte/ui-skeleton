<script setup lang="ts">
import { computed, ref } from "vue";

type ActivityItem = {
	title: string;
	time: string;
	state: "ok" | "pending" | "warning";
};

const props = defineProps<{
	metrics: Array<{
		label: string;
		value: string;
		change: string;
	}>;
	panels: Array<{
		title: string;
		description: string;
	}>;
	activity: ActivityItem[];
}>();

const query = ref("");
const showOnlyPending = ref(false);
const compactMode = ref(false);
const activeView = ref<"board" | "list">("board");

const filteredActivity = computed(() => props.activity.filter((item) => {
	const matchesQuery = query.value === "" || item.title.toLowerCase().includes(query.value.toLowerCase());
	const matchesState = !showOnlyPending.value || item.state === "pending";

	return matchesQuery && matchesState;
}));

const stateClasses: Record<ActivityItem["state"], string> = {
	ok: "border-emerald-300/25 bg-emerald-300/10 text-emerald-100",
	pending: "border-yellow-300/25 bg-yellow-300/10 text-yellow-100",
	warning: "border-rose-300/25 bg-rose-300/10 text-rose-100",
};
</script>

<template>
	<div class="space-y-8">
		<div class="rounded-[1.75rem] border border-gray-200 bg-white p-6 shadow-sm">
			<div class="flex flex-wrap items-start justify-between gap-6">
				<div class="max-w-3xl">
					<p class="text-xs font-semibold uppercase tracking-[0.28em] text-violet-500">Pure Vue app</p>
					<h1 class="mt-3 text-4xl font-black tracking-tight text-gray-950">Vue Workbench</h1>
					<p class="mt-4 text-lg leading-8 text-gray-600">This route is a normal Latte page with a dedicated Vue mount point. No Inertia protocol, no `data-page` envelope, just a focused client app running inside the existing Nette shell.</p>
				</div>

				<div class="flex flex-wrap gap-3">
					<button class="rounded-full border px-4 py-2 text-sm transition" :class="activeView === 'board' ? 'border-violet-300 bg-violet-50 text-violet-700' : 'border-gray-200 text-gray-600 hover:border-violet-300 hover:text-violet-700'" @click="activeView = 'board'">Board view</button>
					<button class="rounded-full border px-4 py-2 text-sm transition" :class="activeView === 'list' ? 'border-violet-300 bg-violet-50 text-violet-700' : 'border-gray-200 text-gray-600 hover:border-violet-300 hover:text-violet-700'" @click="activeView = 'list'">List view</button>
				</div>
			</div>
		</div>

		<section class="grid gap-4 md:grid-cols-3">
			<article v-for="metric in metrics" :key="metric.label" class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
				<p class="text-sm font-medium text-gray-500">{{ metric.label }}</p>
				<p class="mt-4 text-4xl font-black text-gray-950">{{ metric.value }}</p>
				<p class="mt-3 text-sm text-violet-600">{{ metric.change }}</p>
			</article>
		</section>

		<section class="grid gap-8 xl:grid-cols-[280px_minmax(0,1fr)_320px]">
			<aside class="space-y-6 rounded-[1.75rem] border border-gray-200 bg-white p-6 shadow-sm">
				<div>
					<p class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-500">Workbench</p>
					<h2 class="mt-3 text-2xl font-bold text-gray-950">Local control surface</h2>
					<p class="mt-3 text-sm leading-7 text-gray-600">This side of the page exists purely for client-owned controls and does not need to round-trip through Inertia.</p>
				</div>

				<div class="space-y-4">
					<label class="block text-sm text-gray-700">
						<span class="mb-2 block font-medium text-gray-950">Search activity</span>
						<input v-model="query" type="text" placeholder="Filter by title" class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 placeholder:text-gray-400 focus:border-violet-300 focus:bg-white focus:outline-none focus:ring-0" />
					</label>

					<label class="flex items-center justify-between rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">
						<span>Only pending items</span>
						<input v-model="showOnlyPending" type="checkbox" class="rounded border-gray-300 text-violet-500 focus:ring-violet-300" />
					</label>

					<label class="flex items-center justify-between rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">
						<span>Compact mode</span>
						<input v-model="compactMode" type="checkbox" class="rounded border-gray-300 text-violet-500 focus:ring-violet-300" />
					</label>
				</div>

				<div class="space-y-3">
					<article v-for="panel in panels" :key="panel.title" class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
						<h3 class="text-base font-semibold text-gray-950">{{ panel.title }}</h3>
						<p class="mt-2 text-sm leading-7 text-gray-600">{{ panel.description }}</p>
					</article>
				</div>
			</aside>

			<section class="rounded-[1.75rem] border border-gray-200 bg-white p-6 shadow-sm">
				<div class="flex flex-wrap items-center justify-between gap-4">
					<div>
						<p class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-500">Workspace</p>
						<h2 class="mt-3 text-2xl font-bold text-gray-950">{{ activeView === 'board' ? 'Board canvas' : 'List console' }}</h2>
					</div>
					<p class="text-sm text-gray-500">{{ filteredActivity.length }} items shown</p>
				</div>

				<div class="mt-8" :class="activeView === 'board' ? 'grid gap-4 md:grid-cols-2' : 'space-y-4'">
					<article
						v-for="item in filteredActivity"
						:key="item.title"
						class="rounded-2xl border border-gray-200 bg-gray-50 transition"
						:class="compactMode ? 'px-4 py-3' : 'px-5 py-5'"
					>
						<div class="flex flex-wrap items-center justify-between gap-3">
							<div>
								<h3 class="text-lg font-semibold text-gray-950">{{ item.title }}</h3>
								<p class="mt-1 text-sm text-gray-500">{{ item.time }}</p>
							</div>
							<span class="rounded-full border px-3 py-1 text-xs font-medium uppercase tracking-[0.2em]" :class="stateClasses[item.state]">
								{{ item.state }}
							</span>
						</div>
					</article>

					<div v-if="filteredActivity.length === 0" class="rounded-2xl border border-dashed border-gray-300 px-5 py-8 text-center text-sm leading-7 text-gray-500">
						No activity matches the current filters. This is all local page state managed by Vue only.
					</div>
				</div>
			</section>

			<aside class="space-y-6 rounded-[1.75rem] border border-gray-200 bg-white p-6 shadow-sm">
				<div>
					<p class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-500">Why this route exists</p>
					<h2 class="mt-3 text-2xl font-bold text-gray-950">A Vue app without Inertia in the middle</h2>
				</div>

				<div class="space-y-4 text-sm leading-7 text-gray-600">
					<p>Use this shape when the page is effectively a self-contained tool and the client should own filtering, view state, and contextual interactions.</p>
					<p>The surrounding Nette page still exists, but the app itself mounts through its own Vite entrypoint and does not depend on the Inertia protocol.</p>
					<p>That makes the contrast with the Inertia route explicit rather than conceptual.</p>
				</div>
			</aside>
		</section>
	</div>
</template>
