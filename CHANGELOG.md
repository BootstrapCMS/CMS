CHANGE LOG
==========


## V0.9 Alpha (15/03/2015)

* Upgraded to laravel 5.0
* Upgraded to bootstrap 3.3.2
* Upgraded some assets
* Renamed providers to repositories
* Removed dependency on laravel database
* Cleaned up models and providers
* Cleaned up assets


## V0.8.5 Alpha (15/03/2015)

* Updated dependencies


## V0.8.4 Alpha (11/03/2015)

* Updated dependencies (fixes sentry vulnerability)


## V0.8.3 Alpha (11/02/2015)

* Updated dependencies
* Removed the extra symfony dependencies
* Fixed an issue with the blog comments


## V0.8.2 Alpha (12/11/2014)

* Updated dependencies
* Fixed some flash messages
* Fixed the datetime picker
* Patched the laravel csrf vulnerability


## V0.8.1 Alpha (24/10/2014)

* Asset updates
* Improved the test suite
* Presenter fixes and cleanup
* Started committing composer.lock
* Other minor fixes


## V0.8 Alpha (12/08/2014)

* Upgrade to Laravel 4.2
* Updated to Bootstrap 3.2
* Navigation improvements
* Queuing and mail improvements
* Removed viewer package
* Page improvements
* Added di aliases
* Added presenters
* Throttling improvements
* Added action history for users
* Added soft deleting
* Controller refactoring
* Code cleanup
* More unit tests


## V0.7.2 Alpha (26/05/2014)

* Fixed database issues


## V0.7.1 Alpha (24/05/2014)

* Blog comments fixes
* Updated to use my blade auth helpers
* Updated assets


## V0.7 Alpha (21/04/2014)

* Re-merge CMS Core and removed dependency
* PHP 5.6 and partial HHVM compatibility
* Code execution on pages now optional
* Updated to Bootstrap 3.1
* Controller refactoring
* Added more unit tests
* Improved travis testing
* Improved page deletion
* Command improvements
* Some performance improvements
* Improved input and validation
* Composer tweaks
* Minor tweaks


## V0.6 Alpha (08/02/2014)

* Support only laravel 4.1
* Ported to laravel platform
* Ported to laravel credentials
* PSR-4 autoloading
* Updated docs
* Improved view rendering
* Improved authentication
* Improved events
* Removed a few old routes
* Cleaned up some old code
* Removed broken tests
* Assets tweaks
* Minor tweaks


## V0.5 Alpha (19/12/2013)

* Made it PSR-2 compliant
* Massive refactoring
* Now leveraging CMS Core
* Updated for Bootstrap 3.0.3
* Improved styling generally
* Navigation improvements
* Queuing improvements
* Added cron functionality
* Minification and assets improvements
* Massively improved blog system
* Moved the CloudFlare integration to another package
* Moved the log viewer to another package
* Travis and Scrutinizer tweaks
* Testing improvements
* Updated doc blocks
* Coding style fixes


## V0.4 Alpha (25/08/2013)

* Made it PSR-0 compliant
* Refactored off the libs to other packages
* Added model providers
* Added events functionality
* Added wysiwyg to posts and events
* Added out of the box IronMQ support
* Added more tests
* Added caching
* Improved models
* Improved queuing
* Improved user management
* Improved commenting
* Allow specifying a separate mail queue
* Major logging and events improvements
* Basic CloudFlare api integration
* Updated the emails
* Minor cleanups
* Fixed some dodgie permissions
* Many other minor fixes


## V0.3.1 Alpha (12/08/2013)

* Added More tests
* Test refactoring
* Added Google Analytics support
* Cleaned up model deletion
* Improved user management
* Minor controller refactoring
* Tweaks to the account related controllers
* Some trait and interface organization
* Fixed some issues with the error pages
* Fixed an issue with homepage editing
* Tweaked the log viewer
* Tweaked the maintenance page
* Tweaked the base handler
* Tweaked composer.json
* Some logging improvements
* Config changes
* Other minor fixes


## V0.3 Alpha (09/08/2013)

* Added native support for CloudFlare proxies
* Added proper model deletion
* Added an actual profile page
* Added user management
* Added more tests
* Added the use of php traits
* Added support for scrutinizer-ci
* More test refactoring
* Major refactor of the Account Controller
* Improved the controller permissions system
* Fixed bootstrap switch
* Fixed the comment controller
* Fixed some account bugs
* Fixed some form errors
* Fixed some code complexity
* Fixed some unused variables
* Tweaked markdown support
* Registration now requires names
* Some css tweaks
* Some minor model tweaks
* Cleaned up the views
* Fixed composer.json
* Updated seeding
* Other minor fixes


## V0.2 Alpha (05/08/2013)

* Major improvements to page editing and creation
* Added page details for editors
* Added a blogging system
* Added markdown support
* Added load balancer support
* Added some more libs
* Added theme support
* Added a new maintenance page
* Added an error handler in-browser test
* Added a very basic in-browser test page
* Added a new assets system
* Added some proper relations using interfaces
* Added js, and html minification
* Added some working tests
* Added in-browser log viewing
* Added the option to disable blogging and events
* Updated navigation bad
* Added some button icons
* Now using Font Awesome
* Cleaned up the error page css
* Major controller refactoring
* Dropped ardent support
* Minor model refactoring
* View refactoring
* Some composer tweaks
* Changed the behavior of the app commands
* Fixed an issue with $job in BaseHandler
* Fixed a potential bug in the error pages
* Fixed duplicated error logging
* Fixed login redirects
* Fixed some html validation errors
* Fixed some migration and seeding issues
* Fixed a file permission issue
* Fixed some formatting issues
* Removed some old files
* Updated config
* Updated documentation
* Now available through composer
* Other minor fixes


## V0.1.1 Alpha (24/07/2013)

* Added a base model
* Added the db tables for the models
* Added a simple in-browser cache test
* Added basic use of apache
* Updated travis config
* Some composer tweaks
* Use unsigned values in the db where possible
* Cleaned up the routes
* Updated the relational modeling
* Changed the behavior of the app commands
* Fixed a bug in the page seeding
* Updated documentation
* Other minor fixes


## V0.1 Alpha (23/07/2013)

* Initial testing release
