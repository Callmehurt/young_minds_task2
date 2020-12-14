<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Repository\EventRepository;
use App\Http\Controllers\BaseController;

class EventController extends BaseController
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        parent::__construct();
        $this->eventRepository = $eventRepository;
    }


    public function index(){
        $events = $this->eventRepository->all();
        return view('backend.pages.event.index', compact('events'));
    }

    public function store(Request $request){
        try{

            $this -> validate($request, [
                'title' => ['required', 'string', 'max:255', 'unique:events'],
                'content' => ['required', 'string'],
                'start_date' => ['required', 'after:today'],
                'end_date' => ['required', 'after:today'],
            ]);

            $event = Event::create($request->all());
            if($event){
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
            $edits = $this->eventRepository->findById($id);
            if ($edits->count() > 0)
            {
                $events = $this->eventRepository->all();
                return view('backend.pages.event.index', compact('edits','events'));
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
            $event = $this->eventRepository->findById($id);
            if($event){
                $event->fill($request->all())->save();
                session()->flash('success','Event updated successfully!');

                return redirect(route('event.index'));
            }else{

                session()->flash('error','No record with given id!');
                return back();
            }
        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION:'.$exception);
            return back();
        }
    }


    public function destroy(Event $event)
    {
        try{
           $event->delete();
           if($event){
               session()->flash('success','Event successfully deleted!');
               return back();
           }else{
               session()->flash('error','Could not delete!');
               return back();
           }

        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION'.$exception);
            return back();

        }
    }

}
