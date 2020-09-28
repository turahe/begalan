<?php

namespace App\Providers;

use App\Option;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if ($this->app->isLocal()) {
//            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
//            $this->app->register(TelescopeServiceProvider::class);
//            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
//        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

//        Membuat Directive Custom Untuk Format Mata Uang

        Blade::directive('currency', function ( $expression ) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });

        $this->options();


    }

    protected function options()
    {
        if (file_exists(base_path('.env'))) {
            try {
                DB::connection()->getPdo();

                /**
                 * Get option and set it to config
                 */
                $options = Option::all()->pluck('option_value', 'option_key')->toArray();
                $configs = [];
                $configs['options'] = $options;

                /**
                 * Get option in some specific way
                 */
                $configs['options']['allowed_file_types_arr'] = array_filter(explode(',', array_get($options, 'allowed_file_types')));
                /**
                 * Load language file from theme
                 */
                $configs['lang_str'] = [];
                $theme_slug = array_get($options, 'current_theme');
                if ($theme_slug) {
                    $local = app()->getLocale();
                    $language_path = public_path("themes/{$theme_slug}/languages/{$local}.php");
                    if (file_exists($language_path)) {
                        $configs['lang_str'] = include_once $language_path;
                    }
                }
                $configs['app.timezone'] = array_get($options, 'default_timezone');
                $configs['app.url'] = array_get($options, 'site_url');
                $configs['app.name'] = array_get($options, 'site_title');

                $configs = apply_filters('app_configs', $configs);
                config($configs);

                /**
                 * Set dynamic configuration for third party services
                 */

                /**
                 * Set dynamic configuration for third party services
                 */
                $amazonS3Config = [
                    'filesystems.disks.s3' =>
                        [
                            'driver' => 's3',
                            'key' => get_option('amazon_key'),
                            'secret' => get_option('amazon_secret'),
                            'region' => get_option('amazon_region'),
                            'bucket' => get_option('bucket'),
                        ]
                ];

                $socialConfig['services'] = [
                    'facebook' => [
                        'client_id' => get_option('social_login.facebook.app_id'),
                        'client_secret' => get_option('social_login.facebook.app_secret'),
                        'redirect' => url('login/facebook/callback'),
                    ],
                    'google' => [
                        'client_id' => get_option('social_login.google.client_id'),
                        'client_secret' => get_option('social_login.google.client_secret'),
                        'redirect' => url('login/google/callback'),
                    ],
                    'twitter' => [
                        'client_id' => get_option('social_login.twitter.consumer_key'),
                        'client_secret' => get_option('social_login.twitter.consumer_secret'),
                        'redirect' => url('login/twitter/callback'),
                    ],
                    'linkedin' => [
                        'client_id' => get_option('social_login.linkedin.client_id'),
                        'client_secret' => get_option('social_login.linkedin.client_secret'),
                        'redirect' => url('login/linkedin/callback'),
                    ],
                    'mailgun' => [
                        'domain' => get_option('mailgun.domain') ?? env('MAILGUN_DOMAIN'),
                        'secret' => get_option('mailgun.secret') ?? env('MAILGUN_SECRET'),
                        'endpoint' => get_option('mailgun.endpoint') ?? env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
                    ],

                    'postmark' => [
                        'token' => get_option('postmark.token') ?? env('POSTMARK_TOKEN'),
                    ],

                    'ses' => [
                        'key' => get_option('postmark.key') ?? env('AWS_ACCESS_KEY_ID'),
                        'secret' => get_option('postmark.secret') ?? env('AWS_SECRET_ACCESS_KEY'),
                        'region' => get_option('postmark.region') ?? env('AWS_DEFAULT_REGION', 'us-east-1'),
                    ],
                ];

                config($socialConfig);
                config($amazonS3Config);

                /**
                 * Email from name
                 */

                $emailConfig = [
                    'mail.from' =>
                        [
                            'address' => get_option('email_address'),
                            'name' => get_option('site_name'),
                        ]
                ];
                config($emailConfig);

                date_default_timezone_set(array_get($options, 'default_timezone'));

                require get_theme()->path . 'functions.php';
            } catch (\Exception $e) {
                //
            }
        } else {
            if (! strpos(request()->getPathInfo(), 'installations')) {
                die("<script>location.href= '".url('installations')."' </script>");
            }
        }
    }
}
