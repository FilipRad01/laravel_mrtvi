<?php

namespace App\Http\Filters;

use Carbon\Carbon;

class CourseFilter extends Filter
{
	protected array $filterable = [
		'search',
	];

	public function search($value = null): void 
	{
		if($value) {
			$this->builder->where('name', 'like', "%{$value}%")
				->orWhere('description', 'like', "%{$value}%");
		}
	}
}