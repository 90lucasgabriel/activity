<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService{
	/**
	* @var ProjectTaskRespository
	*/
	protected $repository;

	/**
	* @var ProjectTaskValidator
	*/
	protected $validator;

	public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator){
		$this->repository 	= $repository;
		$this->validator 	= $validator;
	}

	//Ao passar os dados do ProjectTaske, criá-lo.
	public function create(array $data){
		try{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->create($data);
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}		
	}

	public function update(array $data, $id){
		try{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->update($data, $id);
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}
	}
}