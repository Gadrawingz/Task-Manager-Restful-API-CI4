<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Tasks extends ResourceController
{
    use ResponseTrait;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $task = new TaskModel();
        return $this->respond($task->findAll());
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $task = new TaskModel();
        $data = $task->find($id);

        if(empty($data)) {
            return $this->failNotFound("No task data found!");
        } else {
            return $this->respond($data);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            "name" => "required",
            "description" => "required",
            "user" => "required",
        ];


        if(!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {

            $data = [
                "name" => $this->request->getVar("name"),
                "description" => $this->request->getVar("description"),
                "user" => $this->request->getVar("user")
            ];

            // Submission
            $task = new TaskModel();
            $task->save($data);
            return $this->respondCreated($data);
        }

    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $rules = [
            "name" => "required",
            "description" => "required",
            "user" => "required",
        ];


        if(!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {

            $task = new TaskModel();
            $data = $task->find($id);
            if(empty($data)) {
                return $this->failNotFound("Task to update is not found!");
            } else {
                $data = [
                    "name" => $this->request->getVar("name"),
                    "description" => $this->request->getVar("description"),
                    "user" => $this->request->getVar("user")
                ];

                // Submission
                $task = new TaskModel();
                $task->update($id, $data);
                return $this->respondCreated($data);
            }
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $task = new TaskModel();
        $data = $task->find($id);
        if(empty($data)) {
            return $this->failNotFound("Task to delete is not found!");
        } else {
            $task->delete($id);
            return $this->respondCreated($data);
        }
    }
}
