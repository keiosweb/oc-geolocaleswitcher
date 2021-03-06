<?php namespace Keios\Geolocaleswitcher\Components;

use RainLab\Translate\Classes\Translator;
use RainLab\Translate\Models\Locale;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use App;

class GeoLocaleSwitcher extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'keios.geolocaleswitcher::lang.component.title', //GeoLocaleSwitcher
            'description' => 'keios.geolocaleswitcher::lang.component.description' //Displays locale switcher with current geoIP country
        ];
    }

    public function defineProperties()
    {
        return [
            'localeChangePage' => [
                'title' => 'keios.geolocaleswitcher::lang.component.langpage_title',
                'description' => 'keios.geolocaleswitcher::lang.component.langpage_description',
                'type' => 'dropdown'
            ]
        ];
    }

    public function getLocaleChangePageOptions()
    {
        return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'url');
    }

    public function localeChangePage()
    {
        $localeChangePage = $this->property('localeChangePage');
        return ($localeChangePage ?: null);
    }

    public function detectedCountry()
    {
        $geoIP = App::make('geoip');
        $location = $geoIP->getLocation();
        return $location['country'];
    }

    public function currentLocale()
    {
        $currentLocale = Translator::instance()->getLocale();
        $allAvailableLocale = Locale::listAvailable();
        return $allAvailableLocale[$currentLocale];
    }

}