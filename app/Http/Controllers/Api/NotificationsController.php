<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function recent(Request $request)
    {
        return $request->user()->unreadNotifications()->get();
    }

    public function get(Request $request, $id)
    {
        return $request->user()->unreadNotifications()->find($id);
    }

    public function markAsRead(Request $request)
    {
        $this->validate($request, [
            'ids' => 'array'
        ]);

        $request
            ->user()
            ->unreadNotifications()
            ->whereIn('id', $request->input('ids', []))
            ->update(['read_at' => Carbon::now()]);
    }
}
