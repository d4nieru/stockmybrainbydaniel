<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workspace;
use Gate;

class UserManagement extends Controller
{
    public function manageMembers($id)
    {
        $title = "Gérer les Membres | Stock My Brain";

        $user_id = Auth::id();

        $user = User::find($user_id);

        $workspace = Workspace::find($id);

        return view('workspace.manageMembers', compact('title', 'user', 'workspace', 'user_id'));
    }

    public function addUserToWorkspace(Request $request, $workspaceid)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $email = $request->input("email");

        $workspace = Workspace::find($workspaceid);

        $user = User::where('email', $email)->first();

        $usr = $workspace->users()->where('email', '=', $email)->exists();

        if ($user) {

            if(!$usr) {

                $workspace = Workspace::find($workspaceid);

                $workspace->users()->syncWithoutDetaching($user->id);

                return redirect()->back();

            } else {

                return redirect()->back()->with('alert', "L'email est déjà lié");
            }
            
        } else {

            return redirect()->back()->with('alert', "L'email n'existe pas dans notre base de données !");
        }
    }

    public function removeUserFromWorkspace($workspaceid, $listeduserid)
    {
        $workspace = Workspace::find($workspaceid);

        $user_id = Auth::id();

        $user1 = User::find($user_id);
        $user2 = User::find($listeduserid);

        $workspace->users()->detach($listeduserid);
        
        return redirect()->back();
    }

    public function transferOwnership($id, $listeduserid)
    {
        $workspace = Workspace::find($id);

        $user_id = Auth::id();

        $user1 = User::find($user_id);
        $user2 = User::find($listeduserid);

        $user1->workspaces()->updateExistingPivot($id, ['ownership' => 0]);
        $user2->workspaces()->updateExistingPivot($id, ['ownership' => 1]);

        return redirect()->back();
    }

    public function changeRole(Request $request, $id, $listeduserid)
    {
        $user_id = Auth::id();

        $request->validate([
            "userrole"=>"required"
        ]);

        $role = $request->input("userrole");

        $user1 = User::find($user_id);
        $user2 = User::find($listeduserid);

        if($role == "admin") {
   
            $user2->workspaces()->updateExistingPivot($id, ['admin' => 1]);
    
            return redirect()->back();

        } elseif ($role == "contributor") {

            $user2->workspaces()->updateExistingPivot($id, ['ownership' => 0, 'admin' => 0]);
    
            return redirect()->back();

        } else {

            return;
        }
    }
}
