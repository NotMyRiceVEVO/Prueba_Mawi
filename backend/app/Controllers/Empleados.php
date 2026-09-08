<?php

namespace App\Controllers;

use App\Models\EmpleadosModel;
use CodeIgniter\RESTful\ResourceController;

class Empleados extends ResourceController
{
    protected $modelName = EmpleadosModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $empleado = $this->model->find($id);

        if (!$empleado) {
            return $this->failNotFound('Empleado no encontrado.');
        }

        return $this->respond($empleado);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $id = $this->model->insert($data);

        return $this->respondCreated(['id' => $id, 'message' => 'Empleado creado correctamente.']);
    }

    public function update($id = null)
    {
        $empleado = $this->model->find($id);

        if (!$empleado) {
            return $this->failNotFound('Empleado no encontrado.');
        }

        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $this->model->update($id, $data);

        return $this->respond(['message' => 'Empleado actualizado correctamente.']);
    }

    public function delete($id = null)
    {
        $empleado = $this->model->find($id);

        if (!$empleado) {
            return $this->failNotFound('Empleado no encontrado.');
        }

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Empleado eliminado correctamente.']);
    }
}