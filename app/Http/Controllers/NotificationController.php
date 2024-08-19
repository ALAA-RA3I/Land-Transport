<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Notify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    protected $firebaseService;

    public function __construct()
    {
//        $this->firebaseService = $firebaseService;
    }

    public function sendNotification(Request $request)
    {
        $user = Auth::guard('user')->user();
        $user=User::find($user->id);
        $user->notify(new Notify('hi', 'his'));
       return response()->json(['success' => true, 'message' => 'Notification sent!']);


        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $title = $validated['title'];
        $body = $validated['body'];

        // Send notification to the 'all' topic
        $response = $this->firebaseService->sendNotificationToTopic('all', $title, $body);

        // Return the response from Firebase
        return response()->json([
            'success' => true,
            'response' => json_decode($response),
        ]);
    }
    public function show_unread_notification(Request $request)
    {
        $array = [];
        $user = Auth::guard('user')->user();

        $notifications = $user->unreadNotifications;
        $sortedNotifications = $notifications->sortByDesc('created_at');

        foreach ( $sortedNotifications as $notification) {
            $notification->read_at = Carbon::now();
            $notification->save();
            $old_datetime = Carbon::parse($notification->created_at)->format('Y-m-d H:i');
            $day_name = date('l', strtotime($notification->created_at));

            $now = Carbon::now();


            if ($now->diffInHours($old_datetime) > 24 && $now->diffInHours($old_datetime) < 48) {
                $diff = 'yestarday at : ' . Carbon::parse($notification->created_at)->format(' h:i A');
            } else if ($now->diffInHours($old_datetime) > 24 && $now->diffInHours($old_datetime) < 168) {
                $diff = $day_name . ' at :' .  Carbon::parse($notification->created_at)->format(' h:i A');
            } else if ($now->diffInHours($old_datetime) > 24) {
                $diff = Carbon::parse($old_datetime)->format('Y-m-d h:i A');
            } else if ($now->diffInMinutes($old_datetime) < 60) {
                $diff = $now->diffInMinutes($old_datetime) . ' minutes ago';
            } else {
                $diff = $now->diffInHours($old_datetime) . ' hours ago';
            }

            $data= $notification->data;
            $string=strval($data[0]);

        $array[] = [
            'notification'=>  $string,
            'notiication sent at'=>  $diff
        ];
        }


        if($sortedNotifications != null)
        {return response()->json([
            'message'=>'succes',
            'data'=> $array

        ]);
        }
        else{
            return response()->json([
                'message'=>'succes',
                'data'=>[],
            ]);
        }
    }
    public function show_old_notification(Request $request)
    {

        $array = [];
        $user = Auth::guard('user')->user();

      //  return Notification::where('notifiable_id',$user->id)->get();
        return $user->notifications->all();
       return $notifications = $user->readNotifications;
        $sortedNotifications = $notifications->sortByDesc('created_at');
        foreach ($sortedNotifications as $key ) {
            $old_datetime = Carbon::parse($key->read_at)->format('Y-m-d H:i');
            $day_name = date('l', strtotime($key->read_at));

            $now = Carbon::now();


            if ($now->diffInHours($old_datetime) > 24 && $now->diffInHours($old_datetime) < 48) {
                $diff = 'yestarday at : ' . Carbon::parse($key->read_at)->format(' h:i A');
            } else if ($now->diffInHours($old_datetime) > 24 && $now->diffInHours($old_datetime) < 168) {
                $diff = $day_name . ' at :' .  Carbon::parse($key->read_at)->format(' h:i A');
            } else if ($now->diffInHours($old_datetime) > 24) {
                $diff = Carbon::parse($old_datetime)->format('Y-m-d h:i A');
            } else if ($now->diffInMinutes($old_datetime) < 60) {
                $diff = $now->diffInMinutes($old_datetime) . ' minutes ago';
            } else {
                $diff = $now->diffInHours($old_datetime) . ' hours ago';
            }

            $data= $key->data;
            $string=strval($data[0]);

        $array[] = [
            'notification'=>  $string,
            'read at'=>  $diff
        ];
        }

        if($sortedNotifications != null)
        {return response()->json([
            'message'=>'succes',
            'data'=> $array

        ]);
        }
        if($sortedNotifications != null){
            return response()->json([
                'message'=>'succes',
                'data'=>[],
            ]);
        }
    }
}
