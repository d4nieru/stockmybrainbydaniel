<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Support\Facades\Http;
use Gate;

class Mainpage extends Controller
{
    public function register()
    {
        $title = "Créer un compte | Stock My Brain";

        return view('auth.register', compact('title'));
    }

    public function login()
    {
        $title = "Se connecter | Stock My Brain";

        return view('auth.login', compact('title'));
    }

    public function mainPage()
    {
        $title = "Stock My Brain";

        return view('mainPage', compact('title'));
    }

    public function dashboard()
    {
        $title = "Page d'Accueil | Stock My Brain";

        $user_id = Auth::id();

        $user = User::find($user_id);

        //$response = Http::get('https://www.googleapis.com/calendar/');

        //$jsonData = $response->json();

        return view('dashboard.dashboard', compact('title', 'user'));
    }

    public function createWorkspace()
    {
        $title = "Créer un espace de travail | Stock My Brain";

        return view('dashboard.createWorkspace', compact('title'));
    }

    public function postCreateWorkspace(Request $request)
    {
        $this->validate($request, [
            'workspace_name' => 'required',
            'workspace_cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);

        $workspace_cover_name = null;
        $workspace_cover_path = null;

        if ($request->hasFile('workspace_cover')) {

            $image = $request->file('workspace_cover');
            $workspace_cover_name = time().'.'.$image->getClientOriginalExtension();
            
            $workspace_cover_path = public_path('/workspaceimgs');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(320, 240, function ($constraint) {
                $constraint->aspectRatio();
            })->save($workspace_cover_path.'/'.$workspace_cover_name);

            //$workspace_cover_name = $request->file('workspace_cover')->getClientOriginalName();
            //$workspace_cover_path = $request->file('workspace_cover')->storeAs('public/uploads', $workspace_cover_name);
        }

        $workspace_name = $request->input("workspace_name");
        $user_id = Auth::id();

        $workspace = new Workspace();
        $workspace->workspace_name = $workspace_name;
        $workspace->workspace_cover_name = $workspace_cover_name;
        $workspace->workspace_cover_path = $workspace_cover_path;
        $workspace->save();

        $workspace_id = $workspace->id;

        $user = User::find($user_id);
        $user->workspaces()->attach($workspace_id, ['ownership' => 1, 'admin' => 1]);

        return redirect('/dashboard');
    }

    public function deleteWorkspaceCover($id)
    {
        $workspace = Workspace::find($classroomid);

        $filename = $workspace->workspace_cover_name;

        if(File::exists('workspaceimgs/'.$filename)) {

            File::delete('workspaceimgs/'.$filename);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }

        Workspace::where('id', $id)->update(['workspace_cover_name' => null, 'workspace_cover_path' => null]);

        return redirect()->back();
    }

    public function deleteWorkspace($id)
    {
        $workspace = Workspace::findOrFail($id);

        $filename = $workspace->workspace_cover_name;
        
        if(File::exists('workspaceimgs/'.$filename)) {

            File::delete('workspaceimgs/'.$filename);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }

        //$workspace->users()->detach();
        $workspace->delete();

        return redirect()->back();
    }

    public function editWorkspace($id)
    {
        $this->authorize('superuser');

        $workspace = Workspace::find($id);

        $title = $workspace->workspace_name." | Stock My Brain";

        return view('workspace.editWorkspace', compact('title', 'workspace'));
    }

    public function postEditWorkspace(Request $request, $id)
    {
        if($request->input("new_workspace_name") && $request->hasFile('new_workspace_cover')) {

            $request->validate([
                'new_workspace_name' => 'required',
                'new_workspace_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
            ]);

            $workspace = Workspace::find($id);

            $workspace_name = $request->input("new_workspace_name");

            $filename = $workspace->workspace_cover_name;

            if(File::exists('workspaceimgs/'.$filename)) {

                File::delete('workspaceimgs/'.$filename);
                /*
                    Delete Multiple File like this way
                    Storage::delete(['upload/test.png', 'upload/test2.png']);
                */
            }

            $image = $request->file('new_workspace_cover');
            $workspace_cover_name = time().'.'.$image->getClientOriginalExtension();
            $workspace_cover_path = public_path('/workspaceimgs');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(320, 240, function ($constraint) {
                $constraint->aspectRatio();
            })->save($workspace_cover_path.'/'.$workspace_cover_name);

            Workspace::where('id', $id)->update(['workspace_name' => $workspace_name, 'workspace_cover_name' => $workspace_cover_name, 'workspace_cover_path' => $workspace_cover_path]);

        } else if ($request->input("new_workspace_name") && !$request->hasFile('new_workspace_cover')) {

            $request->validate([
                'new_workspace_name' => 'required',
            ]);

            $workspace = Classroom::find($id);

            $workspace->workspace_name = $request->input('new_workspace_name');

            $workspace->save();

            return redirect('/dashboard');

        } else if (!$request->input("new_workspace_name") && $request->hasFile('new_workspace_cover')) {

            $request->validate([
                'new_workspace_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
            ]);

            $workspace = Workspace::find($id);

            $filename = $workspace->workspace_cover_name;

            if(File::exists('workspaceimgs/'.$filename)) {

                File::delete('workspaceimgs/'.$filename);
                /*
                    Delete Multiple File like this way
                    Storage::delete(['upload/test.png', 'upload/test2.png']);
                */
            }

            $image = $request->file('new_workspace_cover');
            $workspace_cover_name = time().'.'.$image->getClientOriginalExtension();
            $workspace_cover_path = public_path('/workspaceimgs');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(320, 240, function ($constraint) {
                $constraint->aspectRatio();
            })->save($workspace_cover_path.'/'.$workspace_cover_name);

            Workspace::where('id', $id)->update(['workspace_cover_name' => $workspace_cover_name, 'workspace_cover_path' => $workspace_cover_path]);

            return redirect('/dashboard');

        } else {
            // Retourne une erreur si aucun champ n'est rempli
            return redirect()->back()->withErrors(['error' => 'Veuillez remplir au moins un champ']);
        }
    }

    public function accessWorkspace($id)
    {
        $this->authorize('task_delete');

        $user_id = Auth::id();

        $workspace = Workspace::find($id);

        $title = $workspace->workspace_name." | Stock My Brain";

        return view('task.taskList', compact('title', 'workspace', 'user_id'));
    }
}