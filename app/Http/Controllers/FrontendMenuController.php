<?php

namespace App\Http\Controllers;

use App\Models\FrontendMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repository\FrontendMenuRepository;

class FrontendMenuController extends BaseController
{
    private $frontendMenuRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(FrontendMenuRepository $frontendMenuRepository)
    {
        parent::__construct();
        $this->frontendMenuRepository = $frontendMenuRepository;
    }

    public function index()
    {
        $frontMenus=$this->frontendMenuRepository->all();
        return view('backend.frontendMenu.index',compact('frontMenus'));
    }


    public function store(Request $request)
    {
        try{
            $this -> validate($request, [
                'link_name' => ['required', 'string', 'max:255', 'unique:frontend_menus'],
                'link_url' => ['required', 'string'],
            ]);

            $link_name = $request->input('link_name');
            $link_url = $request->input('link_url');
            $frontend_menus = new FrontendMenu();
            $frontend_menus->link_name = $link_name;
            $frontend_menus->link_url = $link_url;
            $frontend_menus->save();
            if($frontend_menus){
                session()->flash('success','Menu successfully created!');
                return back();
            }else{
                session()->flash('error','Menu could not be created!');
                return back();
            }
        }catch (\Exception $e){
            $e->getMessage();
            session()->flash('error','Exception : '.$e);
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $id = (int)$id;
            $edits = $this->frontendMenuRepository->findById($id);
            if ($edits->count() > 0)
            {
                $frontMenus = $this->frontendMenuRepository->all();
                return view('backend.frontendMenu.index', compact('edits','frontMenus'));
            }
            else{
                session()->flash('error','Id could not be obtained!');
                return back();
            }

        }catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

    public function update(Request $request, $id)
    {
        $id = (int)$id;
        try{

            $this -> validate($request, [
                'link_name' => ['required', 'string', 'max:255'],
                'link_url' => ['required', 'string'],
            ]);

            $update = $this->frontendMenuRepository->findById($id)->update([
                'link_name' => $request->input('link_name'),
                'link_url' => $request->input('link_url'),
            ]);

            if($update){
                session()->flash('success','Successfully Updated!');
                return redirect(route('menu.index'));
            }else{
                session()->flash('error','No record with given id!');
                return back();
            }
        }catch (\Exception $e){
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }

    }

    public function destroy(FrontendMenu $frontendMenu){
        $frontendMenu->delete();
        if($frontendMenu){
            session()->flash('success','Successfully Deleted!');
            return back();
        }else{
            session()->flash('error','Could not be deleted!');
            return back();
        }
    }
}
