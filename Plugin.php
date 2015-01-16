<?php namespace Voipdeploy\GeoLocaleSwitcher;

use RainLab\Translate\Models\Locale as LocaleModel;
use RainLab\Translate\Classes\Translator;
use System\Classes\PluginBase;
use Redirect;
use Request;
use App;
use Config;
use Session;


/**
 * GeoLocaleSwitcher Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'voipdeploy.geolocaleswitcher::lang.plugin.name', //GeoLocaleSwitcher
            'description' => 'voipdeploy.geolocaleswitcher::lang.plugin.description', //Provides language switching with MaxMind GeoIP Database
            'author' => 'Voipdeploy',
            'icon' => 'icon-globe'
        ];
    }

    public function registerComponents()
    {
        return [
            'Voipdeploy\GeoLocaleSwitcher\Components\GeoLocaleSwitcher' => 'geoLocaleSwitcher'
        ];
    }

    public function boot()
    {
        $firstSegment = Request::segment(1);
        $availableLocales = LocaleModel::listAvailable();

        App::register('Voipdeploy\GeoIP\GeoIPServiceProvider');

        Config::set('geoip::service', 'maxmind');
        Config::set('geoip::maxmind.type', 'database');
        Config::set('geoip::maxmind.database_path', base_path() . '/plugins/voipdeploy/geolocaleswitcher/database/database.mmdb');

        if (Session::has(Translator::SESSION_LOCALE)) {
            return;
        }

        $geoIP = App::make('geoip');

        $location = $geoIP->getLocation();

        $isoCodeFromIP = strtolower($location['isoCode']);

        $backendUri = str_replace('/', '', Config::get('cms.backendUri'));

        if (array_key_exists($isoCodeFromIP, $availableLocales) && (strpos(Request::path(), $backendUri) === false) && (!array_key_exists($firstSegment, $availableLocales))) {
            Redirect::to($isoCodeFromIP . Request::getRequestUri())->withInput()->send();
            App::shutdown();
            exit();
        }
    }

}
