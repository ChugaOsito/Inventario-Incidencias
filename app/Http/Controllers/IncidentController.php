<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Models\Incident;
use App\Project;
use App\ProjectUser;
use App\Message;
use App\Models\Producto;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
Use Auth;
use App\Models\User;
Use Carbon\Carbon;

class IncidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function take($id)
    {
        $user = auth()->user();

        if (! $user->is_support)
            return back();

        $incident = Incident::findOrFail($id);

        // There is a relationship between user and project?
        $project_user = ProjectUser::where('project_id', $incident->project_id)
                                        ->where('user_id', $user->id)->first();

        if (! $project_user)
            return back();

        // The level is the same?
        if ($project_user->level_id != $incident->level_id)
            return back();
        
        $incident->support_id = $user->id;
        $incident->save();

        $title= $incident->title;
        $description = $incident->description;
        $severity = $incident->severity;
        $client_id = $incident->client_id;
        $producto_id = $incident->producto_id;
        $incident = $incident->support_id;

        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $responsable = Auth::User();

        $activityLog = [
            'responsable'	    => $responsable->name,
            'title'		        => $title,
            'description'		=> $description,
            'severity'	        => $severity,
            'client_id'	        => $client_id,
            'support_id'	    => $incident,
            'producto_id'	    => $producto_id,
            'modyfy_user'		=> 'TAKE_INCIDENTS',
            'date_time'         => $todayDate
        ];
        DB::table('incidencia_activity_logs')->insert($activityLog);
        return back()->with('notification', 'Incidencia atentida existosamente.');
    }
    public function solve($id)
    {
        $incident = Incident::findOrFail($id);

        // Is the user authenticated the author of the incident?
        if ($incident->client_id != auth()->user()->id)
            return back();
           
        $incident->active = 0; // false
        $incident->save();

        $title= $incident->title;
        $description = $incident->description;
        $severity = $incident->severity;
        $client_id = $incident->client_id;
        $producto_id = $incident->producto_id;
        $incident = $incident->support_id;

        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $responsable = Auth::User();

        $activityLog = [
            'responsable'	    => $responsable->name,
            'title'		        => $title,
            'description'		=> $description,
            'severity'	        => $severity,
            'client_id'	        => $client_id,
            'support_id'	    => $incident,
            'producto_id'	    => $producto_id,
            'modyfy_user'		=> 'SOLVE_INCIDENTS',
            'date_time'         => $todayDate
        ];
        DB::table('incidencia_activity_logs')->insert($activityLog);
        return back()->with('notification', 'Incidencia resuelta.');
    }
    public function nextLevel($id)
    {
        $incident = Incident::findOrFail($id);
        $level_id = $incident->level_id;

        $project = $incident->project;
        $levels = $project->levels;

        $next_level_id = $this->getNextLevelId($level_id, $levels);

        if ($next_level_id) {
            $incident->level_id = $next_level_id;
            $incident->support_id = null;
            $incident->save();

            $title= $incident->title;
            $description = $incident->description;
            $severity = $incident->severity;
            $client_id = $incident->client_id;
            $producto_id = $incident->producto_id;
            $incident = $incident->support_id;

            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $responsable = Auth::User();

            $activityLog = [
                'responsable'	    => $responsable->name,
                'title'		        => $title,
                'description'		=> $description,
                'severity'	        => $severity,
                'client_id'	        => $client_id,
                'support_id'	    => $incident,
                'producto_id'	    => $producto_id,
                'modyfy_user'		=> 'NEXT_LEVEL_INCIDENTS',
                'date_time'         => $todayDate
            ];
            DB::table('incidencia_activity_logs')->insert($activityLog);
            return back();
        }
        return back()->with('notification', 'No es posible derivar porque no hay un siguiente nivel.');
    }
    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        $categories = $incident->project->categories;
        $productos=Producto::all(['id','descripcion', 'departamento_id','serie']);
        return view('incidents.edit')->with(compact('incident', 'categories', 'productos'));

        return back()->with('notification', 'Incidencia modificada correctamente.');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, Incident::$rules, Incident::$messages);

        $incident = Incident::findOrFail($id);

        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');
        $incidents = $request['archivo']->store('incidencias','public');
        $incident->archivo = $incidents;
        $incident->save();

        $title= $incident->title;
            $description = $incident->description;
            $severity = $incident->severity;
            $client_id = $incident->client_id;
            $producto_id = $incident->producto_id;
            $incident = $incident->support_id;

            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $responsable = Auth::User();

            $activityLog = [
                'responsable'	    => $responsable->name,
                'title'		        => $title,
                'description'		=> $description,
                'severity'	        => $severity,
                'client_id'	        => $client_id,
                'support_id'	    => $incident,
                'producto_id'	    => $producto_id,
                'modyfy_user'		=> 'UPDATE_INCIDENTS',
                'date_time'         => $todayDate
            ];
            DB::table('incidencia_activity_logs')->insert($activityLog);

        return redirect("/ver/$id");
        return back()->with('notification', 'Actualización de incidencia existosa.');     
    }
    public function getNextLevelId($level_id, $levels)
    {
        if (sizeof($levels) <= 1)
            return null;

        $position = -1;
        for ($i=0; $i<sizeof($levels)-1; $i++) { // -1
            if ($levels[$i]->id == $level_id) {
                $position = $i;
                break;
            }
        }

        if ($position == -1)
            return null;
            
        return $levels[$position+1]->id;
    
    }
    public function open($id)
    {
        $incident = Incident::findOrFail($id);

        // Is the user authenticated the author of the incident?
        if ($incident->client_id != auth()->user()->id)
            return back();
           
        $incident->active = 1; // true
        $incident->save();

        return back()->with('notification', 'Incidencia abierta.');
    }
    public function show($id)
    {
        $File = Incident::find($id);
        //return Storage::download($File->path, $File->archivo);
        
        $incident = Incident::findOrFail($id);
        $messages = $incident->messages;
        return view('incidents.show')->with(compact('incident', 'messages', 'File'));

        return back()->with('notification', 'Incidencia atentida.');
    }

    public function create() {
        $categories = Category::where('project_id', auth()->user()->selected_project_id)->get();
        $productos=Producto::all(['id','serie','descripcion','estado_id']);
        return view('incidents.create')->with(compact('categories', 'productos'));
       
}
     public function store(Request $request) 
    {
        
        $this->validate($request, Incident::$rules, Incident::$messages);

        $incident = new Incident();
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');
        $incidents = $request['archivo']->store('incidencias','public');
        $incident->producto_id = $request->input('producto_id') ?: null;
        $incident->archivo = $incidents;
        $user = auth()->user();

        $incident->client_id = $user->id;
        $incident->project_id = $user->selected_project_id;
        $incident->level_id = Project::find($user->selected_project_id)->first_level_id;

        $incident->save();

        $title= $incident->title;
        $description = $incident->description;
        $severity = $incident->severity;
        $client_id = $incident->client_id;
        $producto_id = $incident->producto_id;
        
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $responsable = Auth::User();

        $activityLog = [
            'responsable'	    => $responsable->name,
            'title'		        => $title,
            'description'		=> $description,
            'severity'	        => $severity,
            'client_id'	        => $client_id,
            'producto_id'	    => $producto_id,
            'modyfy_user'		=> 'CREATE_INCIDENTS',
            'date_time'         => $todayDate
        ];
        DB::table('incidencia_activity_logs')->insert($activityLog);
        return back()->with('notification', 'Gracias por contactarte con nosotros, se ha creado la incidencia y un representante se comunicará con usted en breve si es necesario. EQUIPO DE SOPORTE');
    }

    public function activityLog(Request $request)
    {
        $name = $request->name;
        $activityLog = DB::table('incidencia_activity_logs')
        ->where('responsable', 'like', '%' .$name. '%')
        ->get();
        return view('incidents.incidencia_activity_log', compact('activityLog'));
    }
}

