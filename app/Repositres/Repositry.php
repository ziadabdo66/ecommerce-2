<?php


namespace App\Repositres;


use Illuminate\Database\Eloquent\Model;

class Repositry implements \App\Http\interfaces\RepositresInterfaces
{
protected $model;
public function __construct(Model $model){
    $this->model=$model;
}
    public function all()
    {
 return $this->model->all();
    }

    public function create(array $data)
    {
      return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record=$this->find($id);
        return $record->model->update($data);
    }

    public function delete($id)
    {

        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
    public function getmodel(){
    return $this->model;
    }
    public function with($reltions){
return $this->model->with($reltions);
    }
}
