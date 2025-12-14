<?php declare(strict_types = 1);

namespace App\UI\Home;

use App\UI\BasePresenter;

class HomePresenter extends BasePresenter
{

	/**
	 * Example Inertia action.
	 * Renders the 'Home/Default' component with props.
	 *
	 * Usage: Navigate to /home/inertia
	 */
	public function actionInertia(): void
	{
		// Share data with all components (useful for user info, flash messages, etc.)
		$this->inertiaShare('appName', 'Contributte UI Skeleton');

		// Render the Inertia component with props
		$this->inertia('Home/Default', [
			'title' => 'Welcome to Inertia.js',
			'message' => 'This page is rendered using Inertia.js with a Vue/React/Svelte frontend.',
			'items' => [
				'Server-side routing',
				'Client-side rendering',
				'No API required',
			],
		]);
	}

}
