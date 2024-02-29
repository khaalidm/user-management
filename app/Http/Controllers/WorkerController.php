<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use App\Models\Worker;
use Illuminate\Http\Request;


class WorkerController extends Controller
{
    public function index()
    {
        return Worker::all();
    }

    public function show(Worker $worker)
    {
        return $worker;
    }

    public function store(Request $request)
    {
        $worker = Worker::create($request->all());

        // This will dispatch the job to the queue
        SendWelcomeEmail::dispatch($worker);

        return response()->json($worker, 201);
    }

    public function update(Request $request, Worker $worker)
    {
        $worker->update($request->all());

        return response()->json($worker, 200);
    }

    public function delete(Worker $worker)
    {
        $worker->delete();

        return response()->json(null, 204);
    }

}
