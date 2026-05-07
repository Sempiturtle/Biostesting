<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReliefService;
use Illuminate\Http\Request;

class ReliefController extends Controller
{
    /**
     * Display the Relief Monitor.
     */
    public function index(ReliefService $service)
    {
        $absentProfessors = $service->getAbsentProfessors();
        $availableSubstitutes = $service->getAvailableSubstitutes();

        return view('admin.relief.index', compact('absentProfessors', 'availableSubstitutes'));
    }
}
