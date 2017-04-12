<?php
/**
 * Created by PhpStorm.
 * User: leleuvilela
 * Date: 23/03/17
 * Time: 15:20
 */

namespace App\Services;


use App\Repositories\ProjectRepository;
use App\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected  $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function show()
    {
        try{
            return $this->repository->with('user')->with('client')->with('notes')->all();
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
        //enviar email
        //disparar notif
        //eis a diferença entre repository e service
    }

    public function addMember($projectId, $memberId)
    {
        $this->repository->members()->create(['project_id' => $projectId, 'member_id' => $memberId]);
    }

    public function removeMember($projectId, $memberId)
    {
        $this->repository->members()->findWhere(['project_id' => $projectId, 'member_id' => $memberId]);
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

    public function createFile(array $data)
    {
        $project = $this->repository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);

        $this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));
    }
}