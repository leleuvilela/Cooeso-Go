<?php

namespace App\Http\Controllers;

use App\Services\ProjectTaskService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProjectTaskCreateRequest;
use App\Http\Requests\ProjectTaskUpdateRequest;
use App\Repositories\ProjectTaskRepository;
use App\Validators\ProjectTaskValidator;


class ProjectTasksController extends Controller
{

    /**
     * @var ProjectTaskRepository
     */
    protected $repository;

    /**
     * @var ProjectTaskService
     */
    private $service;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $taskId)
    {
        try{
            return $this->repository->findWhere(['project_id' =>$id, 'id' => $taskId]);
        } catch (\Exception $e){
            return ['error'=>true, 'Ocorreu algum erro ao mostrar a tarefa.'];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $taskId)
    {
        try{
            $this->service->update($request->all(), $taskId);
        } catch (\Exception $e){
            return ['error'=>true, 'Ocorreu algum erro ao editar a nota.'];
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($noteId)
    {
        try{
            $this->repository->find($noteId)->delete();
        } catch (\Exception $e){
            return ['error'=>true, 'Ocorreu um erro ao excluir a nota.'];
        }
    }
}
