<?php declare(strict_types = 1);

namespace App\UI;

use App\Inertia\TInertiaPresenter;
use Contributte\Nella\UI\NellaPresenter;

abstract class BasePresenter extends NellaPresenter
{

	use TInertiaPresenter;

}
