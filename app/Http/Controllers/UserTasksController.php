<?php

namespace App\Http\Controllers;

use App\Models\UserTasks;
use App\Http\Requests\StoreUserTasksRequest;
use App\Http\Requests\UpdateUserTasksRequest;

class UserTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserTasksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserTasks $userTasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserTasks $userTasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserTasksRequest $request, UserTasks $userTasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTasks $userTasks)
    {
        //
    }
}
