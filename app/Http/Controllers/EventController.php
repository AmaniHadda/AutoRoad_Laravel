<?php

namespace App\Http\Controllers;

use App\Events\ParticipeEvent;
use App\Models\Favoris;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Mail;
use App\Mail\MailNotifyParticipation;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class EventController extends Controller
{

   
    public function indexFrontOffice()
    {
        $favorisCount=0;
        if(auth()->user()){
            $favorisCount = Favoris::where('user_id', auth()->user()->id)->count();
        }
        return view('FrontOffice.event')
            ->with('events', Event::get())
            ->with('favoris',$favorisCount );

    }
    public function showFrontOffice($id)
    {
        return view('FrontOffice.Event.details')->with('event', Event::where('id',$id)->first());
    }
    public function index()
    {
        return view('BackOffice.events')->with('events', Event::orderBy('created_at','DESC')->paginate(4));
            
    }


    public function create()
    {
        return view('BackOffice.Events.create');
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'date' => 'required',
                'image' => 'required |mimes:png,jpg,jped|max:5048',
            ]
        );
        $slug = Str::slug($request->title, '-');
        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        Event::create([
            'title'=>$request->input('title'),
            'date_event'=>$request->input('date'),
            'image_path'=>$newImageName,
            'description'=>$request->input('description'),
            'user_id'=>auth()->user()->id
        ]);
        return redirect('admin/events')->with('message','Evenment aded successfully');
    }


    public function show($id)
    {
        return view('Backoffice.events.details')->with('event', Event::where('id',$id)->first());
    }


    public function edit($id)
    {
        return view('BackOffice.Events.edit')->with('event', Event::where('id',$id)->first());
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'date' => 'required',
                'image' => 'mimes:png,jpg,jped|max:5048',
            ]
        );
        if($request->image){
        $slug = Str::slug($request->title, '-');
        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        Event::where('id',$id)
        ->update([
            'title'=>$request->input('title'),
            'date_event'=>$request->input('date'),
            'image_path'=>$newImageName,
            'description'=>$request->input('description'),
            'user_id'=>auth()->user()->id
        ]);
        }
        else{
            Event::where('id',$id)
        ->update([
            'title'=>$request->input('title'),
            'date_event'=>$request->input('date'),
            'description'=>$request->input('description'),
            'user_id'=>auth()->user()->id
        ]);
        }
        return redirect('admin/events')->with('message','Evenment updated successfully');
    }


    public function destroy($id)
    {
        Event::where('id',$id)->delete();
        return redirect('admin/events')->with('message','Evenment deleted successfully');
    }
    public function addParticipation(Request $request){
        
        $User = User::find(auth()->user()->id);
        $Event = Event::find($request->input('event_id'));
        $data=[
            'subject'=>'New participation !',
            'body'=> $Event,
            'user_name'=>auth()->user()->name,
            'event_image'=>$Event->image_path
        ];
        $intNumber = intval($request->input('event_id')); // Conversion en entier
            foreach ($User->events as $ev) {

                if ($ev->id == $intNumber) {
                    return view('FrontOffice.Event.participateRecu')
                    ->with('error', 'You have already participated in this event.')
                    ->with('event',$ev )
                    ->with('user',$User);
                }
            }
        $Event->users()->attach($User);
        event(new ParticipeEvent($Event->title, auth()->user()->name));
        Mail::to($User->email)->send(new MailNotifyParticipation($data));
        return view('FrontOffice.Event.participateRecu')
        ->with('message', 'You successfully participated in this event.')
        ->with('event',$Event)
        ->with('user',$User);
        
    }
    public function indexParticipate(){
        return view("FrontOffice.event.participateRecu");
    }
    public function exportPdf(Request $request){
        $User = User::find(auth()->user()->id);
        $Event = Event::find($request->input('event_id'));
        $pdf = PDF::loadView('FrontOffice.Event.exportPdf', ['user' => $User, 'event' => $Event])->setOptions(['dpi' => 150,'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
        
        return $pdf->download('exportPdf.pdf');
    }
    public function search(Request $request) {
        $output = "";
        $searchTerm = $request->input('search');
        $events = Event::where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('created_at', 'LIKE', '%' . $searchTerm . '%')
            ->get();  
            if($events){
                foreach ($events as $event) {
                    $output .= '<tr>';
                    $output .= '<td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $event->title . '</strong></td>';
                    $output .= '<td><img style="width: 50px; height: 50px;" src="../images/' . $event->image_path . '" alt="Avatar" /></td>';
                    $output .= '<td>' . substr($event->description, 0, 20) . '...</td>';
                    $output .= '<td>' . $event->date_event . '</td>';
                    $output .= '<td><span class="badge bg-label-primary me-1">' . $event->user->name . '</span></td>';
                    $output .= '<td>' . $event->users()->count()  . ' person</td>';
                    $output .= '<td>' ;
                    $output .= '<div class="d-flex align-items-center">' ;
                    $output .= '<a class="btn text-primary" href="/admin/events/'.$event->id.' data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true"  title="<span>Show</span>"><i class="bx bxs-show"></i></a>' ;
                    $output .= '<a class="btn text-secondary" href="/admin/events/'.$event->id.'/edit" data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true"  title=" <span>Edit</span>" ><i class="bx bx-edit-alt"></i></a>';
                    $output.='<button class="btn text-danger" 
                    data-bs-target="#modal-' . $event->id .' "data-bs-toggle="modal" data-bs-target="#modalToggle" data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true" title=" <span>Delete</span>"><i class="bx bx-trash me-1"></i> </button>';
                    $output .= '</div>' ;
                    $output .= '</td>' ;
                    $output .= '</tr>';
                }
            }  else{
                $output .= '<tr>';
                $output .= '<td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>No data found .</strong></td>';
                $output .= '</tr>';
            }
                
        return response($output);
    }
}