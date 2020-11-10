<?php

namespace Sortarad\Lol\Widgets;

use Statamic\Widgets\Widget;
use Facades\GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;

class Lol extends Widget
{
    /**
     * The HTML that should be shown in the widget.
     *
     * @return string|\Illuminate\View\View
     */
    public function html()
    {
        $comics = $this->getComics();

        return view('sortarad::widgets.lol', ['comics' => $comics]);
    }

    /**
     * Get latest comics from 'xkdc'.
     *
     * @return array
     */
    protected function getComics()
    {
        return Cache::rememberWithExpiration('sortarad-lol', function() {
            try {
                $response = Guzzle::request('GET', 'https://xkcd.com/info.0.json', [
                    'headers' => [
                        'Accept'     => 'application/json',
                    ]
                ]);

                $json = json_decode($response->getBody(), true);

                return [120 => $json];
            } catch(RequestException $e) {
                return [1 => null];
            }
        });
    }
}
