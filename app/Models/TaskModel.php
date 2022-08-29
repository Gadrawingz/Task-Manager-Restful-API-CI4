<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'task_id';
    protected $allowedFields    = ["name", "description", "user"];
}
