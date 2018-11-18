<?php
namespace App\Repositories\Blog;

use Bosnadev\Repositories\Eloquent\Repository;

class BlogRepository extends Repository {

    public function model() {
        return 'App\Entity\Blog\Blog';
    }
}
