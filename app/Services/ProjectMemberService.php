<?php
/**
 * Created by PhpStorm.
 * User: leleuvilela
 * Date: 23/03/17
 * Time: 15:20
 */

namespace App\Services;


use App\Repositories\ProjectMemberRepository;
use App\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;


class ProjectMemberService
{
    /**
     * @var ProjectMemberRepository
     */
    protected  $repository;
    /**
     * @var ProjectMemberValidator
     */
    private $validator;
    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function show()
    {
        try{
            return $this->repository->with('project')->all();
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