<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request) : ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request) : array
    {
        return array_merge(parent::share($request), [
            'breadcrumbs' => function () use ($request) {
                $segments = $request->segments();

                // Tambahkan root page
                $breadcrumb = [
                    ['text' => 'Dashboard', 'link' => '/'],
                ];

                $link = '/'; // Inisialisasi link dengan root page

                foreach ($segments as $segment) {
                    $link .= $segment . '/'; // Tambahkan segment ke link
                    $breadcrumb[] = [
                        'text' => ucfirst($segment),
                        'link' => $link,
                    ];
                }

                return $breadcrumb;
            },
        ]);
    }
}
