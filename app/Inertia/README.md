# Inertia.js Support

This module provides [Inertia.js](https://inertiajs.com/) support for Nette Framework.

## Features

- Simple integration via trait
- DI extension for configuration
- Latte macros for templates
- Support for Vue, React, and Svelte
- Shared props across all responses
- Asset versioning for cache busting
- Partial reloads support

## Installation

The module is already included in the skeleton. For frontend, install your preferred framework:

```bash
# Vue 3
npm install @inertiajs/vue3 vue

# React
npm install @inertiajs/react react react-dom

# Svelte
npm install @inertiajs/svelte svelte
```

## Configuration

```neon
# config/config.neon
extensions:
    inertia: App\Inertia\InertiaExtension

inertia:
    # Asset version for cache busting (optional)
    version: '1.0'

    # Root view template (default: @Templates/@inertia.latte)
    rootView: '@Templates/@inertia.latte'
```

## Usage

### Presenter

```php
<?php declare(strict_types = 1);

namespace App\UI\Home;

use App\UI\BasePresenter;

class HomePresenter extends BasePresenter
{
    public function actionDefault(): void
    {
        // Share data with all components
        $this->inertiaShare('user', $this->getUser()->getIdentity());

        // Render Inertia component
        $this->inertia('Home/Default', [
            'title' => 'Hello World',
            'posts' => $this->postRepository->findAll(),
        ]);
    }
}
```

### Frontend (Vue 3 example)

Create `assets/js/inertia.ts`:

```typescript
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

createInertiaApp({
    resolve: (name: string) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
```

Create `assets/js/Pages/Home/Default.vue`:

```vue
<script setup lang="ts">
defineProps<{
    title: string;
    posts: Array<{ id: number; title: string }>;
}>();
</script>

<template>
    <div>
        <h1>{{ title }}</h1>
        <ul>
            <li v-for="post in posts" :key="post.id">
                {{ post.title }}
            </li>
        </ul>
    </div>
</template>
```

### Root Template

The default root template is `app/UI/@Templates/@inertia.latte`:

```latte
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{block #title}App{/}</title>
    {inertiaHead}
    {vitecss assets/js/inertia.ts}
    {vitejs assets/js/inertia.ts}
</head>
<body>
    {inertia}
</body>
</html>
```

## Latte Tags

- `{inertia}` - Renders `<div id="app" data-page="..."></div>`
- `{inertia #custom-id}` - Custom element ID
- `{inertiaHead}` - Renders SSR head content (if available)

## API Reference

### TInertiaPresenter Trait

- `inertia(string $component, array $props = []): void` - Render an Inertia response
- `inertiaShare(array|string $key, mixed $value = null): void` - Share props with all responses
- `getInertiaComponentName(): string` - Get default component name (override to customize)

### Inertia Service

- `share(array|string $key, mixed $value = null): void` - Share props globally
- `getShared(): array` - Get all shared props
- `setVersion(Closure|string $version): void` - Set asset version
- `getVersion(): string` - Get current version
- `setRootView(string $rootView): void` - Set root template
- `getRootView(): string` - Get root template
- `isInertiaRequest(): bool` - Check if current request is Inertia XHR
- `hasVersionMismatch(): bool` - Check for version mismatch
- `render(string $component, array $props, string $url): InertiaResponse` - Create response

## Links

- [Inertia.js Documentation](https://inertiajs.com/)
- [Inertia.js Protocol](https://inertiajs.com/the-protocol)
