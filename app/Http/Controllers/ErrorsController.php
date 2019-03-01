<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ErrorCreateRequest;
use App\Http\Requests\ErrorUpdateRequest;
use App\Repositories\interfaces\ErrorRepository;
use App\Validators\ErrorValidator;

/**
 * Class ErrorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ErrorsController extends Controller
{
    /**
     * @var ErrorRepository
     */
    protected $repository;

    /**
     * @var ErrorValidator
     */
    protected $validator;

    /**
     * ErrorsController constructor.
     *
     * @param ErrorRepository $repository
     * @param ErrorValidator $validator
     */
    public function __construct(ErrorRepository $repository, ErrorValidator $validator)
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
        $errors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $errors,
            ]);
        }

        return view('errors.index', compact('errors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ErrorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ErrorCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $error = $this->repository->create($request->all());

            $response = [
                'message' => 'Error created.',
                'data'    => $error->toArray(),
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
        $error = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $error,
            ]);
        }

        return view('errors.show', compact('error'));
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
        $error = $this->repository->find($id);

        return view('errors.edit', compact('error'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ErrorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ErrorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $error = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Error updated.',
                'data'    => $error->toArray(),
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
                'message' => 'Error deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Error deleted.');
    }
}
