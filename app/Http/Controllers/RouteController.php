<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

class RouteController extends Controller
{
    public function getRoutesXml()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
            ];
        });

        $xml = view('xml', compact('routes'))->render();

        return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function downloadRoutesXml()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
            ];
        });

        $xml = view('xml', compact('routes'))->render();

        $filename = 'xml';

        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
