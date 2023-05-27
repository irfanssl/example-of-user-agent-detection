<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAgent;
use Exception;
use Illuminate\Support\Facades\Log;

class UserLogController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $data['user'] = User::with('last_user_agent')->paginate(10);
        return view('users', $data);
    }

    public function save(Request $request)
    {
        try {
            // dd($request->os);
            $data = json_encode([
                'browser'       => $request->browser,
                'os'            => $request->os,
                'device_vendor' => $request->device_vendor,
                'device_model'  => $request->device_model,
                'device_type'   => $request->device_type
            ]);
    
            $user_agent = new UserAgent();
            $user_agent->user_agent = $data;
            $user_agent->user_id = auth()->user()->id;
            $user_agent->save();
    
            return response()->json([
                'status' => 'Success',
                'code' => 200,
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            
            return response()->json([
                'status' => 'Failed',
                'code' => 500
            ]);
        }
    }

    public function get_user_agent($email)
    {
        $data['user'] = User::with('user_agent:user_agent,user_id,created_at')
                        ->where('email', $email)
                        ->first();
        return view('log', $data);
    }
}
