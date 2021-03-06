<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator{
	protected $rules = [
		'project_id' 	=> 'required|integer',
		'name' 			=> 'required',		
		'file' 			=> 'required'
	];
}