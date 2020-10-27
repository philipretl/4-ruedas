<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OwnerResource;
use Illuminate\Http\Request;
use Venoudev\Results\ApiJsonResources\PaginatedResource;
use Venoudev\Results\Contracts\Result;
use App\Services\Contracts\OwnerService as Service;

class OwnerController extends Controller
{
   protected $service;
   protected $result;

   public function __construct(Result $result, Service $service)
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
        $owners = $this->service->listOwner();

        $this->result->success();

        if($owners->isEmpty()){
            $this->result->addMessage('EMPTY_LIST','Empty model list solicited.');
            $this->result->setDescription('Empty list of owners registered in 4 ruedas.');
            return $this->result->getJsonResponse();
        }

        $data = OwnerResource::collection($owners);
        $this->result->addMessage('PAGINATED_LIST','Paginated model list');
        $this->result->setDescription('List of owners registered in 4 ruedas.');
        $this->result->addDatum('owners_paginated', PaginatedResource::make($data, 'owners'));

        return $this->result->getJsonResponse();
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
            'name',
            'last_name',
            'dni',
            'user_id',
        ]);
        $owner = $this->service->registerOwner($data);

        $this->result->success();
        $this->result->setCode(200);
        $this->result->addMessage('REGISTERED', 'Process completed.');
        $this->result->setDescription('Owner registered in 4 ruedas successfully.');
        $this->result->addDatum( 'owner', OwnerResource::make($owner));

        return $this->result->getJsonResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($owner_id)
    {
        $owner = $this->service->findOwner($owner_id);
        $this->result->success();
        $this->result->setCode(200);
        $this->result->addMessage('FOUND', 'Model Found.');
        $this->result->setDescription('Owner found in 4 ruedas successfully.');
        $this->result->addDatum( 'owner', OwnerResource::make($owner));

        return $this->result->getJsonResponse();
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
    public function destroy(Request $request, $owner_id)
    {
        $data = $request->only(['hard_delete']);

        if(array_key_exists('hard_delete', $data) == false){
            $this->service->deleteOwner($owner_id, false);
            $this->result->success();
            $this->result->addMessage('DELETED','Process completed.');
            $this->result->setDescription('Owner deleted in mallpty succesfuly.');
            return $this->result->getJsonResponse();
        }

        if($data['hard_delete'] == 'true'){
            $this->service->deleteOwner($owner_id, true);
            $this->result->success();
            $this->result->addMessage('DELETED','Process completed.');
            $this->result->setDescription('Owner deleted in mallpty succesfuly.');
            return $this->result->getJsonResponse();
        }

        $this->service->deleteOwner($owner_id, false);
        $this->result->success();
        $this->result->addMessage('DELETED','Process completed.');
        $this->result->setDescription('Owner deleted in mallpty succesfuly.');
        return $this->result->getJsonResponse();

    }
}
