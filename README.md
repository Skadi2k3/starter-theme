
# Starter Theme

Forked from the [Timber Starter Theme](https://github.com/timber/starter-theme). Also the [Yeoman Generator Webapp 3.0.1 files](https://github.com/yeoman/generator-webapp/tree/v3.0.1) have been incorporated to get BrowserSync and preprocessing/transpiling capabilities. The Boilerplate uses Twig, because the language is similar to Django and is being used in CraftCMS and Drupal 8. Also Twig is more human readable than PHP, and you have less writing to do.

## Installing the Theme

Install this theme as you would any other, and be sure the Timber plugin is activated. But hey, let's break it down into some bullets:

1. Run composer install in your theme folder to install Timber.
2. Download the zip for this theme (or clone it) and move it to `wp-content/themes` in your WordPress installation.
3. Rename the folder to something that makes sense for your website (generally no spaces and all lowercase). You could keep the name `timber-starter-theme` but the point of a starter theme is to make it your own!
4. Activate the theme in Appearance >  Themes.
5. Use Timber according to [the docs](https://github.com/jarednova/timber/wiki).
6. Install Advanced Custom Fields Pro (optional, but do get the Pro version) [ACF Cookbook](https://timber.github.io/docs/guides/acf-cookbook/#nav)

## Installing the work environment

The project uses a similar setup as generator webapp, where you can find a cookbook to add features like stylus support. Please put all files into `source` and not `static`. The folder `static` will be deleted when running the gulp scripts. To install the work environment you need to:

1. Run `npm install`.
2. Run `gulp serve`.
3. Then develop putting styles into `source/styles` and adding scripts to `source/scripts` including them into `site.js`.
4. Before deploying the site run `gulp` which triggers the build version, doing some prefixing and uglifying, but still retaining the sourcemaps.

## Structure

`templates/` contains all of your Twig templates. These pretty much correspond 1 to 1 with the PHP files that respond to the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where that data (or `$context`) will be used. Just an FYI.

`bin/` and `tests/` ... basically don't worry about (or remove) these unless you know what they are and want to.

## Other Resources

The [main Timber Wiki](https://github.com/jarednova/timber/wiki) is super great, so reference those often. Also, check out these articles and projects for more info:

* [This branch](https://github.com/laras126/timber-starter-theme/tree/tackle-box) of the starter theme has some more example code with ACF and a slightly different set up.
* [Twig for Timber Cheatsheet](http://notlaura.com/the-twig-for-timber-cheatsheet/)
* [Timber and Twig Reignited My Love for WordPress](https://css-tricks.com/timber-and-twig-reignited-my-love-for-wordpress/) on CSS-Tricks
* [A real live Timber theme](https://github.com/laras126/yuling-theme).
* [Timber Video Tutorials](http://timber.github.io/timber/#video-tutorials) and [an incomplete set of screencasts](https://www.youtube.com/playlist?list=PLuIlodXmVQ6pkqWyR6mtQ5gQZ6BrnuFx-) for building a Timber theme from scratch.

