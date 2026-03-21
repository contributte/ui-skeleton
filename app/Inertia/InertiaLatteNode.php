<?php declare(strict_types = 1);

namespace App\Inertia;

use Latte\Compiler\NodeHelpers;
use Latte\Compiler\Nodes\StatementNode;
use Latte\Compiler\PrintContext;
use Latte\Compiler\Tag;

/**
 * Latte nodes for Inertia template tags.
 *
 * {inertia} - Outputs <div id="app" data-page="..."></div>
 * {inertia #custom-id} - Custom element ID
 * {inertiaHead} - Outputs SSR head content
 */
final class InertiaLatteNode extends StatementNode
{

	private ?string $id = null;

	private bool $isHead = false;

	public static function create(Tag $tag): self
	{
		$node = new self();
		$node->isHead = false;

		// Parse optional ID argument
		$args = $tag->parser->parseArguments();

		if ($args->items !== []) {
			$firstArg = $args->items[0];
			$value = NodeHelpers::toValue($firstArg->value, constants: true);

			if (is_string($value)) {
				$node->id = ltrim($value, '#');
			}
		}

		return $node;
	}

	public static function createHead(Tag $tag): self
	{
		$node = new self();
		$node->isHead = true;

		return $node;
	}

	public function print(PrintContext $context): string
	{
		if ($this->isHead) {
			return $context->format(
				'echo %raw;',
				'($inertiaHead ?? \'\')',
			);
		}

		$id = $this->id ?? 'app';

		return $context->format(
			'echo %raw;',
			'"<div id=\"' . $id . '\" data-page=\"" . htmlspecialchars($inertiaPage->toJson(), ENT_QUOTES, \'UTF-8\') . "\"></div>"',
		);
	}

	public function &getIterator(): \Generator
	{
		false && yield;
	}

}
