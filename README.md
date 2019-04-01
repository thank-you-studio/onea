## These are the theme files. You'll still need to install the Wordpress shell

## Local Wordpress Setup:

1. Add the file `config.gulp.json` to the theme root directory. This file also contains the FTP login info to the server

2. Setup Database locally. I use MAMP Pro with this setup: https://tppr.me/382Au.
   The local URL is aliased to 'onea.wp'.
   There's database dump from staging URL in the project .zip file (ask for this file if you haven't received it).

3. Search/replace if the url alias/database does not match the above.

Theme Workflow:

1.  Open theme directory: wp-content/themes/one-a
2.  Run 'npm install' to install all dependencies
3.  Run 'gulp --tasks' to view all tasks
