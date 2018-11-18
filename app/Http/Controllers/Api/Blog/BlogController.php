<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\BlogInterface;
use App\Http\Controllers\ApiController;
use App\Repositories\Blog\BlogRepository;
use Illuminate\Http\Request;

class BlogController extends ApiController implements BlogInterface
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $blogs = $this->blogRepository->paginate();

        $responseData = [
            'blog_posts' => $blogs
        ];

        return response()->json($responseData);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // TODO: Implement show() method.
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    /**
     * @return mixed
     */
    public function destroyAll()
    {
        // TODO: Implement destroyAll() method.
    }
}
