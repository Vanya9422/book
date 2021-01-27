<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function default(Request $request)
    {
        $routeName = $request->route()->getName();
        store('meta.title', store('state.translations.meta.' . $routeName . '.title'));
        store('meta.description', store('state.translations.meta.' . $routeName . '.description'));
        
        return response()->handle();
    }
    
    public function notFound()
    {
        store('meta.title', store('state.translations.meta.not_found.title'));
        
        return response()->handle(404);
    }
}
