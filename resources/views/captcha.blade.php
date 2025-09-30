@php
    use Astrogoat\Cloudflare\Settings\CloudflareSettings;

    $settings = app(CloudflareSettings::class);
@endphp

@if($settings->enabled)
    <div class="cf-turnstile"
        data-sitekey="{{ $settings->site_key }}"
        data-callback="onTurnstileSuccess"
    ></div>

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            document.querySelector('form button[data-register-button]').disabled = true;
        })

        window.onTurnstileSuccess = function (code) {
            document.querySelector('form button[data-register-button]').disabled = false;
        }
    </script>
@endif
