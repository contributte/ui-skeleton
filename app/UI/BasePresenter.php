<?php declare(strict_types = 1);

namespace App\UI;

use Contributte\Nella\UI\NellaPresenter;
use Contributte\UI\Inertia\Presenter\TInertiaPresenter;

abstract class BasePresenter extends NellaPresenter
{

	use TInertiaPresenter;

}
