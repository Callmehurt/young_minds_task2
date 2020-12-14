<?php

namespace App\Repository;

use App\Models\Download;

class DownloadRepository{

    private $downloads;

    public function __construct(Download $download)
    {
        $this->downloads = $download;
    }

    public function all()
    {
        $downloads = $this->downloads->orderBy('created_at','DESC')->get();
        return $downloads;
    }

    public function findById($id)
    {
        $download = $this->downloads->find($id);
        return $download;
    }

}

?>