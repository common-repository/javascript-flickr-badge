=== Javascript Flickr Badge ===
Contributors: erikrasmussen
Tags: widget, sidebar, flickr, photos, media, javascript, gallery
Requires at least: 2.0.2
Tested up to: 3.5.1
Stable tag: 2.3

Displays photos from Flickr, with optional tag filtering, with pure client-side javascript. Several eye-catching effects available.

== Description ==

Javascript Flickr Badge uses pure javascript to place a Flickr badge in your widget-enabled sidebar to display recent photos. Photos 
may be filtered by tag if so desired. All communication with Flickr is client-side, so no extra load is placed on your server at all.

[Plugin Page](http://blog.jyst.us/javascript-flickr-badge?utm_source=Wordpress&utm_medium=Wordpress%2BPlugin%2BDirectory&utm_campaign=Javascript%2BFlickr%2BBadge)

[Demo Video](http://www.youtube.com/watch?v=AyRj7U-dExI)

= Features =

* Customizable thumbnail size, number of rows, and number of columns to fit perfectly into any sidebar.
* Works for your personal photo stream, group pools, or your friends photostreams.
* Filtering by tag (user feed only).
* Lightweight javascript. No heavy libraries required!
* Works on mobile browsers
* All the work happens client-side. No server load.
* Animations, using CSS3: Vertical Scroll, Shuffle, Zoom (like Flickr's Flash Badge), 3D Horizontal Flip, 3D Vertical Flip
* Localized to Spanish.

== Installation ==

1. Unzip the plugin into the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Drag the widget onto the sidebar where you want it on the Sidebar Widgets page in your WordPress admin.
1. Enter your Flickr account details into the widget settings on the Widgets page in your WordPress admin (see screenshot)
 
== Screenshots ==

1. Widget Admin

== Frequently Asked Questions ==

= What's my "Flickr ID"? =

Your Flickr ID is a unique string used internally by Flickr. You can find your own by using [idgettr](http://idgettr.com/).

= Why is tag filtering limited to only user feeds? =

That's all the [Flickr Feed API](http://www.flickr.com/services/feeds/) allows.

= Why can't I see more photos? =

The RSS feed from Flickr is limited to twenty photographs.

== Changelog ==

= 1.0 =
* Initial release.
= 1.1 =
* Fixed bug that was causing animation to fail when rows != columns.
= 1.2 =
* Fixed javascript error in v1.1 animations.
= 1.3 =
* Fixed problem with shuffle animation in IE7
= 1.4 =
* Added two new animations: Zoom and Vertical Scroll
= 1.5 =
* Added "favorites" feed
* Added logo to widget admin
* Adjusted widget title link according to which feed is selected
= 2.0 =
* Removed Prototype.js dependency.
* Added CSS3 animations.
* Added 3D flip animations.
* Allowed animation speed and pause adjustments.
* Minified javascript.
= 2.1 =
* Fixed bug with shuffle animation
= 2.2 = 
* Fixed bug with tag filtering
= 2.3 = 
* Fixed another bug with tag filtering
