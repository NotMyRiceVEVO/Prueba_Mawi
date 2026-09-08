<?php

namespace App\Controllers;

use App\Models\ProyectosModel;
use CodeIgniter\RESTful\ResourceController;

class Proyectos extends ResourceController
{
    protected $modelName = ProyectosModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $proyecto = $this->model->find($id);

        if (!$proyecto) {
            return $this->failNotFound('Proyecto no encontrado.');
        }

        return $this->respond($proyecto);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $id = $this->model->insert($data);

        return $this->respondCreated(['id' => $id, 'message' => 'Proyecto creado correctamente.']);
    }

    public function update($id = null)
    {
        $proyecto = $this->model->find($id);

        if (!$proyecto) {
            return $this->failNotFound('Proyecto no encontrado.');
        }

        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $this->model->update($id, $data);

        return $this->respond(['message' => 'Proyecto actualizado correctamente.']);
    }

    public function delete($id = null)
    {
        $proyecto = $this->model->find($id);

        if (!$proyecto) {
            return $this->failNotFound('Proyecto no encontrado.');
        }

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Proyecto eliminado correctamente.']);
    }
}