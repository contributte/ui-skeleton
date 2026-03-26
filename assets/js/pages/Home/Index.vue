<script setup lang="ts">
defineProps<{
	title: string;
	tagline: string;
	features: string[];
	links: Array<{
		label: string;
		url: string;
	}>;
}>();
</script>

<template>
	<div class="min-h-screen overflow-hidden">
		<div class="mx-auto flex min-h-screen max-w-6xl flex-col justify-center px-6 py-12 sm:px-10 lg:px-12">
			<div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 shadow-2xl shadow-yellow-500/10 backdrop-blur">
				<div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(251,191,36,0.22),_transparent_30%),radial-gradient(circle_at_bottom_left,_rgba(14,165,233,0.18),_transparent_28%)]"></div>
				<div class="relative grid gap-10 px-8 py-10 md:grid-cols-[minmax(0,1.2fr)_minmax(280px,0.8fr)] md:px-12 md:py-14">
					<section class="space-y-8">
						<div class="space-y-4">
							<p class="inline-flex items-center rounded-full border border-yellow-300/30 bg-yellow-300/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-yellow-200">
								Inertia demo
							</p>
							<h1 class="max-w-3xl text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">
								{{ title }}
							</h1>
							<p class="max-w-2xl text-lg leading-8 text-gray-300 sm:text-xl">
								{{ tagline }}
							</p>
						</div>

						<div class="grid gap-4 sm:grid-cols-3">
							<article
								v-for="feature in features"
								:key="feature"
								class="rounded-2xl border border-white/10 bg-gray-900/55 p-5 text-sm leading-6 text-gray-200"
							>
								{{ feature }}
							</article>
						</div>
					</section>

					<aside class="rounded-[1.5rem] border border-white/10 bg-black/20 p-6">
						<div class="space-y-5">
							<div>
								<p class="text-xs font-semibold uppercase tracking-[0.28em] text-blue-200/80">
									Explore
								</p>
								<h2 class="mt-3 text-2xl font-bold text-white">
									Useful links
								</h2>
							</div>

							<nav class="space-y-3">
								<a
									v-for="link in links"
									:key="link.url"
									:href="link.url"
									target="_blank"
									rel="noreferrer noopener"
									class="group flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-gray-100 hover:border-yellow-300/40 hover:bg-yellow-300/10"
								>
									<span class="font-medium">{{ link.label }}</span>
									<span class="text-sm text-gray-400 transition group-hover:text-yellow-200">Open</span>
								</a>
							</nav>

							<p class="text-sm leading-7 text-gray-400">
								This page is rendered by a Nette presenter and hydrated by Vue through Inertia.js.
							</p>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</template>
