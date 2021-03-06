<?php

namespace App\Http\Controllers;


use App\Models\News;
use App\Repository\NewsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class NewsController extends BaseController
{

    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        parent::__construct();
        $this->newsRepository = $newsRepository;
    }


    public function index(){
        $news = $this->newsRepository->all();
        return view('backend.pages.news.index', compact('news'));
    }

    public function store(Request $request){
        try{
            if(request()->hasFile('banner_image')){
                request()->validate([

                    'banner_image' => 'required|image|mimes:jpeg,jpg,png|max:5048',

                ]);
            }

            $this -> validate($request, [
                'title' => ['required', 'string', 'max:255', 'unique:news'],
                'content' => ['required', 'string'],
                'notice_date' => ['required', 'after:today']
            ]);


           if(Request()->hasFile('banner_image')){
               $image = $request->file('banner_image');
               $name = time().'.'. $image->getClientOriginalExtension();
               $image->move(public_path('News'), $name);
               $news = new News();
               $news -> title = $request->input('title');
               $news -> content = $request->input('content');
               $news -> notice_date = $request->input('notice_date');
               $news -> banner_image = $name;
               $news -> user_id = Auth::user()->id;
               $news -> save();
           }

            if($news){
                session()->flash('success','Successfully created!');
                return back();
            }else{
                session()->flash('error','Designation could not be created!');
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
            $edits = $this->newsRepository->findById($id);
            if ($edits->count() > 0)
            {
                $news = $this->newsRepository->all();
                return view('backend.pages.news.index', compact('edits','news'));
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


    public function destroy(News $news){
        $news->delete();
        if($news){
            session()->flash('success','Successfully Deleted!');
            return back();
        }else{
            session()->flash('error','Could not be deleted!');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $id = (int)$id;
        try{
            if(request()->hasFile('banner_image')){
                request()->validate([

                    'banner_image' => 'required|image|mimes:jpeg,jpg,png|max:5048',

                ]);
            }

            $this -> validate($request, [
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string'],
                'notice_date' => ['required', 'after:today'],
            ]);

            if(request()->hasFile('banner_image')){
                $image = $request->file('banner_image');
                $filename = time().'.'. $image->getClientOriginalExtension();
                $image->move(public_path('News'), $filename);
                $img = $this->newsRepository->findById($id);
                $img->banner_image = $filename;
                $img->save();
            }

            $update = $this->newsRepository->findById($id)->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'notice_date' => $request->input('notice_date'),
            ]);

            if($update or $img){
                session()->flash('success','Successfully Updated!');
                return redirect(route('news.index'));
            }else{
                session()->flash('error','No record with given id!');
                return back();
            }
        }catch (\Exception $e){
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }

    }
}
