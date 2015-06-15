# Mladek #
... is clone of Django framework for PHP.

Contact to me to contribution or discuss: stv(o)seznam.cz.

Requirements: PHP 5.3

**Django** (http://www.djangoproject.com) is very popular framework written in python. I try to rewrite it in PHP. Or use same philosophy of that web framework in PHP.

  * It is called **"Mladek"** after one Czech singer and banjo player of funny-jazzy-country band.

  * Simple.

  * More explicit than implicit.

  * Use namespaces from PHP 5.3.

  * Programming with hard XP philosophy (very simple, naive and specific implementation then more robust through frequent refactoring when it is needed).

  * Use as much good PHP third party software as it is possible (For example inspiration in most innovative PHP framework "Nette" http://nettephp.com).


## Required features ##

  * Segmentation to "project" and "applications" (for first it looks good, uses namespaces and autoloading of classes).

  * mladek-admin.php and manage.php scripts for managing project (startproject done, startapp done).

  * Router with reverse like in Django (Done: routing, pass parameters, optional parameters, include urls, named routes)

  * Views (Done: get HttpRequest, return HttpResponse, maybe in future some generic views).

  * Models (Process: build on Doctrine? http://phpdoctrine.org, how implements managers?, validate, syncdb, shell)

  * Templates (Done: build on smarty http://www.smarty.net)

  * Middlewares

  * Context Processors

  * Forms like newforms in Django (base from Nette::Form, but probably rewrite)

  * Implement decorators

  * Newforms-admin (it is depending on previous modules)


## BasicUsage ##

This creates new project - new directory "my\_project" in your actual path.
```
php <path>/mladek/bin/mladek-admin.php startproject my_project
```

In project directory run this. It creates new appliacation - new directory "my\_app" in that project directory.
```
php manage.php startapp my_app
```