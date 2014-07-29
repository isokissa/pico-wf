pico-wf
=======

__pico-wf__ is a minimalistic multilingual web framework. Using pico-wf one can create 
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
* the *.page* files containing the page metadata     
* Multiple *.text* files for all pages, each language has own *.text* file. 
There can be also files containing individual articles. 

Look at the *site* directory for example. Make your own contents by imitating
the example. 

#### Purpose and format of *.page* file

*.page* file's name has to be in format: 

    <page-id>.page

*page-id* is identifier of the page. Based on it, the framework will sort the
items in the menu alphabetically. 

*.page* file contains the page's metadata and page's common, language-independent 
macros. They are called 'macros' even though they are just strings, maybe one
day in future there will be also a more powerful macro-like functionalities. 


    PAGE_ID: page-id

    str1: <a href="sdfd.html">
    str2: </a>
    long_str: many lines
    with special characters < fdsf >> < $
    ending with 
    ===
    next-long-str: 
    first line
    second line
    ===

Every *.page* file must contain the *PAGE-ID* macro whose value must be
the identifief or the page, the same as in file name. 

#### Purpose and format of *.text* files

The files containing the text in different languages would 
have following filename format: 

    <page-id>.<language>.text

The text file contains in first three lines the metadata: 

* *PAGE_ID* the identifier of the page, the same as in file name
* *SHORT_NAME* short name of the page, which will appear in the menu
* *TITLE* title of the page, it will be used as title in HTML page
and also as tooltip for menu options. 

Here is example of a *.text* file: 
    
    PAGE_ID: <page-id>
    SHORT_NAME: Homepage
    TITLE: Homepage, a very first page
    CONTENTS:
    Here comes very nice text in English, with some ${str1}links to the 
    unknown${str2} that you have to click, in order to try. 
    
    
There can be also multiple articles for one page, and they have to be in 
separate files. 

TODO!

    <page-id>.<article-id>.<language>.article

    Example: home.en.text

    TITLE: Homepage
    
    here is the contentes of the home page ${str1}and press here for more${str2}





Development Environment
-----------------------

I have used XAMPP bundle to get PHP5.5, Apache httpd and MySQL.
Type "/opt/lampp/lampp start" to start, and browse to URL http://localhost

*lampp* is very convenient, it will install everything in /opt/lampp, and will
not polute any other directory with files. Because of that, find php
cli directly from lampp directory: "/opt/lampp/bin/php"

For convenience, include the /opt/lampp/bin/ into PATH (the same is also 
done in setup.sh): 

    PATH=$PATH:/opt/lampp/bin/

To initialize the development environment, do:

    source setup.sh

To download different dependent 3rd party libraries, including phpunit, 
use composer. To get composer go to http://getcomposer.org and follow the 
instructions. Once Composer is downloaded and installed, run: 

    php composer.phar update


The Development Principle(s)
----------------------------

Test-Driven Development is in use and [phpunit](https://github.com/sebastianbergmann/phpunit phpunit) 
unit-testing framework. If you want to contribute, first write a failing test
and only then the implementation which makes the test pass. 

To run all tests, type:

    sh runtest.sh     
