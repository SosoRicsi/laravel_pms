<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class ManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.manage-users', [
            //
        ]);
    }
}
