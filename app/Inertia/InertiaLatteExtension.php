<?php declare(strict_types = 1);

namespace App\Inertia;

use Latte\Extension;

/**
 * Latte extension providing Inertia.js template helpers.
 *
 * Provides:
 * - {inertia} tag - Renders the Inertia app container div
 * - {inertiaHead} tag - Renders SSR head content (if available)
 */
final class InertiaLatteExtension extends Extension
{

	/**
	 * @return array<string, callable>
	 */
	public function getTags(): array
	{
		return [
			'inertia' => [InertiaLatteNode::class, 'create'],
			'inertiaHead' => [InertiaLatteNode::class, 'createHead'],
		];
	}

}
