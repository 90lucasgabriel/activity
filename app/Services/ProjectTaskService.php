<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService{
	/**
	* @var ProjectTaskRespository
	*/
	protected $repository;

	protected $projectRepository;

	/**
	* @var ProjectTaskValidator
	*/
	protected $validator;

	public function __construct(ProjectTaskRepository $repository, ProjectRepository $projectRepository, ProjectTaskValidator $validator){
		$this->repository        = $repository;
		$this->projectRepository = $projectRepository;
		$this->validator         = $validator;
	}

	//Ao passar os dados do ProjectTaske, criá-lo.
	public function create(array $data){
		
		try{
			$this->validator->with($data)->passesOrFail();

			//$project = $this->projectRepository->skipPresenter()->find($data['project_id']);
			//$projectTask = $project->tasks()->create($data);
			//return $projectTask;
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

	public function delete($id){
		try{
			if($this->repository->delete($id)){
				return [
					'error' => false,
					'message' => 'Task removed'
				];
			}
			else{
				return [
					'error' => true,
					'message' => 'Task remove error'
				];
			}
		}
		catch(ValidatorException $e){
			return [
				'error' 	=> true,
				'message'	=> $e->getMessageBag()
			];
		}
	}
}