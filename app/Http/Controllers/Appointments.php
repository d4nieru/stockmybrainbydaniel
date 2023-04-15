<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Appointments extends Controller
{
    public function showAppointments()
    {
        $title = "Mes Rendez-vous | Stock My Brain";

        $user = User::find(Auth::id());

        return view('dashboard.myAppointments', compact('title', 'user'));
    }

    public function showCreateAppointment($workspaceid)
    {
        $title = "Fixer un Rendez-vous | Stock My Brain";

        $workspace = Workspace::find($workspaceid);

        return view('dashboard.appointment', compact('title', 'workspace'));
    }

    public function postCreateAppointment(Request $request, $workspaceid)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'reason_for_the_meeting' => 'required',
            'meeting_date' => 'required',
            'meeting_time' => 'required',
        ]);

        $appointment = new Appointment();
        $appointment->reason_for_the_meeting = $request->input("reason_for_the_meeting");
        $appointment->meeting_date = $request->input("meeting_date");
        $appointment->meeting_time = $request->input("meeting_time");
        $appointment->is_active = 1;
        $appointment->host_of_the_meeting_id = Auth::id();
        $appointment->guest_of_the_meeting_id = $request->input("user_id");
        $appointment->save();

        $appointment_id = $appointment->id;

        $user = User::find($request->input("user_id"));
        $user->appointments()->attach($appointment_id, ['workspace_id' => $workspaceid]);

        return redirect()->back()->withMessage('Le rendez-vous a été planifié avec succès !');
    }

    public function showManageAppointments()
    {
        $title = "Gérer les Rendez-vous | Stock My Brain";

        //$user = User::find(Auth::id());
        $appointments = Appointment::all();

        return view('dashboard.manageAppointments', compact('title', 'appointments'));
    }

    public function generateLinkForVideoconference(Request $request)
    {
        $appointment = Appointment::findOrFail($request->input('appointmentid'));

        $appointment->videoconference_link = $request->input('url');
        $appointment->save();

        return redirect()->back();
    }

    public function cancelAppointment($appointmentid)
    {
        $appointment = Appointment::findOrFail($appointmentid);

        $appointment->is_active = 0;

        $appointment->update();

        return redirect()->back();
    }
}
