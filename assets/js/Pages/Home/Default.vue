<script setup lang="ts">
/**
 * Example Vue 3 Inertia Page Component
 *
 * This is an example page component for the Home/Default action.
 * The component name matches the presenter/action path: Home/Default
 */

// Define props received from the presenter
defineProps<{
	title: string;
	message: string;
	items?: string[];
}>();
</script>

<template>
	<div class="antialiased px-6 text-gray-900">
		<div class="divide-y max-w-xl md:max-w-4xl mx-auto">
			<div class="py-8">
				<h1 class="font-bold text-3xl">
					{{ title }}
				</h1>
			</div>

			<div class="py-8">
				<p class="text-lg text-gray-600">
					{{ message }}
				</p>
			</div>

			<div v-if="items && items.length > 0" class="py-8">
				<h2 class="font-semibold text-xl mb-4">Items</h2>
				<ul class="list-disc list-inside space-y-2">
					<li v-for="item in items" :key="item" class="text-gray-700">
						{{ item }}
					</li>
				</ul>
			</div>

			<div class="py-8">
				&copy; {{ new Date().getFullYear() }} by
				<a href="https://github.com/f3l1x" class="text-blue-600 underline">@f3l1x</a>
			</div>
		</div>
	</div>
</template>
