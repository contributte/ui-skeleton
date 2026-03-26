<script setup lang="ts">
defineProps<{
	eyebrow: string;
	title: string;
	description: string;
}>();
</script>

<template>
	<div class="max-w-3xl space-y-3">
		<p class="text-xs font-semibold uppercase tracking-[0.28em] text-gray-500">
			{{ eyebrow }}
		</p>
		<h2 class="text-2xl font-bold text-white sm:text-3xl">
			{{ title }}
		</h2>
		<p class="text-base leading-7 text-gray-400 sm:text-lg">
			{{ description }}
		</p>
	</div>
</template>
