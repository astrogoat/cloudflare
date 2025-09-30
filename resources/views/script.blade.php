@if(app(Astrogoat\Cloudflare\Settings\CloudflareSettings::class)->enabled)
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endif
