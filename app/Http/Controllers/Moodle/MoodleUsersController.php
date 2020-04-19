<?php

namespace App\Http\Controllers\Moodle;

use App\Http\Controllers\Controller;
use App\Models\MoodleUser;
use Illuminate\Http\Request;

class MoodleUsersController extends Controller
{
    private $moodleUser;

    public function __construct(MoodleUser $moodleUser) {
        $this->moodleUser = $moodleUser;
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email'
        ]);

        try {
            $validated['password'] = bcrypt($validated['password']);
            $validated['confirmed'] = 1;
            $validated['mnethostid'] = 1;

            $this->moodleUser->create($validated);
            return response()->json([
                'status' => true,
                'message' => 'User successfully saved to Moodle'
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }
}
