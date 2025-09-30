<?php

namespace Astrogoat\Cloudflare;

use Astrogoat\Cloudflare\Settings\CloudflareSettings;
use Closure;
use Helix\Lego\Apps\App;
use Helix\Lego\Apps\AppPackageServiceProvider;
use Helix\Lego\Apps\Services\IncludeAuthRegisterViews;
use Helix\Lego\Http\Middleware\HasValidCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelPackageTools\Package;

class CloudflareServiceProvider extends AppPackageServiceProvider
{
    public function registerApp(App $app): App
    {
        HasValidCaptcha::$isValid = function (Request $request, Closure $next) {
            $turnstileCode = $request->input('cf-turnstile-response');

            if (blank($turnstileCode)) {
                return back()->withErrors(['captcha' => 'Captcha failed.']);
            }

            $isValid = Http::post(
                url: 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
                data: [
                    'secret' => app(CloudflareSettings::class)->site_secret,
                    'response' => $turnstileCode,
                ]
            )->json('success');

            if (! $isValid) {
                return back()->withErrors(['captcha' => 'Captcha failed.']);
            }

            return $next($request);
        };

        return $app
            ->name('cloudflare')
            ->settings(CloudflareSettings::class)
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])->includeAuthRegisterViews(function (IncludeAuthRegisterViews $registerViews) {
                ;

                return $registerViews
                    ->addToHead('cloudflare::script')
                    ->addToCaptcha('cloudflare::captcha');
            });

    }

    public function bootingPackage()
    {
    }

    public function configurePackage(Package $package): void
    {
        $package->name('cloudflare')->hasConfigFile()->hasViews();
    }
}
