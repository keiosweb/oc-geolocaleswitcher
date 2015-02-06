GeoLocale Switcher
--------------

**Link to company repo: http://gitlab.c-call.eu/october_plugins/geolocaleswitcher**

This is a very simple OctoberCMS plugin that automatically detects the country of the visitor and switch the website to appropriate language (basing on the iso code). If there is no language for given country - default language is triggered. If the visitor switches the language, the decision is remembered. 

By default, it uses free IP database (mmdb format). 

Any suggestions about development of this plugin are highly welcome.


####Warning

If you use the plugin from OctoberCMS Market, please do not use this repository. Voipdeploy brand is merging with Keios and this version of the plugin has all namespaces and table names replaced. As soon as our brand is upgraded in OctoberCMS Market, we will remove this notice.


####About
Plugin usage is very simple. It works when it's installed and enabled. If you want to stop using it - disable it or remove it. 
It forwards the visitor to appropriate language version of the website, basing on the detected location:

For example: website.com has 3 languages: English, German and French.

When visitor from Germany is detected, plugin redirects her/him to website.com/de

When visitor from French is detected, plugin redirects her/him to website.com/fr

When visitor from United States, Poland or China is detected, plugin triggers website.com in default language (/en).

You can find examplary usage on http://demo.keios.net.pl/

####Database
Database is stored in keios/geolocaleswitcher/database/database.mmdb

It has Creative Commons Attribution-ShareAlike 3.0 Unported License

You can change it to any compatible mmdb geolocation database you want, we will **never** upgrade this part of the plugin.

Link to the details of the database: http://dev.maxmind.com/geoip/legacy/geolite/

####Components
There is one component attached to this plugin. It's very simple and shows [Detected location] - [Current locale] 
(eg United States - English). You can customize it as a partial, as any other component. 

Component also provides ability to add a link to a page where the user can switch the language. 

####Coming soon
Component for multilanguage countries. It will work according to array you can find in Plugin.php. Right now, when there is for example visitor from Canada and website has three locales: German (default), English and French, English will trigger as a first language in languages array assigned to key CA. The component, which is currently under development, will allow to show visitors from exemplary Canada a quick switcher between English and French.
