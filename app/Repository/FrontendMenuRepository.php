<?php

namespace App\Repository;

use App\Models\FrontendMenu;

class FrontendMenuRepository{

    private $frontendMenu;

    public function __construct(FrontendMenu $frontendMenu)
    {
        $this->frontendMenu = $frontendMenu;
    }

    public function all()
    {
        $getMenus = $this->frontendMenu->get();
        return $getMenus;
    }

    public function findById($id)
    {
        $frontendMenu = $this->frontendMenu->find($id);
        return $frontendMenu;
    }

}

?>