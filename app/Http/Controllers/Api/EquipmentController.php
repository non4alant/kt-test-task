<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        return EquipmentResource::collection(Equipment::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentRequest $request)
    {
        $created_equipment = Equipment::create($request->validated());

        // TK decision
        return response()->json([
            'success' => [
                1 => [
                    'id' => $created_equipment->id,
                    'equipment_type' => $created_equipment->type,
                    'serial_number' => $created_equipment->serial_number,
                    'desc' => $created_equipment->comment,
                    'created_at' => $created_equipment->created_at,
                    'updated_at' => $created_equipment->updated_at,
                ]
            ],
        ], 201);

        // standard output
        //return new EquipmentResource($created_equipment);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new EquipmentResource(Equipment::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->validated());

        return new EquipmentResource($equipment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return response()->json(['message' => 'Resource soft deleted']);
    }

    //recovering a deleted object

    public function restore($id)
    {
        $restore_equipment = Equipment::withTrashed()->findOrFail($id);
        $restore_equipment->restore();

        return response()->json(['message' => 'Resource restored']);
    }
}
