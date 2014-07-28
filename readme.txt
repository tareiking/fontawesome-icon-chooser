=== FontAwesome Icon Chooser for WP Visual Editor  ===
Contributors: Tarei King, Bronson Quick, Lachlan MacPherson, Ryan McCue
Tags: editor, tinymce
Requires at least: 3.9.1
Tested up to: 3.9.1
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds a FontAwesome Icon chooser to any Visual Editor area within WordPress.

== Description ==

Built atop the awesome work of Josh18: https://github.com/josh18/TinyMCE-FontAwesome-Plugin/blob/master/README.md with extending TinyMCE to use a FontAwesome icon picker.

Still a work in progress, there are a few known issues.

== Known Issues ==

- Sometimes "ICONS" flag doesnt show within TinyMCE button spaces
- Sometimes displays [] instead of FontAwesome icon

== Installation ==

Coming soon...

= Got any Developer filters? =

At the moment you can turn on or off enqueueing default css by using the following:

```
function tmc_defaults( $args ){
	$args['enqueue_css'] = false; // also accepts true;

	return $args;
}

add_filter( 'tinymce_fontawesome_css', 'tmc_defaults' );
```

== Screenshots ==

Coming soon...

== Changelog ==

= 0.1 =
Ohai.. this is the first trip to the repo