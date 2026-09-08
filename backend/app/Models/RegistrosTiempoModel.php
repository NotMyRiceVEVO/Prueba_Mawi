<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrosTiempoModel extends Model
{
    protected $table            = 'registros_tiempo';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['empleado_id', 'proyecto_id', 'fecha', 'tarea', 'horas'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'empleado_id' => 'required|is_natural_no_zero|is_not_unique[empleados.id]',
        'proyecto_id' => 'required|is_natural_no_zero|is_not_unique[proyectos.id]',
        'fecha'       => 'required|valid_date',
        'tarea'       => 'required|max_length[255]',
        'horas'       => 'required|decimal|greater_than[0]',
    ];

    protected $validationMessages = [
        'empleado_id' => [
            'required'      => 'Debes indicar el empleado.',
            'is_not_unique' => 'El empleado indicado no existe.',
        ],
        'proyecto_id' => [
            'required'      => 'Debes indicar el proyecto.',
            'is_not_unique' => 'El proyecto indicado no existe.',
        ],
        'fecha' => [
            'required'   => 'La fecha es obligatoria.',
            'valid_date' => 'La fecha no es válida.',
        ],
        'horas' => [
            'required'     => 'Las horas trabajadas son obligatorias.',
            'greater_than' => 'Las horas deben ser mayores a 0.',
        ],
    ];
}