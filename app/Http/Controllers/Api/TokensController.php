<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\TokenRepositoryEloquent;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TokenCreateRequest;
use App\Http\Requests\TokenUpdateRequest;
use App\Validators\TokenValidator;

/**
 * Class TokensController.
 *
 * @package namespace App\Http\Controllers;
 */
class TokensController extends ApiController
{
    /**
     * @var TokenRepository
     */
    protected $repository;

    /**
     * @var TokenValidator
     */
    protected $validator;

    /**
     * TokensController constructor.
     *
     * @param TokenRepository $repository
     * @param TokenValidator $validator
     */
    public function __construct(TokenRepositoryEloquent $repository, TokenValidator $validator)
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
        $tokens = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tokens,
            ]);
        }

        return view('tokens.index', compact('tokens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TokenCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TokenCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $token = $this->repository->create($request->all());

            $response = [
                'message' => 'Token created.',
                'data'    => $token->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $token = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $token,
            ]);
        }

        return view('tokens.show', compact('token'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $token = $this->repository->find($id);

        return view('tokens.edit', compact('token'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TokenUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TokenUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $token = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Token updated.',
                'data'    => $token->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Token deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Token deleted.');
    }
}
