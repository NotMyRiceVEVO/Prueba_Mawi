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

    public function resumen($id = null)
    {
        $proyecto = $this->model->find($id);

        if (!$proyecto) {
            return $this->failNotFound('Proyecto no encontrado.');
        }

        $registrosModel = new \App\Models\RegistrosTiempoModel();

        $registros = $registrosModel
            ->select('registros_tiempo.horas, empleados.tarifa_hora')
            ->join('empleados', 'empleados.id = registros_tiempo.empleado_id')
            ->where('registros_tiempo.proyecto_id', $id)
            ->findAll();

        $horasTotales = 0;
        $costoTotal   = 0;

        foreach ($registros as $registro) {
            $horasTotales += $registro['horas'];
            $costoTotal   += $registro['horas'] * $registro['tarifa_hora'];
        }

        return $this->respond([
            'proyecto_id'      => (int) $id,
            'nombre'           => $proyecto['nombre'],
            'presupuesto'      => (float) $proyecto['presupuesto'],
            'horas_totales'    => (float) $horasTotales,
            'costo_total'      => (float) $costoTotal,
            'excede_presupuesto' => $costoTotal > $proyecto['presupuesto'],
        ]);
    }
}