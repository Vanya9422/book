<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

class VueServerSideRenderer
{
    protected $nodeRendererUri;
    protected $context = [];
    
    public function __construct($nodeRendererUri, $context)
    {
        $this->nodeRendererUri = $nodeRendererUri;
        $this->context = $context;
    }
    
    public function render()
    {
        try {
            $client = new Client;
            
            $response = $client->request('POST', $this->nodeRendererUri, [
                'json' => $this->context,
            ]);
            
            $this->context = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            $this->fallback();
        }
        
        return $this;
    }
    
    public function fallback()
    {
        $manifest = json_decode(File::get(public_path('vue-ssr-client-manifest.json')));
        $initialElementPaths = collect($manifest->initial);
        $this->context['resourceHints'] = '';
        
        $this->context['resourceHints'] .= $initialElementPaths->filter(function ($elementPath) {
            return preg_match('/[.]css(?:[?].*)?$/', $elementPath);
        })->map(function ($elementPath) use ($manifest) {
            return '<link rel="preload" href="' . $manifest->publicPath . $elementPath . '" as="style">';
        })->join('');
        
        $this->context['resourceHints'] .= $initialElementPaths->filter(function ($elementPath) {
            return preg_match('/[.]js(?:[?].*)?$/', $elementPath);
        })->map(function ($elementPath) use ($manifest) {
            return '<link rel="preload" href="' . $manifest->publicPath . $elementPath . '" as="script">';
        })->join('');
        
        $this->context['styles'] = $initialElementPaths->filter(function ($elementPath) {
            return preg_match('/[.]css(?:[?].*)?$/', $elementPath);
        })->map(function ($elementPath) use ($manifest) {
            return '<link rel="stylesheet" href="' . $manifest->publicPath . $elementPath . '">';
        })->join('');
        
        $this->context['outlet'] = '<div id="app"></div>';
        
        $this->context['scripts'] = $initialElementPaths->filter(function ($elementPath) {
            return preg_match('/[.]js(?:[?].*)?$/', $elementPath);
        })->map(function ($elementPath) use ($manifest) {
            return '<script src="' . $manifest->publicPath . $elementPath . '" defer></script>';
        })->join('');
        
        implode('', array_map(function ($scripPath) use ($manifest) {
            return '<script src="' . $manifest->publicPath . $scripPath . '" defer></script>';
        }, $manifest->initial));
        
        $this->context['executionTime'] = 0;
        
        return $this;
    }
    
    public function toArray()
    {
        return (array) $this->context;
    }
}