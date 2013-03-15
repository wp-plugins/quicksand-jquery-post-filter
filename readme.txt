=== Quicksand Post Filter jQuery Plugin ===


Contributors: developingtheweb
Donate link: http://www.developingtheweb.co.uk
Tags: quicksand, jquery filter, category filter, post filter
Requires at least: 3.0
Tested up to: 3.5.1
Stable Tag: 1.7.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Filter posts by their categories using the Quicksand jQuery filter plugin on any page. 

== Description ==

Filter posts by their categories using the Quicksand jQuery filter plugin on any page. You can select the categories you want to use in the admin area and limit the amount of posts to show. This plugin shows the thumbnail of the post if one has beens set as well as a linked post title.

Demo at http://www.developingtheweb.co.uk/plugins/quicksand-wordpress-plugin/

== Installation ==

1. Unzip the package and upload to your /wp-content/plugins/ directory.
2. Log into WordPress and navigate to the "Plugins" panel and acitivate the Quicksand Filter plugin
3. In the admin menu under the settings options you will see a new link for QuicksandFilter.
5. This plugin works best with the latest Wordpress updates and HTML 5 Doc Type.
6. Make sure you have posts and categories set up in the post admin area.
7. Navigate to the QuicksandFilter menu option.
8. The plugin will show category drop down boxes based on the amount of categories you have, any drop down box that has a value of none will not be shown as a filter option. 
9. Select whether to show category descriptions or not.
10. Select whether to show the list all posts tab/filter option.
11. Select whether the posts should display the featured image or not.
12. Select whether the posts should display the post title or not.
13. To get the plugin to display on your selected page you can either:
			a - use the shortcode on the page in the admin dashobard which is [quicksand]
			b - open the template php file and add echo do_shortcode('[quicksand]'); 
			c - open the template php file and run the function  if (function_exists('quicksand')) {	quicksand(); } 

14 .You are free to edit the plugin code to your own needs, just remember if you update it, it will over ride your changes. 

== Changelog ==

= 1.7.2 =

	1. Fixed Quicksand js error new from 1.7.1 changes, stops multiple category filters.

= 1.7.1 =

	1. Read me text update, removed note that mentions posts will only be attributed to one category.
	2. Removed quicksand.js browser detection for older internet explorers. No longer supported by jQuery 1.9+

= 1.7 =

    1. Filter now shows posts that belong to more than one category in all related filters (compared to first one previously).
    2. Added option to show category descriptions.
    3. Added option to hide list all tab.
    4. Added option to show or hide post featured images.
    5. Added option to show or hide post titles.
    6. Few bugs fixed with first install of undefined variables.
    7. Removed post limit as this method only showed limit number from the first category.

= 1.6=

	1. 'All' filter option now does not contain all the post categories but only the posts from selected filter categories. Thanks to Sparksight for bringing this to my attention.

= 1.5 =

	1. Some category numbers caused the posts to dissapear when all 5 input categories where chosen. Error has been fixed with ghost empty category.

= 1.4 =

	1. Some versions of jQuery had issues with selecting the filter categories by category name, this was changed to use category id's instead.

= 1.3 =

 1. Plugin includes naming error has been fixed as the name from local to development was changed to suit wordpress repo, unlikely that any of the previous versions have worked up until this fix.

= 1.2 =

 1. Removed admin option to include jQuery as this is not neccessary. Wordpress core will handle if jQuery is already included from another plugin.

= 1.1 =

 1. Errors occured if post was in multiple categories. Plugin now chooses the posts first category to filter with.

