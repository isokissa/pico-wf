pico-wf
========

__pico-wf__ is a minimalistic multilingual web framework. It allows creating simple sites with pages, each of them containing the main 
menu with links to other pages. A page can contain articles, which may be written in multiple languages. 
Once multiple languages are introduced, the framework will require that all articles are written in all 
supported languages. 


The Development Environment
-----------------------

* I have used XAMPP bundle to get PHP5.5, Apache httpd and MySQL.
  Type "/opt/lampp/lampp start" to start, and browse to URL http://localhost

* lampp is very good, it will install everything in /opt/lampp, and will
  not polute any other directory with files. Because of that, find php
  cli directly from lampp directory: "/opt/lampp/bin/php"

* for convenience, include the /opt/lampp/bin/ into PATH: 


    PATH=$PATH:/opt/lampp/bin/


* to initialize the development environment, do:


    source setup.sh

The Development Principle(s)
---------------

Test-Driven Development is in use and [phpunit](https://github.com/sebastianbergmann/phpunit phpunit) unit-testing framework. 
