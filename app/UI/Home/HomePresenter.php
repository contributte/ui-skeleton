<?php declare(strict_types = 1);

namespace App\UI\Home;

use App\UI\BasePresenter;

final class HomePresenter extends BasePresenter
{

	public function renderDefault(): void
	{
		$this->inertia('Home/Index', [
			'title' => 'Signal Stack',
			'tagline' => 'Three different frontend setups living side by side in one Nette application.',
			'intro' => 'Use the homepage as a switchboard. Each route proves a different rendering model: an Inertia app, a classic Latte page enhanced by Alpine, and a pure Vue workspace mounted without Inertia.',
			'cards' => [
				[
					'id' => 'inertia',
					'eyebrow' => 'Signal Stack',
					'title' => 'Pulse Protocol',
					'description' => 'A real Inertia page where the presenter owns routing and payloads while Vue hydrates the application shell.',
					'href' => $this->link('Showcase:inertia'),
					'status' => 'Inertia',
					'highlights' => [
						'Presenter-fed page models',
						'Protocol-aware lifecycle',
						'Vue hydrated via Inertia only',
					],
				],
				[
					'id' => 'widgets',
					'eyebrow' => 'Latte + Alpine',
					'title' => 'Widget Workshop',
					'description' => 'A classic server-rendered page that uses pure Latte templates and Alpine-enhanced widgets inspired by embedded-skeleton.',
					'href' => $this->link('Showcase:widgets'),
					'status' => 'Classic widgets',
					'highlights' => [
						'Pure Latte sections',
						'Alpine collapse, dialog, tabs, and menus',
						'Copy-paste friendly widget examples',
					],
				],
				[
					'id' => 'vue',
					'eyebrow' => 'Pure Vue',
					'title' => 'Vue Workbench',
					'description' => 'A standalone Vue app mounted into a normal Latte page, without Inertia in the middle.',
					'href' => $this->link('Showcase:vue'),
					'status' => 'Vue app',
					'highlights' => [
						'Dedicated Vue entrypoint',
						'Client-owned workspace state',
						'No Inertia protocol involved',
					],
				],
			],
			'stackPillars' => [
				[
					'label' => 'Inertia app',
					'description' => 'Use when presenters should still own navigation, links, shared props, and protocol behavior.',
				],
				[
					'label' => 'Latte + Alpine widgets',
					'description' => 'Use when the page should stay fundamentally server-rendered and only needs light interaction primitives.',
				],
				[
					'label' => 'Pure Vue workspace',
					'description' => 'Use when the page is a self-contained client application with local state and denser interactivity.',
				],
			],
			'links' => [
				['label' => 'Contributte UI', 'url' => 'https://github.com/contributte/ui'],
				['label' => 'Inertia.js', 'url' => 'https://inertiajs.com/'],
				['label' => 'Nette Framework', 'url' => 'https://nette.org/'],
			],
		]);
	}

}
