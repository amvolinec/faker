<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function get()
    {
        $settings['host'] = config('database.connections.mysql2.host');
        $settings['database'] = config('database.connections.mysql2.database');
        $settings['username'] = config('database.connections.mysql2.username');
        $settings['password'] = config('database.connections.mysql2.password');
        return view('settings.edit', compact('settings'));
    }

    public function set(SettingsRequest $request)
    {
        config([
            'database.connections.mysql2.host' => $request->input('host'),
            'database.connections.mysql2.database' => $request->input('database'),
            'database.connections.mysql2.username' => $request->input('username'),
            'database.connections.mysql2.password' => $request->input('password'),
        ]);
        session()->flash(__('Success'));
        return redirect()->route('home');
    }
}
