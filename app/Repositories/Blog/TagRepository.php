<?php
namespace App\Repositories\Blog;

use Bosnadev\Repositories\Eloquent\Repository;

class TagRepository extends Repository {

    public function model() {
        return 'App\Entity\Blog\Tag';
    }
}
