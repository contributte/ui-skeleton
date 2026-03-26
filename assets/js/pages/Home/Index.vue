<script setup lang="ts">
import GatewayCard from "@/components/showcase/GatewayCard.vue";
import SectionHeading from "@/components/showcase/SectionHeading.vue";
import ShowcaseShell from "@/components/showcase/ShowcaseShell.vue";

defineProps<{
	title: string;
	tagline: string;
	intro: string;
	cards: Array<{
		id: string;
		eyebrow: string;
		title: string;
		description: string;
		href: string;
		status: string;
		highlights: string[];
	}>;
	stackPillars: Array<{
		label: string;
		description: string;
	}>;
	links: Array<{
		label: string;
		url: string;
	}>;
}>();

const accents: Record<string, "amber" | "cyan" | "violet"> = {
	inertia: "amber",
	widgets: "cyan",
	vue: "violet",
};
</script>

<template>
	<ShowcaseShell
		eyebrow="Signal Stack"
		:title="title"
		:tagline="tagline"
		:summary="intro"
		theme="amber"
	>
		<div class="space-y-14">
			<section class="grid gap-5 lg:grid-cols-3">
				<GatewayCard
					v-for="card in cards"
					:key="card.id"
					:eyebrow="card.eyebrow"
					:title="card.title"
					:description="card.description"
					:href="card.href"
					:status="card.status"
					:highlights="card.highlights"
					:accent="accents[card.id] ?? 'amber'"
				/>
			</section>

			<section class="grid gap-8 lg:grid-cols-[minmax(0,1.15fr)_minmax(280px,0.85fr)]">
				<div class="space-y-6 rounded-[1.75rem] border border-white/10 bg-black/20 p-6 sm:p-8">
					<SectionHeading
						eyebrow="Why this skeleton exists"
						title="Three rendering models, one repo"
						description="Each destination is intentionally different. One uses the Inertia protocol, one stays classic with Latte and Alpine, and one mounts a standalone Vue workspace without Inertia."
					/>

					<div class="grid gap-4">
						<article
							v-for="pillar in stackPillars"
							:key="pillar.label"
							class="rounded-2xl border border-white/10 bg-white/5 p-5"
						>
							<h3 class="text-lg font-semibold text-white">
								{{ pillar.label }}
							</h3>
							<p class="mt-2 text-sm leading-7 text-gray-400">
								{{ pillar.description }}
							</p>
						</article>
					</div>
				</div>

				<aside class="space-y-6 rounded-[1.75rem] border border-white/10 bg-white/5 p-6 sm:p-8">
					<SectionHeading
						eyebrow="External references"
						title="Keep one foot in the ecosystem"
						description="The showcase pages stay local and opinionated, but the underlying ideas are grounded in the broader Inertia, Nette, and Contributte ecosystem."
					/>

					<nav class="space-y-3">
						<a
							v-for="link in links"
							:key="link.url"
							:href="link.url"
							target="_blank"
							rel="noreferrer noopener"
							class="group flex items-center justify-between rounded-2xl border border-white/10 bg-black/20 px-4 py-3 text-gray-100 transition hover:border-yellow-300/30 hover:bg-yellow-300/10"
						>
							<span class="font-medium">{{ link.label }}</span>
							<span class="text-sm text-gray-400 transition group-hover:text-yellow-200">Open</span>
						</a>
					</nav>

					<div class="rounded-2xl border border-dashed border-white/10 bg-black/20 p-5 text-sm leading-7 text-gray-400">
						Start with <span class="font-semibold text-yellow-100">Pulse Protocol</span> for the full Inertia app, move to <span class="font-semibold text-cyan-100">Widget Workshop</span> for pure Latte plus Alpine patterns, and end in <span class="font-semibold text-violet-100">Vue Workbench</span> for a client-owned workspace without Inertia.
					</div>
				</aside>
			</section>
		</div>
	</ShowcaseShell>
</template>
