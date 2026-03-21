<?php declare(strict_types = 1);

namespace App\Inertia;

use Closure;
use Nette\Http\IRequest;

/**
 * Main Inertia service.
 * Handles shared data, version management, and response creation.
 */
final class Inertia
{

	/** @var array<string, mixed> */
	private array $sharedProps = [];

	/** @var (Closure(): string)|string|null */
	private Closure|string|null $version = null;

	private string $rootView = '@Templates/@inertia.latte';

	public function __construct(
		private IRequest $httpRequest,
	)
	{
	}

	/**
	 * Share props with all Inertia responses.
	 *
	 * @param array<string, mixed>|string $key
	 */
	public function share(array|string $key, mixed $value = null): void
	{
		if (is_array($key)) {
			$this->sharedProps = array_merge($this->sharedProps, $key);
		} else {
			$this->sharedProps[$key] = $value;
		}
	}

	/**
	 * Get all shared props.
	 *
	 * @return array<string, mixed>
	 */
	public function getShared(): array
	{
		return $this->sharedProps;
	}

	/**
	 * Set the asset version for cache busting.
	 *
	 * @param (Closure(): string)|string $version
	 */
	public function setVersion(Closure|string $version): void
	{
		$this->version = $version;
	}

	/**
	 * Get the current asset version.
	 */
	public function getVersion(): string
	{
		if ($this->version === null) {
			return '';
		}

		return is_callable($this->version) ? ($this->version)() : $this->version;
	}

	/**
	 * Set the root view template path.
	 */
	public function setRootView(string $rootView): void
	{
		$this->rootView = $rootView;
	}

	/**
	 * Get the root view template path.
	 */
	public function getRootView(): string
	{
		return $this->rootView;
	}

	/**
	 * Check if the current request is an Inertia request.
	 */
	public function isInertiaRequest(): bool
	{
		return $this->httpRequest->getHeader('X-Inertia') === 'true';
	}

	/**
	 * Check if there's a version mismatch requiring full page reload.
	 */
	public function hasVersionMismatch(): bool
	{
		$clientVersion = $this->httpRequest->getHeader('X-Inertia-Version');

		if ($clientVersion === null) {
			return false;
		}

		return $clientVersion !== $this->getVersion();
	}

	/**
	 * Get only the props requested for partial reload.
	 *
	 * @param array<string, mixed> $props
	 * @return array<string, mixed>
	 */
	public function filterPartialProps(array $props, string $component): array
	{
		$partialData = $this->httpRequest->getHeader('X-Inertia-Partial-Data');
		$partialComponent = $this->httpRequest->getHeader('X-Inertia-Partial-Component');

		// Only filter if this is a partial reload for the same component
		if ($partialData === null || $partialComponent !== $component) {
			return $props;
		}

		$only = array_filter(explode(',', $partialData));

		if (count($only) === 0) {
			return $props;
		}

		return array_intersect_key($props, array_flip($only));
	}

	/**
	 * Create an Inertia response.
	 *
	 * @param array<string, mixed> $props
	 */
	public function render(string $component, array $props, string $url): InertiaResponse
	{
		// Merge shared props with component props (component props take precedence)
		$mergedProps = array_merge($this->resolveProps($this->sharedProps), $this->resolveProps($props));

		// Filter props for partial reloads
		$filteredProps = $this->filterPartialProps($mergedProps, $component);

		return new InertiaResponse(
			$component,
			$filteredProps,
			$url,
			$this->getVersion(),
		);
	}

	/**
	 * Resolve lazy props (closures) to their actual values.
	 *
	 * @param array<string, mixed> $props
	 * @return array<string, mixed>
	 */
	private function resolveProps(array $props): array
	{
		$resolved = [];

		foreach ($props as $key => $value) {
			$resolved[$key] = $value instanceof Closure ? $value() : $value;
		}

		return $resolved;
	}

}
