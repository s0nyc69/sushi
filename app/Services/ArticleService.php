<?php

namespace App\Services;

use App\Article;
use Flobbos\Crudable\Contracts\Crud;
use Flobbos\Crudable;

class ArticleService implements Crud {
    
    use Crudable\Crudable;
    
    public function __construct(Article $article) {
        $this->model = $article;
    }
    
}