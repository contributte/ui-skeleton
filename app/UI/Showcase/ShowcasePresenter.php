<?php declare(strict_types = 1);

namespace App\UI\Showcase;

use App\UI\BasePresenter;
use Nette\Utils\Json;

final class ShowcasePresenter extends BasePresenter
{

	public bool $autoCanonicalize = false;

	public function renderInertia(): void
	{
		$this->inertia('Showcase/Inertia', [
			'navigation' => $this->createNavigation('inertia'),
			'hero' => [
				'eyebrow' => 'Inertia app',
				'title' => 'Pulse Protocol',
				'tagline' => 'A real Inertia surface where Nette still authors the route, payload, and links.',
				'summary' => 'This page intentionally stays inside the Inertia model. The presenter decides the component, shared props stay server-driven, and Vue hydrates only after the protocol does its work.',
			],
			'pillars' => [
				[
					'title' => 'Presenter-fed page models',
					'description' => 'Nette decides the page component, shape of props, and internal URLs before Vue hydrates anything.',
				],
				[
					'title' => 'Protocol-aware responses',
					'description' => 'The adapter handles JSON visits, version mismatches, and the HTML bootstrap shell through one integration point.',
				],
				[
					'title' => 'Selective page refresh',
					'description' => 'Partial reloads and lazy props keep the server in charge while reducing the amount of work the page needs.',
				],
			],
			'flow' => [
				[
					'label' => 'Presenter intent',
					'description' => 'A presenter action prepares props, links, and component metadata.',
				],
				[
					'label' => 'Inertia envelope',
					'description' => 'The response becomes HTML or JSON depending on the request headers.',
				],
				[
					'label' => 'Hydrated page',
					'description' => 'Vue resolves the matching page module and keeps transitions feeling instantaneous.',
				],
			],
			'examples' => [
				[
					'title' => 'Shared props',
					'summary' => 'Flash errors, auth context, and nav items can be pushed from the presenter layer without manual JSON plumbing.',
				],
				[
					'title' => 'Version gating',
					'summary' => 'Stale frontend assets trigger a controlled 409 refresh instead of letting mismatched bundles drift.',
				],
				[
					'title' => 'Page-to-page navigation',
					'summary' => 'Use Inertia links for crisp transitions while preserving Nette link generation on the server.',
				],
			],
			'resources' => [
				['label' => 'Inertia Protocol', 'url' => 'https://inertiajs.com/the-protocol'],
				['label' => 'Contributte UI', 'url' => 'https://github.com/contributte/ui'],
			],
		]);
	}

	public function renderWidgets(): void
	{
		$this->template->navigation = $this->createNavigation('widgets');
		$this->template->title = 'Widget Workshop';
	}

	public function renderVue(): void
	{
		$this->template->navigation = $this->createNavigation('vue');
		$this->template->title = 'Vue Workbench';
		$payload = [
			'metrics' => [
				['label' => 'Open experiments', 'value' => '12', 'change' => '+3 this week'],
				['label' => 'Healthy flows', 'value' => '94%', 'change' => '+6%'],
				['label' => 'Queued actions', 'value' => '08', 'change' => '2 urgent'],
			],
			'panels' => [
				[
					'title' => 'Active boards',
					'description' => 'Dense, filterable collections with local sorting and progressive disclosure.',
				],
				[
					'title' => 'Focus tools',
					'description' => 'Stateful controls, optimistic toggles, and computed summaries belong here.',
				],
				[
					'title' => 'Decision sidebars',
					'description' => 'Use compact side panels for approvals, comments, and next steps.',
				],
			],
			'activity' => [
				['title' => 'Release candidate generated', 'time' => '5m ago', 'state' => 'ok'],
				['title' => 'Design token sync pending review', 'time' => '18m ago', 'state' => 'pending'],
				['title' => 'Tooltip wording mismatch detected', 'time' => '42m ago', 'state' => 'warning'],
				['title' => 'Accessibility pass completed', 'time' => '1h ago', 'state' => 'ok'],
			],
		];

		$this->template->vuePayloadJson = Json::encode($payload);
	}

	/**
	 * @return list<array{key: string, label: string, href: string, active: bool}>
	 */
	private function createNavigation(string $active): array
	{
		return [
			[
				'key' => 'inertia',
				'label' => 'Pulse Protocol',
				'href' => $this->link('Showcase:inertia'),
				'active' => $active === 'inertia',
			],
			[
				'key' => 'widgets',
				'label' => 'Widget Workshop',
				'href' => $this->link('Showcase:widgets'),
				'active' => $active === 'widgets',
			],
			[
				'key' => 'vue',
				'label' => 'Vue Workbench',
				'href' => $this->link('Showcase:vue'),
				'active' => $active === 'vue',
			],
		];
	}

}
