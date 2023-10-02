<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TaskManager;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class APITasksController extends Controller
{
    public function create(Request $request)
    {
        $data = new TaskManager();
        $data->task_description = $request->get('task_description');
        $data->task_owner = $request->get('task_owner');
        $data->task_owner_email = $request->get('task_owner_email');
        $data->task_eta = $request->get('task_eta');
        
        if ($data->save()) {
            dispatch(new SendEmailJob($data));
            return "Data Saved Successfully";
        } else {
            return "Something went wrong";
        }
    }

    public function index()
    {
        
        $data = TaskManager::get();
        return $data;
    }

    public function getTasksByID($id)
    {
        $data = TaskManager::find($id);
        return $data;
    }

    public function update(Request $request, $id){
        try {
            $data = TaskManager::find($id);
    
            if (!$data) {
                return response()->json(['message' => 'Task not found'], 404);
            }
    
            $data->task_description = $request->input('task_description');
            $data->task_owner = $request->input('task_owner');
            $data->task_owner_email = $request->input('task_owner_email');
            $data->task_eta = $request->input('task_eta');
            $data->status = $request->input('task_status');
    
            if ($data->save()) {
                return response()->json(['message' => 'Data updated successfully']);
            } else {
                return response()->json(['message' => 'Something went wrong'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    
    public function markAsDone($id)
    {
        $data = TaskManager::find($id);
        $data->status = 1;
        if ($data->save()) {
            dispatch(new SendEmailJob($data));
            return "record marked as done Successfully";
        } else {
            return "Something went wrong";
        }
    }

    public function delete($id)
    {
        $data = TaskManager::find($id);
        if ($data->delete()) {
            return "task deleted Successfully";
        } else {
            return "Something went wrong";
        }
    }
}
