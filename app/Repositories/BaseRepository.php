<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{    
    /**
     * model
     *
     * @var mixed
     */
    protected $model;

        
    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
          
    /**
     * all
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
    
    /**
     * get
     *
     * @param  mixed $columns
     * @param  mixed $where
     * @param  mixed $withRelations
     * @return Collection
     */
    public function get(array $columns = ['*'], array $where = [], array $withRelations = []): Collection
    {  
        return $this->model->where($where)->with($withRelations)->get($columns);
    }
           
    /**
     * create
     *
     * @param  mixed $request
     * @return Model
     */
    public function create(array $request): Model
    {
        return $this->model->create($request);
    }
    
    /**
     * find
     *
     * @param  mixed $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }
    
    /**
     * findOrFail
     *
     * @param  mixed $id
     * @return Model
     */
    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return bool
     */
    public function update(array $request, int $id): bool
    {
        $model = $this->findOrFail($id);
        return $model->update($request);
    }
    
    /**
     * delete
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->findOrFail($id);
        return $model->delete();
    }
}