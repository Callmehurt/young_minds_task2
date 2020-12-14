<?php

namespace App\Repository;

use App\Models\Notice;

class NoticeRepository{

    private $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }

    public function all()
    {
        $notices = $this->notice->orderBy('notice_date','ASC')->get();
        return $notices;
    }

    public function findById($id)
    {
        $notice = $this->notice->find($id);
        return $notice;
    }

}

?>