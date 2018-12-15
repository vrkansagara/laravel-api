<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BlogCreateRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Repositories\interfaces\Blog\BlogRepository;
use App\Validators\BlogValidator;

/**
 * Class BlogsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BlogsController extends ApiController
{
    /**
     * @var BlogRepository
     */
    protected $repository;

    /**
     * @var BlogValidator
     */
    protected $validator;

    /**
     * BlogsController constructor.
     *
     * @param BlogRepository $repository
     * @param BlogValidator $validator
     */
    public function __construct(BlogRepository $repository, BlogValidator $validator)
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
        $blogs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $blogs,
            ]);
        }

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BlogCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $blog = $this->repository->create($request->all());

            $response = [
                'message' => 'Blog created.',
                'data'    => $blog->toArray(),
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
        $blog = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $blog,
            ]);
        }

        return view('blogs.show', compact('blog'));
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
        $blog = $this->repository->find($id);

        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $blog = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Blog updated.',
                'data'    => $blog->toArray(),
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
                'message' => 'Blog deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Blog deleted.');
    }
}
