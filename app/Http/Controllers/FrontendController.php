<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Roles\Menu;
use Illuminate\Http\Request;
use App\Repository\Roles\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\Repository\NewsRepository;
use App\Repository\EventRepository;
use App\Repository\NoticeRepository;
use App\Repository\DownloadRepository;
use App\Repository\FrontendMenuRepository;

class FrontendController extends Controller
{

    private $frontendMenuRepository;
    private $newsRepository;
    private $eventRepository;
    private $noticeRepository;
    private $downloadRepository;
    private $menuRepository;


    public function __construct(FrontendMenuRepository $frontendMenuRepository, NewsRepository $newsRepository, EventRepository $eventRepository, NoticeRepository $noticeRepository, DownloadRepository $downloadRepository)
    {
        $this->frontendMenuRepository = $frontendMenuRepository;
        $this->newsRepository = $newsRepository;
        $this->eventRepository = $eventRepository;
        $this->noticeRepository = $noticeRepository;
        $this->downloadRepository = $downloadRepository;
    }

    public function index(){
        try{
            $menus = $this->frontendMenuRepository->all();
            $allNotice = DB::table('notices')->orderBy('notice_date', 'ASC')->limit(10)->get();
            $allEvents = DB::table('events')->orderBy('start_date', 'ASC')->limit(10)->get();
            $allDownloads = DB::table('downloads')->orderBy('created_at', 'ASC')->limit(10)->get();
            $allNews = DB::table('news')->orderBy('created_at', 'ASC')->limit(10)->get();
            $lastest = DB::table('news')->orderBy('created_at', 'ASC')->limit(6)->get();
            return view('frontend.index', compact('menus', 'allNotice', 'allEvents','allDownloads', 'allNews', 'lastest'));
        }catch (\Exception $e){
            return view('page');
        }
    }


    public function news(){
        try{
            $menus = $this->frontendMenuRepository->all();
            $allNews = $this->newsRepository->all();
            $lastest = DB::table('news')->orderBy('created_at', 'ASC')->limit(6)->get();
            return view('frontend.news.index', compact('allNews', 'menus', 'lastest'));
        }catch (\Exception $exception){
            return view('page');
        }
    }

    public function getNews($id){
        try{
            $menus = $this->frontendMenuRepository->all();
            $news = $this->newsRepository->findById($id);
            $lastest = DB::table('news')->orderBy('created_at', 'ASC')->limit(6)->get();
            return view('frontend.news.single', compact('news', 'menus', 'lastest'));
        }catch (\Exception $exception){
            return view('page');
        }
    }

    public function events(){
        try{
            $menus = $this->frontendMenuRepository->all();
            $allEvents = $this->eventRepository->all();
            $lastest = DB::table('news')->orderBy('created_at', 'ASC')->limit(6)->get();
            return view('frontend.event.index', compact('allEvents', 'menus', 'lastest'));
        }catch (\Exception $exception){
            return view('page');
        }
    }

    public function notices(){
        try{
            $menus = $this->frontendMenuRepository->all();
            $allNotice = $this->noticeRepository->all();
            $lastest = DB::table('news')->orderBy('created_at', 'ASC')->limit(6)->get();
            return view('frontend.notice.index', compact('allNotice', 'menus', 'lastest'));
        }catch (\Exception $exception){
            return view('page');
        }
    }

    public function getNotice($id){
        try{
            $menus = $this->frontendMenuRepository->all();
            $notice = $this->noticeRepository->findById($id);
            $lastest = DB::table('news')->orderBy('created_at', 'ASC')->limit(6)->get();
            return view('frontend.notice.single', compact('notice', 'menus', 'lastest'));
        }catch (\Exception $exception){
            return view('page');
        }
    }


    public function downloads(){
        try{
            $menus = $this->frontendMenuRepository->all();
            $allDownloads = DB::table('downloads')->orderBy('created_at', 'ASC')->paginate(10);
            $lastest = DB::table('news')->orderBy('created_at', 'ASC')->limit(6)->get();
            return view('frontend.download.index', compact('allDownloads', 'menus', 'lastest'));
        }catch (\Exception $exception){
            return view('page');
        }
    }

    public function download_notice($id){
        try{
            $resource = $this->noticeRepository->findById($id);
            return view('Frontend.notice.download', compact('resource'));
        }catch (\Exception $exception){
            return view('page');
        }
    }

    public function download_downloads($id){
        try{
            $resource = $this->downloadRepository->findById($id);
            return view('Frontend.download.download', compact('resource'));
        }catch (\Exception $exception){
            return view('page');
        }
    }

    public function contact(){
        $menus = $this->frontendMenuRepository->all();
        $lastest = DB::table('news')->orderBy('created_at', 'ASC')->limit(6)->get();
        return view('frontend.contact.index', compact('menus', 'lastest'));
    }

}
