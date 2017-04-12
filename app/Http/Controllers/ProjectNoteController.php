<?php

namespace App\Http\Controllers;

use App\Services\ProjectNoteService;
use Illuminate\Http\Request;
use App\Repositories\ProjectNoteRepository;


class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    protected $repository;

    /**
     * @var ProjectNoteService
     */
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
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
    public function show($id, $noteId)
    {
        try{
            $result = $this->repository->findWhere(['project_id' =>$id, 'id' => $noteId]);
//            if(isset($result['data']) && count($result['data']) == 1){
//                $result = [
//                    'data' => $result['data'][0]
//                ];
//            }
            return $result[0];
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
    public function update(Request $request, $id, $noteId)
    {
        try{
            $this->service->update($request->all(), $noteId);
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
    public function destroy($id, $noteId)
    {
        try{
            $this->repository->find($noteId)->delete();
        } catch (\Exception $e){
            return ['error'=>true, 'Ocorreu um erro ao excluir a nota.'];
        }
    }
}
