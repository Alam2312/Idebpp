<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInternetConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //dd($next($request));

        // 8Verificamos si la solicitud es una vista de errores o si se trata de una solicitud Ajax
        if ($request->is('errors/noInternet') || $request->ajax()) {
            return $next($request);
        }

        $response = $next($request);

        if ($response instanceof \Illuminate\Http\Response && $request->isMethod('get')) {
            $content = $response->getContent();

            // Insert the script before the closing </body> tag
            $insertBefore = '</body>';
            $script = <<<EOT
            <script>
                function checkOnlineStatus() {
                    if (!navigator.onLine) {
                        window.location.href = '/errors/noInternet';
                    }
                }

                window.addEventListener('offline', checkOnlineStatus);
                checkOnlineStatus();
            </script>
            EOT;

            $content = str_replace($insertBefore, $script . $insertBefore, $content);
            $response->setContent($content);
        }

        return $response;
    }
}
