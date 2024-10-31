=== PB Unblock some IPs ===
Contributors: patbloom
Tags: block, private, indexing, no-follow, development, staging, developer, workflow, safety, privacy, secure
Requires at least: 4.5
Tested up to: 5.9.2
Stable tag: 0.7.6
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Block your website from being viewed - But unblock some IPs!


== Description ==

**PB Unblock some IPs** lets you block the access to your website when developing (like on a staging environment) - but unblock some IPs for viewing. No more hassle with .htaccess files and passwords! 


= Features =

* Toggle blocking on / off from settings page or admin top bar
* Blocks all IP addresses by default but will allow certain IPs to view the website on the frontend
* A 404 frontend page will appear to blocked IPs (with no-index, no-follow code and PHP 404 header) so bots won't index
* Blocked users can click a link which sends an 'unblock request' to a chosen e-mail address
* Add line separated IP addresses in the settings for who should be able to view the website
* WP-Admin can be fully accessed in any time (even with custom or secure admin URL)

https://www.youtube.com/watch?v=UMIL1bcCRbs

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory or install the zip within WordPress.
2. Activate the plugin through the `Plugins` menu in WordPress.
3. Configure the settings (left sidebar) - 'Settings > PB Unblock some IPs' or from Admin Top Bar.


== Frequently Asked Questions ==

= Will the plugin change code on my website =

No, the plugin is non-destructive and will only work when activated.

= Can I still login after activating =

Yes, all URLS except the "WP-Admin" are being blocked. When you use a custom url (like  "Hide Login plugin") make sure you enter the slug on the Settings section of the plugin.

= Why is the admin settings colored so super funky?

Because I like colours and it's possible :)

== Screenshots ==

1. View of the plugin admin settings
2. What a blocked visitor will see on the front-end (no e-mail link)
3. What a blocked visitor will see on the front-end (with e-mail link)
4. The e-mail you will get after an 'Unblock Request' is send

== Changelog ==

= 0.7.6 [2022.03.29] =
* Updated to Wordpress 5.9.2
* Updated: Updated version number

= 0.7.5 [2021.08.17] =
* Updated to Wordpress 5.8
* Updated: Updated version number

= 0.7.4 [2020.03.29] =
* Added: Video tutorial on plugin directory page
* Updated: Minor text changes
* Updated: Updated version number
* Celebrating: Plugin available for over 1 year!

= 0.7.3 [2020.01.13] =
* Added: Blocked users can send an 'Unblock Request' by clicking a link if an e-mail is filled in the settings
* Optimized: Minor typos
* Optimized: Cleaned up code
* Optimized: New Facebook URL
* Optimized: Updated version number

= 0.7.2 [2019.10.16] =
* Fixed: Resolved a minor PHP undeclared variable error when 'error reporting' is on
* Optimized: Updated version number

= 0.7.1 [2019.10.15] =
* Added: Status in Admin Top Bar (Green when active & Red when inactive)
* Optimized: Larger textarea for IPs, with line separation (instead of commas)
* Optimized: Cleaned up code
* Optimized: Rewrote some texts and updated version number
* Removed screenshots from plugin folder
* Removed 'css-map' files

= 0.7.0 [2019.05.15] =
* Added: Field for a Custom (secure) Admin URL if using
* Optimized: Styling & design in the admin section

= 0.6.1 [2019.05.14] =
* Fixed: Minor variable issue
* Optimized: Styling & design in the admin section

= 0.6.0 [2019.05.08] =
* Optimized: Styling & design in the admin section
* Optimized: Cleaned up code

= 0.5.0 [2019.03.23] =
* Initial Release