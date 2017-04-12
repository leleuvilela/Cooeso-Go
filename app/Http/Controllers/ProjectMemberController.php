<?php

namespace App\Http\Controllers;

use App\Services\ProjectMemberService;
use Illuminate\Http\Request;
use App\Repositories\ProjectMemberRepository;


class ProjectMemberController extends Controller
{

    /**
     * @var ProjectMemberRepository
     */
    protected $repository;

    /**
     * @var ProjectMemberService
     */
    private $service;

    public function __construct(ProjectMemberRepository $repository, ProjectMemberService $service)
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
    public function show($id, $memberId)
    {
        try{
            return $this->repository->findWhere(['project_id' =>$id, 'id' => $memberId]);
        } catch (\Exception $e){
            return ['error'=>true, 'Ocorreu algum erro ao mostrar a nota.'];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $memberId)
    {
        try{
            $this->service->update($request->all(), $memberId);
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
    public function destroy($id, $memberId)
    {
        try{
            $this->repository->find($memberId)->delete();
        } catch (\Exception $e){
            return ['error'=>true, 'Ocorreu um erro ao excluir o membro.'];
        }
    }
}
