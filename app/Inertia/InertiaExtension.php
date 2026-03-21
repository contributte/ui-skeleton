<?php declare(strict_types = 1);

namespace App\Inertia;

use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\ServiceDefinition;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

/**
 * Nette DI extension for Inertia.js support.
 *
 * Configuration example:
 * ```neon
 * inertia:
 *     version: '1.0'
 *     rootView: '@Templates/@inertia.latte'
 * ```
 */
final class InertiaExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'version' => Expect::string()->nullable(),
			'rootView' => Expect::string('@Templates/@inertia.latte'),
		]);
	}

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();

		// Register Inertia service
		$inertiaService = $builder->addDefinition($this->prefix('inertia'))
			->setFactory(Inertia::class);

		assert($inertiaService instanceof ServiceDefinition);

		// Configure version if provided
		if ($config->version !== null) {
			$inertiaService->addSetup('setVersion', [$config->version]);
		}

		// Configure root view
		if ($config->rootView !== '@Templates/@inertia.latte') {
			$inertiaService->addSetup('setRootView', [$config->rootView]);
		}
	}

	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();

		// Register Latte extension
		$latteFactory = $builder->getDefinition('latte.latteFactory');

		assert($latteFactory instanceof ServiceDefinition);

		$latteFactory->addSetup('addExtension', [new InertiaLatteExtension()]);
	}

}
