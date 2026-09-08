<?php

namespace App\Controllers;

use App\Models\RegistrosTiempoModel;
use CodeIgniter\RESTful\ResourceController;

class RegistrosTiempo extends ResourceController
{
    protected $modelName = RegistrosTiempoModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $registro = $this->model->find($id);

        if (!$registro) {
            return $this->failNotFound('Registro no encontrado.');
        }

        return $this->respond($registro);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $id = $this->model->insert($data);

        return $this->respondCreated(['id' => $id, 'message' => 'Registro creado correctamente.']);
    }

    public function update($id = null)
    {
        $registro = $this->model->find($id);

        if (!$registro) {
            return $this->failNotFound('Registro no encontrado.');
        }

        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $this->model->update($id, $data);

        return $this->respond(['message' => 'Registro actualizado correctamente.']);
    }

    public function delete($id = null)
    {
        $registro = $this->model->find($id);

        if (!$registro) {
            return $this->failNotFound('Registro no encontrado.');
        }

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Registro eliminado correctamente.']);
    }
}