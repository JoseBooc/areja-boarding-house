<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    public function availability()
    {
        $rooms = Room::with('activeAssignment')->available()->orderBy('number')->paginate(12);
        return view('rooms.availability', compact('rooms'));
    }

    public function repairs()
    {
        if (! auth()->check() || ! Gate::allows('view-repairs')) {
            abort(403);
        }
        $rooms = Room::where('needs_repair', true)->orderBy('number')->paginate(12);
        return view('rooms.repairs', compact('rooms'));
    }
}
