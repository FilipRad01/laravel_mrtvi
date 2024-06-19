<?php

namespace App\Http\Filters;

use Carbon\Carbon;

class UserFilter extends Filter
{
	protected array $filterable = [
		'search',
	];

	public function search($value = null): void 
	{
		if($value) {
			$this->builder->where('name', 'like', "%{$value}%")
				->orWhere('email', 'like', "%{$value}%");
		}
	}
}