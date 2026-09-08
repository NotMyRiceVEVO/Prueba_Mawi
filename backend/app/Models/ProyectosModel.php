<?php

namespace App\Models;

use CodeIgniter\Model;

class ProyectosModel extends Model
{
    protected $table            = 'proyectos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['nombre', 'departamento', 'presupuesto'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nombre'       => 'required|min_length[3]|max_length[150]',
        'departamento' => 'required|max_length[100]',
        'presupuesto'  => 'required|decimal|greater_than[0]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'   => 'El nombre del proyecto es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
        ],
        'presupuesto' => [
            'required'      => 'El presupuesto es obligatorio.',
            'decimal'       => 'El presupuesto debe ser un número válido.',
            'greater_than'  => 'El presupuesto debe ser mayor a 0.',
        ],
    ];
}