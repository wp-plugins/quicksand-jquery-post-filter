== Quicksand Post Filter jQuery Plugin ==


Contributors: developingtheweb
Donate link: http://www.developingtheweb.co.uk
Tags: quicksand, jquery filter, category filter, post filter
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Filter posts by their categories using the Quicksand jQuery filter plugin on any page.

== Description ==

Filter posts by their categories using the Quicksand jQuery filter plugin on any page. You can select the categories you want to use in the admin area and limit the amount of posts to show. 
This plugin shows the thumbnail of the post if one has beens set as well as a linked post title.


== Installation ==

1. Unzip the package and upload to your /wp-content/plugins/ directory.
2. Log into WordPress and navigate to the "Plugins" panel and acitivate the Quicksand Filter plugin
3. In the admin menu under the settings options you will see a new link for QuicksandFilter.
5. This plugin works best with the latest Wordpress updates and HTML 5 Doc Type.
6. Make sure you have posts and categories set up in the post admin area.
7. Navigate to the QuicksandFilter menu option.
8. Select a maximum of up to 5 filter options. 
9. Check the include Jquery box to include the latest version of Jquery from the Google repository. Do not include this if other plugins have added it or you have added it to the theme manually. 
10. You also need to set a limit of how many posts you want to display, type in a number in this field. 
11. To get the plugin to display on your selected page you can either:
			a - use the shortcode on the page in the admin dashobard which is [quicksand]
			b - open the template php file and add <?php echo do_shortcode('[quicksand]'); ?>
			c - open the template php file and run the function <?php if (function_exists('quicksand')) {	quicksand(); } ?>

12 .You are free to edit the plugin code to your own needs, just remember if you update it, it will over ride your changes. 


== Changelog ==


= 1.1 =

	- Removed list style from Firefox.
	- Fixed Jquery noconflict issue.
	- Used Wordpress native version of jQuery instead of Googles repository.