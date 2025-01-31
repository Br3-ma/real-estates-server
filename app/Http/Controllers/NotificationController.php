<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $data = $user->notifications;

        // Mark all unread notifications as read if any exist
        if ($user->unreadNotifications->isNotEmpty()) {
            $user->unreadNotifications->markAsRead();
        }

        return response()->json($data, 200);
    }

    /**
     * Show the count of unread notifications for a specific user.
     */
    public function count($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $unreadCount = $user->unreadNotifications->count(); // Get count of unread notifications

        return response()->json($unreadCount, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
