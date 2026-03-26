<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import SectionHeading from "@/components/showcase/SectionHeading.vue";
import ShowcaseShell from "@/components/showcase/ShowcaseShell.vue";

defineProps<{
	navigation: Array<{
		key: string;
		label: string;
		href: string;
		active: boolean;
	}>;
	hero: {
		eyebrow: string;
		title: string;
		tagline: string;
		summary: string;
	};
	pillars: Array<{
		title: string;
		description: string;
	}>;
	flow: Array<{
		label: string;
		description: string;
	}>;
	examples: Array<{
		title: string;
		summary: string;
	}>;
	resources: Array<{
		label: string;
		url: string;
	}>;
}>();
</script>

<template>
	<ShowcaseShell
		:navigation="navigation"
		:eyebrow="hero.eyebrow"
		:title="hero.title"
		:tagline="hero.tagline"
		:summary="hero.summary"
		theme="amber"
	>
		<div class="grid gap-8 xl:grid-cols-[minmax(0,1.15fr)_minmax(320px,0.85fr)]">
			<div class="space-y-8">
				<section class="rounded-[1.75rem] border border-white/10 bg-black/20 p-6 sm:p-8">
					<SectionHeading
						eyebrow="Lifecycle"
						title="From Nette intent to hydrated page"
						description="The point is not to erase the server. The point is to let the server own intent while the client owns polish."
					/>

					<ol class="mt-8 space-y-4">
						<li v-for="(item, index) in flow" :key="item.label" class="flex gap-4 rounded-2xl border border-white/10 bg-white/5 p-5">
							<div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-yellow-300/30 bg-yellow-300/10 font-semibold text-yellow-200">
								{{ index + 1 }}
							</div>
							<div>
								<h3 class="text-lg font-semibold text-white">
									{{ item.label }}
								</h3>
								<p class="mt-2 text-sm leading-7 text-gray-400">
									{{ item.description }}
								</p>
							</div>
						</li>
					</ol>
				</section>

				<section class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6 sm:p-8">
					<SectionHeading
						eyebrow="Feature pillars"
						title="Why this module matters"
						description="Each pillar corresponds to behavior already implemented in the server adapter and surfaced by this skeleton."
					/>

					<div class="mt-8 grid gap-4 sm:grid-cols-3">
						<article v-for="pillar in pillars" :key="pillar.title" class="rounded-2xl border border-white/10 bg-black/20 p-5">
							<h3 class="text-lg font-semibold text-white">
								{{ pillar.title }}
							</h3>
							<p class="mt-2 text-sm leading-7 text-gray-400">
								{{ pillar.description }}
							</p>
						</article>
					</div>
				</section>
			</div>

			<aside class="space-y-8">
				<section class="rounded-[1.75rem] border border-white/10 bg-black/20 p-6 sm:p-8">
					<SectionHeading
						eyebrow="Practical patterns"
						title="What to carry into real pages"
						description="These examples describe the shape of useful Inertia pages in a Nette application, not just the protocol itself."
					/>

					<div class="mt-8 space-y-4">
						<article v-for="example in examples" :key="example.title" class="rounded-2xl border border-white/10 bg-white/5 p-5">
							<h3 class="text-lg font-semibold text-white">
								{{ example.title }}
							</h3>
							<p class="mt-2 text-sm leading-7 text-gray-400">
								{{ example.summary }}
							</p>
						</article>
					</div>
				</section>

				<section class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6 sm:p-8">
					<SectionHeading
						eyebrow="Explore further"
						title="Reference points"
						description="Use the original protocol docs as a companion while reading this local implementation."
					/>

					<nav class="mt-8 space-y-3">
						<a v-for="resource in resources" :key="resource.url" :href="resource.url" target="_blank" rel="noreferrer noopener" class="flex items-center justify-between rounded-2xl border border-white/10 bg-black/20 px-4 py-3 text-gray-100 transition hover:border-yellow-300/30 hover:bg-yellow-300/10">
							<span>{{ resource.label }}</span>
							<span class="text-sm text-gray-400">Open</span>
						</a>
					</nav>

					<div class="mt-6 rounded-2xl border border-dashed border-yellow-300/20 bg-yellow-300/10 p-5 text-sm leading-7 text-yellow-100/90">
						Want the opposite setup? <Link :href="navigation.find((item) => item.key === 'widgets')?.href ?? '/'" class="font-semibold text-white underline decoration-yellow-300/40 underline-offset-4">Widget Workshop</Link> keeps the page server-rendered and only sprinkles Alpine on top.
					</div>
				</section>
			</aside>
		</div>
	</ShowcaseShell>
</template>
