<?php declare(strict_types = 1);

namespace App\UI\Home;

use App\UI\BasePresenter;

final class HomePresenter extends BasePresenter
{

	public function renderDefault(): void
	{
		$this->inertia('Home/Index', [
			'title' => 'Contributte / UI Skeleton',
			'tagline' => 'Nette, Vite and Inertia.js working together.',
			'features' => [
				'Protocol-correct server-side Inertia responses from contributte/ui',
				'Vue-powered page rendering with a Vite build pipeline',
				'Room for classic Nette components beside modern SPA navigation',
			],
			'links' => [
				['label' => 'Contributte UI', 'url' => 'https://github.com/contributte/ui'],
				['label' => 'Inertia.js', 'url' => 'https://inertiajs.com/'],
				['label' => 'Nette Framework', 'url' => 'https://nette.org/'],
			],
		]);
	}

}
