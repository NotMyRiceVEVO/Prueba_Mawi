<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
    protected $table            = 'empleados';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nombre', 'rol', 'tarifa_hora'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nombre'      => 'required|min_length[3]|max_length[150]',
        'rol'         => 'required|max_length[100]',
        'tarifa_hora' => 'required|decimal|greater_than[0]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre del empleado es obligatorio.',
        ],
        'tarifa_hora' => [
            'required'     => 'La tarifa por hora es obligatoria.',
            'greater_than' => 'La tarifa debe ser mayor a 0.',
        ],
    ];
}