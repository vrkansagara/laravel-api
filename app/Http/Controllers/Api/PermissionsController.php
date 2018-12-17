<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Repositories\interfaces\PermissionRepository;
use App\Validators\PermissionValidator;

/**
 * Class PermissionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PermissionsController extends ApiController
{
    /**
     * @var PermissionRepository
     */
    protected $repository;

    /**
     * @var PermissionValidator
     */
    protected $validator;

    /**
     * PermissionsController constructor.
     *
     * @param PermissionRepository $repository
     * @param PermissionValidator $validator
     */
    public function __construct(PermissionRepository $repository, PermissionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $roles = $this->repository->paginate();

        $responseFormat = [
            'message' => 'Permission list.',
            'data' => [
                'roles' => $roles
            ]
        ];
        return $this->response($responseFormat);
    }

    /**
     * @param PermissionCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $permission = $this->repository->create($request->all());

            $responseFormat = [
                'message'=>'Permission created successfully !',
                'data' => $permission->toArray()
            ];

            return $this->response($responseFormat);

        } catch (ValidatorException $e) {

            $responseFormat = [
                'message' => $e->getMessageBag()
            ];
            return $this->response($responseFormat);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->repository->find($id);


        $responseFormat = [
            'message' => 'Roles details.',
            'data' => $role->toArray()
        ];

        return $this->response($responseFormat);
    }


    /**
     * @param PermissionUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PermissionUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $permission = $this->repository->update($request->all(), $id);


            $responseFormat = [
                'message' => 'Permission updated successfully!',
                'data' => $permission->toArray()
            ];

            return $this->response($responseFormat);

        } catch (ValidatorException $e) {

            $responseFormat = [
                'message' => $e->getMessageBag()
            ];
            return $this->response($responseFormat);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->repository->delete($id);
            if($deleted){
                $responseFormat = [
                    'message' => 'Permission deleted successfully !',
                    'data' => $deleted
                ];
            }else{
                $responseFormat = [
                    'message' => 'Permission can not be deleted !',
                    'data' => $deleted
                ];
            }


            return $this->response($responseFormat);

        } catch (ValidatorException $e) {

            $responseFormat = [
                'message' => $e->getMessageBag()
            ];
            return $this->response($responseFormat);
        }

    }
}
