<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use Illuminate\Http\Request;
use Venoudev\Results\Contracts\Result;
use Venoudev\Results\ApiJsonResources\PaginatedResource;
use App\Services\Contracts\VehiclesService as Service;

class VehicleController extends Controller
{
    protected $result;
    protected $service;

    public function __construct(Service $service, Result $result)
    {
        $this->service = $service;
        $this->result = $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'vehicle_plate',
            'brand',
            'model',
            'type',
            'owner_id',
        ]);
        $vehicle = $this->service->registerVehicle($data);

        $this->result->success();
        $this->result->setCode(200);
        $this->result->addMessage('REGISTERED', 'Process completed.');
        $this->result->setDescription('Vehicle registered in 4 ruedas successfully.');
        $this->result->addDatum( 'vehicle', VehicleResource::make($vehicle));

        return $this->result->getJsonResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
