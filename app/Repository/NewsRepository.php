<?php

namespace App\Repository;

use App\Models\News;

class NewsRepository{

    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function all()
    {
        $news = $this->news->orderBy('notice_date','ASC')->paginate(10);
        return $news;
    }

    public function findById($id)
    {
        $news = $this->news->find($id);
        return $news;
    }

}

?>