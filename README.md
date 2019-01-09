
# Starter Theme

Forked from the [Timber Starter Theme](https://github.com/timber/starter-theme). Also the [Yeoman Generator Webapp 3.0.1 files](https://github.com/yeoman/generator-webapp/tree/v3.0.1) have been incorporated to get BrowserSync and preprocessing/transpiling capabilities. The Boilerplate uses Twig, because the language is similar to Django and is being used in CraftCMS and Drupal 8. Also Twig is more human readable than PHP, and you have less writing to do.

## Installing the Theme

1. Download the zip for this theme (or clone it) and move it to `wp-content/themes` in your WordPress installation.
2. Rename the folder.
3. Run composer install in your theme folder to install Timber.
4. Activate the theme in Wordpress Admin Area > Appearance >  Themes.
5. Use Timber according to [the docs](https://github.com/jarednova/timber/wiki).
6. Install Advanced Custom Fields (optional, but do get the Pro version) [ACF Cookbook](https://timber.github.io/docs/guides/acf-cookbook/#nav)

## Installing the work environment

The project uses a similar setup as generator webapp, where you can find a cookbook to add features like stylus support. Please put all files into `source` and not `static`. The folder `static` will be deleted when running the gulp scripts. To install the work environment you need to:

1. Run `npm install`.
2. Run `gulp serve`.
3. Then develop putting styles into `source/styles` and adding scripts to `source/scripts` including them into `site.js`.
4. Before deploying the site run `gulp` which triggers the build version, doing some prefixing and uglifying, but still retaining the sourcemaps.

## Structure

`templates/` contains the Twig templates that get loaded from their PHP file counterpart in the theme root using the `Timber::render()` function.

`source/` contains your theme source files like styles, scripts, fonts and static htm.

## Other Resources

The [main Timber Wiki](https://github.com/jarednova/timber/wiki) is super great, so reference those often. Also, check out these articles and projects for more info:

* [This branch](https://github.com/laras126/timber-starter-theme/tree/tackle-box) of the starter theme has some more example code with ACF and a slightly different set up.
* [Twig for Timber Cheatsheet](http://notlaura.com/the-twig-for-timber-cheatsheet/)
* [Timber and Twig Reignited My Love for WordPress](https://css-tricks.com/timber-and-twig-reignited-my-love-for-wordpress/) on CSS-Tricks
* [A real live Timber theme](https://github.com/laras126/yuling-theme).
* [Timber Video Tutorials](http://timber.github.io/timber/#video-tutorials) and [an incomplete set of screencasts](https://www.youtube.com/playlist?list=PLuIlodXmVQ6pkqWyR6mtQ5gQZ6BrnuFx-) for building a Timber theme from scratch.

