pico-wf
=======

__pico-wf__ is a minimalistic multilingual web framework. Using pico-wf you can create 
simple web sites with multilingual pages. Each of pages contains the main 
menu with links to other pages. A page can contain articles, which may be written in 
multiple languages. Once multiple languages are introduced, the framework will require 
that all articles are written in all supported languages. 

Usage
-----

Directory structure of a site based on pico-wf:  

* *index.php*  -- homepage, provided by pico-wf
* *pico-wf/*   -- directory containing the code for pico-wf
* *contents/*  -- content provided by user

The user is supposed to first navigate to *index.php* page. The code on that page will 
check the *contents* directory and find all pages. It will also find out all supported
languages and will make sure that all strings for all pages are avialable in all 
supported languages. If this is not the case, *index.php* will show error message and
refuse to continue. This way, the author of the site is not allowed to productize 
a site which is not complete. 


### Structure of *contents* directory

The *contents* directory contains. 

* look&feel template (css)
* the "pages", those are logical structures of text, *not* a html or php pages.     
* multilingual strings for all pages

Look at the *site* directory for example. Make your own contents by imitating
the example. 

A *page* file contains the template for a page, consisting of the 
language-independent contents with references to multilingual strings. 
Multilingual strings have to be defined in all supported languages. 

There are few strings that must exist in every page: 

* __TITLE__, will be shown in browser's title-bar, but also as hint for menu items
* __SHORT_NAME__, will be used in visible menu items


### Page file format

Page file names have the following format. 

    <identifier>.pg
    
<identifier> is going to be the identifier of the page. Page file contains 
plain text of the page, with references to the multilingual strings. The plain 
text will be literaly shown to the user, while reference to the multilingual strings
will be replaced with strings in appropriate language. For example, the page with 
contents: 


    ${str1} <a href="google.com">${str2}</a> 

will be rendered as: 

    For search <a href="google.com">use Google</a>
    
when strings are defined as: 

    str1: "For search"
    str2: "use Google"

### Mutlilingual strings file format



Development Environment
-----------------------

* I have used XAMPP bundle to get PHP5.5, Apache httpd and MySQL.
  Type "/opt/lampp/lampp start" to start, and browse to URL http://localhost

* lampp is very good, it will install everything in /opt/lampp, and will
  not polute any other directory with files. Because of that, find php
  cli directly from lampp directory: "/opt/lampp/bin/php"

* for convenience, include the /opt/lampp/bin/ into PATH (the same is 
  also done in setup.sh): 

    PATH=$PATH:/opt/lampp/bin/

* to initialize the development environment, do:

    source setup.sh

* to download different dependent 3rd party libraries, including phpunit, 
  use composer. To get composer go to http://getcomposer.org and follow the 
  instructions. Once Composer is downloaded and installed, run: 

    php composer.phar update


The Development Principle(s)
----------------------------

Test-Driven Development is in use and [phpunit](https://github.com/sebastianbergmann/phpunit phpunit) 
unit-testing framework. So if you want to contribute, first write a failing test
and only then the implementation which makes the test pass. 

To run all tests, type:

    sh runtest.sh     
