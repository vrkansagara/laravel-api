<?php

namespace App\Http\Controllers\Api;

use App\Entities\Role;
use App\Http\Controllers\ApiController;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Repositories\interfaces\RoleRepository;
use App\Validators\RoleValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class RolesController.
 *
 * @package namespace App\Http\Controllers;
 */
class RolesController extends ApiController
{
    /**
     * @var RoleRepository
     */
    protected $repository;

    /**
     * @var RoleValidator
     */
    protected $validator;

    /**
     * RolesController constructor.
     *
     * @param RoleRepository $repository
     * @param RoleValidator $validator
     */
    public function __construct(RoleRepository $repository, RoleValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
//        $this->authorizeResource(Role::class,'role');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(__FUNCTION__, $this->getCurrentPolicyClass());

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $roles = $this->repository->paginate();

        $responseFormat = [
            'message' => 'Roles list.',
            'data' => [
                'roles' => $roles
            ]
        ];
        return $this->response($responseFormat);
    }

    /**
     * @param RoleCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(RoleCreateRequest $request)
    {
        $this->authorize(__FUNCTION__, $this->getCurrentPolicyClass());

        try {


            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $role = $this->repository->create($request->all());

            $responseFormat = [
                'message' => 'Store created successfully !',
                'data' => $role->toArray()
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize(__FUNCTION__, $this->getCurrentPolicyClass());

        $role = $this->repository->find($id);


        $responseFormat = [
            'message' => 'Roles details.',
            'data' => $role->toArray()
        ];

        return $this->response($responseFormat);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $this->authorize(__FUNCTION__, $this->getCurrentPolicyClass());

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $role = $this->repository->update($request->all(), $id);


            $responseFormat = [
                'message' => 'Roles updated.',
                'data' => $role->toArray()
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
        $this->authorize(__FUNCTION__, $this->getCurrentPolicyClass());

        try {
            $deleted = $this->repository->delete($id);
            if ($deleted) {
                $responseFormat = [
                    'message' => 'Roles deleted successfully !',
                    'data' => $deleted
                ];
            } else {
                $responseFormat = [
                    'message' => 'Roles can not be deleted !',
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


    private function getCurrentPolicyClass()
    {
        return Role::class;
    }
}
