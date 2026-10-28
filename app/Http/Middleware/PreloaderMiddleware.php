<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreloaderMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldShowPreloader($request)) {
            $content = $response->getContent();

            $preloaderHtml = $this->getPreloaderHtml();

            if (strpos($content, '<body') !== false) {
                $content = preg_replace(
                    '/(<body[^>]*>)/',
                    '$1' . $preloaderHtml,
                    $content,
                    1
                );
            } else {
                $content = $preloaderHtml . $content;
            }

            $response->setContent($content);
        }

        return $response;
    }

    private function shouldShowPreloader(Request $request): bool
    {
        $path = $request->path();

        $publicPaths = [
            '',
            'about',
            'login',
            'privacy-policy',
            'event-selection',
            'estimation-result',
            'my-profile',
            'my-profile/edit'
        ];

        if (str_starts_with($path, 'admin')) {
            return false;
        }

        if (str_starts_with($path, 'api')) {
            return false;
        }

        if ($request->ajax()) {
            return false;
        }

        if (!$request->isMethod('GET')) {
            return false;
        }

        foreach ($publicPaths as $publicPath) {
            if ($path === $publicPath || str_starts_with($path, $publicPath . '/')) {
                return true;
            }
        }

        return false;
    }

    private function getPreloaderHtml(): string
    {
        return view('public.partials.preloader')->render();
    }
}