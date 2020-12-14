<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repository\NoticeRepository;
use Illuminate\Support\Facades\Auth;

class NoticeController extends BaseController
{

    private $noticeRepository;

    public function __construct(NoticeRepository $noticeRepository)
    {
        parent::__construct();
        $this->noticeRepository = $noticeRepository;
    }


    public function index(){
        $notices = $this->noticeRepository->all();
        return view('backend.pages.notice.index', compact('notices'));
    }

    public function store(Request $request){
        try{
            if(request()->hasFile('banner_image') or request()->hasFile('notice_file')){
                request()->validate([

                    'notice_banner' => 'required|image|mimes:jpeg,jpg,png|max:5048',
                    'notice_file' => 'required',

                ]);
            }

            $this -> validate($request, [
                'title' => ['required', 'string', 'max:255', 'unique:notices'],
                'content' => ['required', 'string'],
                'notice_date' => ['required', 'after:today']
            ]);


            if(Request()->hasFile('notice_banner') or request()->hasFile('notice_file')){
                $noticeBanner = $request->file('notice_banner');
                $noticeFile = $request->file('notice_file');
                $bannerName = time().'.'. $noticeBanner->getClientOriginalExtension();
                $noticeFileName = time().'.'. $noticeFile->getClientOriginalExtension();
                $noticeBanner->move(public_path('Notice'), $bannerName);
                $noticeFile->move(public_path('Notice'), $noticeFileName);
                $notice = new Notice();
                $notice -> title = $request->input('title');
                $notice -> content = $request->input('content');
                $notice -> notice_date = $request->input('notice_date');
                $notice -> notice_banner= $bannerName;
                $notice -> notice_file= $noticeFileName;
                $notice -> user_id = Auth::user()->id;
                $notice -> save();
            }

            if($notice){
                session()->flash('success','Successfully created!');
                return back();
            }else{
                session()->flash('error','Could not be created!');
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
            $edits = $this->noticeRepository->findById($id);
            if ($edits->count() > 0)
            {
                $notices = $this->noticeRepository->all();
                return view('backend.pages.notice.index', compact('edits','notices'));
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
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string'],
            ]);

            if(request()->hasFile('notice_banner')){
                $noticeBanner = $request->file('notice_banner');
                $bannerName = time().'.'. $noticeBanner->getClientOriginalExtension();
                $noticeBanner->move(public_path('Notice'), $bannerName);
                $notice1 = $this->noticeRepository->findById($id);
                $notice1 -> notice_banner= $bannerName;
                $notice1->save();
            }

            if(request()->hasFile('notice_file')){
                $noticeFile = $request->file('notice_file');
                $noticeFileName = time().'.'. $noticeFile->getClientOriginalExtension();
                $noticeFile->move(public_path('Notice'), $noticeFileName);
                $notice2 = $this->noticeRepository->findById($id);
                $notice2 -> notice_file= $noticeFileName;
                $notice2->save();
            }

            $update = $this->noticeRepository->findById($id)->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'notice_date' => $request->input('notice_date'),
            ]);

            if($update){
                session()->flash('success','Successfully Updated!');
                return redirect(route('notice.index'));
            }else{
                session()->flash('error','No record with given id!');
                return back();
            }
        }catch (\Exception $e){
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }

    }


    public function destroy(Notice $notice){
        $notice->delete();
        if($notice){
            session()->flash('success','Successfully Deleted!');
            return back();
        }else{
            session()->flash('error','Could not be deleted!');
            return back();
        }
    }
}
