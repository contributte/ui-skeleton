<?php declare(strict_types = 1);

namespace App\Inertia;

use Nette\Application\Responses\JsonResponse;
use Nette\Application\UI\Presenter;

/**
 * Trait providing Inertia.js support for presenters.
 *
 * @mixin Presenter
 */
trait TInertiaPresenter
{

	protected Inertia $inertia;

	public function injectInertia(Inertia $inertia): void
	{
		$this->inertia = $inertia;
	}

	/**
	 * Render an Inertia response.
	 *
	 * @param array<string, mixed> $props
	 */
	public function inertia(string $component, array $props = []): void
	{
		// Handle version mismatch - force full page reload
		if ($this->inertia->isInertiaRequest() && $this->inertia->hasVersionMismatch()) {
			$this->getHttpResponse()->setCode(409);
			$this->getHttpResponse()->setHeader('X-Inertia-Location', $this->getHttpRequest()->getUrl()->getAbsoluteUrl());
			$this->sendResponse(new JsonResponse(null));
		}

		// Get current URL
		$url = $this->getHttpRequest()->getUrl()->getAbsoluteUrl();

		// Create Inertia response
		$response = $this->inertia->render($component, $props, $url);

		// Handle Inertia XHR request
		if ($this->inertia->isInertiaRequest()) {
			$this->getHttpResponse()->setHeader('X-Inertia', 'true');
			$this->getHttpResponse()->setHeader('Vary', 'Accept');
			$this->sendResponse(new JsonResponse($response));
		}

		// Handle initial page load - render the root template
		$this->template->setFile($this->formatInertiaTemplateFile());
		$this->template->inertiaPage = $response;
		$this->template->inertiaHead = ''; // Can be used for SSR head
	}

	/**
	 * Share props with all Inertia responses.
	 * Useful in startup() for user data, flash messages, etc.
	 *
	 * @param array<string, mixed>|string $key
	 */
	public function inertiaShare(array|string $key, mixed $value = null): void
	{
		$this->inertia->share($key, $value);
	}

	/**
	 * Get the Inertia root template file path.
	 */
	protected function formatInertiaTemplateFile(): string
	{
		$rootView = $this->inertia->getRootView();

		// If absolute path, use as is
		if (str_starts_with($rootView, '/')) {
			return $rootView;
		}

		// Otherwise, resolve relative to app/UI
		$appDir = dirname((string) $this->getPresenterFactory()->getPresenterClass($this->getName()));

		// Go up to UI directory
		$uiDir = dirname($appDir);

		return $uiDir . DIRECTORY_SEPARATOR . $rootView;
	}

	/**
	 * Get the default Inertia component name based on presenter and action.
	 * Override this method to customize component naming.
	 *
	 * @return string Component name in format "Module/Action" (e.g., "Home/Index")
	 */
	protected function getInertiaComponentName(): string
	{
		$presenter = $this->getName();
		$action = $this->getAction();

		// Convert action to PascalCase
		$action = ucfirst($action);

		return $presenter . '/' . $action;
	}

}
