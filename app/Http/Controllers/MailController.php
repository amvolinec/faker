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
        return view('mail.index', [
            'text' => $faker->paragraph(5),
            'subject' => $faker->sentence(3),
        ]);
    }


    public function send(MailRequest $request, Faker $faker)
    {
        $text = $request->get('type') === 'text/html' ? $this->getHtml($request->get('text')) : $request->get('text');

        $settings = [
            'to' => $request->get('to'),
            'cc' => $request->get('cc'),
            'text' => $text,
            'encoding' => $request->get('encoding'),
            'subject' => $request->get('subject') ?? $faker->sentence(2),
            'image' => $request->get('image'),
            'type' => $request->get('type') . '; charset=utf-8',
        ];

        Mail::raw($settings['text'], function ($m) use ($settings) {
            $m->from(env('MAIL_FROM'), env('APP_NAME'));
            $m->to($settings['to']);

            if (!empty($settings['cc'])) {
                $cc = explode(',', $settings['cc']);
                $result = array_map('trim', $cc);
                $m->cc($result);
            }

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
            }

        });

        return redirect('mail')->with('status', 'Success');
    }

    protected function getHtml($text)
    {
        $text = str_replace("\r\n", '<br>', $text);
        $html = <<<EOF
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <p>
    %s
    </p>
</body>
</html>
EOF;
        return sprintf($html, $text);
    }
}
