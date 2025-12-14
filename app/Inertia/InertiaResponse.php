<?php declare(strict_types = 1);

namespace App\Inertia;

use JsonSerializable;

/**
 * Inertia page object that gets serialized and sent to the client.
 * Implements the Inertia.js protocol page object structure.
 */
final class InertiaResponse implements JsonSerializable
{

	/**
	 * @param array<string, mixed> $props
	 */
	public function __construct(
		private string $component,
		private array $props,
		private string $url,
		private string $version,
	)
	{
	}

	public function getComponent(): string
	{
		return $this->component;
	}

	/**
	 * @return array<string, mixed>
	 */
	public function getProps(): array
	{
		return $this->props;
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function getVersion(): string
	{
		return $this->version;
	}

	/**
	 * @return array{component: string, props: array<string, mixed>, url: string, version: string}
	 */
	public function jsonSerialize(): array
	{
		return [
			'component' => $this->component,
			'props' => $this->props,
			'url' => $this->url,
			'version' => $this->version,
		];
	}

	public function toJson(): string
	{
		return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
	}

}
