<?php

namespace App\Repositories;

use App\Entities\Project;
use App\Presenters\ProjectPresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return Project::class;
    }

    public function isOwner($projectId, $userId)
    {
        if(count($this->skipPresenter()->findWhere(['id'=>$projectId, 'owner_id'=>$userId]))){
            return true;
        }

        return false;
    }

    public function hasMember($projectId, $memberId)
    {
        $project = $this->skipPresenter()->find($projectId);

        foreach ($project->members as $member){
            if($member->member_id == $memberId){
                return true;
            }
        }

        return false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}