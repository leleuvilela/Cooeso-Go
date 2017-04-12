<?php
/**
 * Created by PhpStorm.
 * User: leleuvilela
 * Date: 23/03/17
 * Time: 15:20
 */

namespace App\Services;


use App\Repositories\ProjectTaskRepository;
use App\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;


class ProjectTaskService
{
    /**
     * @var ProjectTaskRepository
     */
    protected  $repository;
    /**
     * @var ProjectTaskValidator
     */
    private $validator;
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function show()
    {
        try{
            return $this->repository->members;
        } catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function create(array $data)
    {

        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
}