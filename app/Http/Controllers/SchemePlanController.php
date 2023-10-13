<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\SchemePlan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SchemePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $tags = SchemePlan::orderBy("scheme_plan");
        return Inertia::render("Tags/Index", [
            "tags" => $tags,
            "type" => "event"
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
