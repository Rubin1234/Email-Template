<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MailVariableRepository;
use App\Entities\MailVariable;
use App\Validators\MailVariableValidator;

/**
 * Class MailVariableRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MailVariableRepositoryEloquent extends BaseRepository implements MailVariableRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MailVariable::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
