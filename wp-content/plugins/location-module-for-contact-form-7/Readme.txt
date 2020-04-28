=== Location Module (Lite) for Contact Form 7 ===
Contributors: nicolabavaro
Donate link: http://www.nicolabavaro.it/donate/
Tags: contact, form, contact form, location, module, geogode, gmaps, maps, geocoder
Requires at least: 4.3
Tested up to: 4.8.2
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Just another Contact Form 7 Extension. Let users send their location.

== Description ==

Location Module for Contact Form 7 is an "Contact Form 7" extension to let users search their location, adjust and send it. It displays an address form and a map (using Google Maps). The user can set their address and locate it on the Map by pressing "Set" button. Is possible to drag and drop the marker to adjust the location. Using: cf7-location-lng','cf7-location-lat' and 'cf7-location-url' tags is possible to send in the email the coordinates and the location link set by the user.

= Required Plugins =

The following plugins are required for Location Module (lite) for Contact Form 7  users:

* [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) by Takayuki Miyoshi - Contact Form 7 can manage multiple contact forms, plus you can customize the form and the mail contents flexibly with simple markup.

= This Plugin Needs Your Support =

It is hard to continue development and support for this free plugin without contributions from users like you. If you enjoy using Contact Form 7 Location Module and find it useful, please consider [__making a donation__](http://www.nicolabavaro.it/donate/). Your donation will help encourage and support the plugin's continued development.

== Installation ==

1. Upload the entire `location-module-for-contact-form-7` folder to the `/wp-content/plugins/` directory.
2. Ensure that Contact Form 7 is activated.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to Plugin Settings and fill API KEY field with a valid Google API key
4. Location Module is now available on the form edit page of Contact Form 7

== Screenshots ==

== Changelog ==

= 1.1.0 =
* New Feature: acquire GPS location
* Plugin rewritten in OOP
* Wrapped JS to avoid conflicts


= 1.0.12 =
* Security improvements
* Fixed Localization bug
* Added Custom Text on SET button
* Enable / Disable start location marker
* Added Italian Language


= 1.0.11 =
* Security improvements
* Localization support with https://translate.wordpress.org/projects/wp-plugins/location-module-for-contact-form-7
* If no Google Maps API KEY is set a dismissible warning appear on admin area.

= 1.0.10 =
* Added Reset Button and created an option to enable/disable it
* Bug Fix: When the location field isn't required and error that the field is required appear on form submit.
* Bug Fix: Default Zoom not working

= 1.0.9 =
* Added Reverse Geocoding function when user move the marker
* Added Map Type Option

= 1.0.8 =
* Fixed URL Update on map marker update
* Removed deprecated functions

= 1.0.7 =
* Fixed SET Button float problem
* Fixed JS Error on resize
* Switched to minified css

= 1.0.6 =
* Fixed Validation Deadlock

= 1.0.5 =
* Fixed JS BUG

= 1.0.4 =
* Fixed JS BUG

= 1.0.3 =
* Added Google Maps API Key option

= 1.0.2 =
* Added default values on plugin options
* Code improvements (Stability & Security)

= 1.0.1 =

* CSS Minor Fixes

= 1.0 =

* First Version

== Credits ==
Thanks to GMaps.js v0.4.25 https://github.com/hpneo/gmaps
