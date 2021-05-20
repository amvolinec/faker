<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Faker\Generator as Faker;

class MailController extends Controller
{
    public function index(Faker $faker)
    {
        return view('mail.index', ['text' => $faker->sentence(5)]);
    }


    public function send(MailRequest $request, Faker $faker)
    {
        $settings = [
            'to' => $request->get('to'),
            'text' => $request->get('text'),
            'encoding' => $request->get('encoding'),
            'subject' => $faker->sentence(2),
            'image' => $request->get('image'),
            'type' => $request->get('type') . '; charset=utf-8',
        ];

        Mail::raw($settings['text'], function ($m) use ($settings) {
            $m->from(env('MAIL_FROM'), env('APP_NAME'));
            $m->to($settings['to']);
            $m->subject($settings['subject']);

            $m->getHeaders()->addTextHeader('MIME-Version', "1.0");
            $m->getHeaders()->addTextHeader('Content-Type', $settings['type']);
            $m->getHeaders()->addTextHeader('Content-Transfer-Encoding', $settings['encoding']);
            $m->getHeaders()->addTextHeader('Content-Language', 'lt-LT');

            if ($settings['image'] === 'on') {
                $m->attach(asset('/docs/voice.png'), [
                    'as' => 'voice.png',
                    'mime' => 'image/png'
                ]);

                $m->attach(asset('/docs/test.html'), [
                    'as' => 'test.html',
                    'mime' => 'text/html'
                ]);
            }

        });

        return redirect('mail')->with('status', 'Success');
    }
}
