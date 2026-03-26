<?php declare(strict_types = 1);

namespace Tests\Cases\E2E\Inertia;

use App\Bootstrap;
use Contributte\Utils\FileSystem;
use Nette\Application\IPresenterFactory;
use Nette\Application\Request;
use Nette\Application\Responses\TextResponse;
use Tester\Assert;
use Tester\TestCase;
use Tests\Toolkit\Tests;

require_once __DIR__ . '/../../../bootstrap.php';

final class ShowcasePresenterTest extends TestCase
{

	public function setUp(): void
	{
		parent::setUp();

		if (!file_exists(Tests::ROOT_PATH . '/config/local.neon')) {
			FileSystem::copy(
				Tests::ROOT_PATH . '/config/local.neon.example',
				Tests::ROOT_PATH . '/config/local.neon'
			);
		}
	}

	public function testInertiaActionRendersInertiaShell(): void
	{
		$container = Bootstrap::boot()->createContainer();
		$presenterFactory = $container->getByType(IPresenterFactory::class);
		$presenter = $presenterFactory->createPresenter('Showcase');
		$response = $presenter->run(new Request('Showcase', 'GET', ['action' => 'inertia']));

		Assert::type(TextResponse::class, $response);
		assert($response instanceof TextResponse);

		ob_start();
		$response->send(
			$container->getService('http.request'),
			$container->getService('http.response')
		);
		$output = (string) ob_get_clean();

		Assert::contains('data-page=', $output);
		Assert::contains('Showcase/Inertia', $output);
	}

	public function testWidgetsActionRendersClassicLattePage(): void
	{
		$container = Bootstrap::boot()->createContainer();
		$presenterFactory = $container->getByType(IPresenterFactory::class);
		$presenter = $presenterFactory->createPresenter('Showcase');
		$response = $presenter->run(new Request('Showcase', 'GET', ['action' => 'widgets']));

		Assert::type(TextResponse::class, $response);
		assert($response instanceof TextResponse);

		ob_start();
		$response->send(
			$container->getService('http.request'),
			$container->getService('http.response')
		);
		$output = (string) ob_get_clean();

		Assert::contains('Widget Workshop', $output);
		Assert::contains('Hover for hint', $output);
		Assert::notContains('data-page=', $output);
	}

	public function testVueActionRendersStandaloneMountPoint(): void
	{
		$container = Bootstrap::boot()->createContainer();
		$presenterFactory = $container->getByType(IPresenterFactory::class);
		$presenter = $presenterFactory->createPresenter('Showcase');
		$response = $presenter->run(new Request('Showcase', 'GET', ['action' => 'vue']));

		Assert::type(TextResponse::class, $response);
		assert($response instanceof TextResponse);

		ob_start();
		$response->send(
			$container->getService('http.request'),
			$container->getService('http.response')
		);
		$output = (string) ob_get_clean();

		Assert::contains('id="vue-demo"', $output);
		Assert::contains('vue-demo-props', $output);
		Assert::notContains('data-page=', $output);
	}

}

(new ShowcasePresenterTest())->run();
