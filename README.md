pico-wf
=======

__pico-wf__ is a minimalistic multilingual web framework. Using pico-wf one can create 
simple web sites with multilingual pages. Each of pages contains main 
menu with links to other pages. A page can contain articles, which may be written in 
multiple languages. Once multiple languages are introduced, the framework will 
try to assure that all articles are written in all supported languages [TODO]. 

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
* the *site.config* is a string-map file which describes the configuration of the site, 
  what are the pages included and what are the supported languages. The 
  site will be consistency-checked against the configuration specified in 
  this file. 
* the *.page* files are string-maps containing the page metadata     
* Multiple *.text* files for all pages, each language has own *.text* file, in 
  format of string-map

[TODO] There can be also files containing individual articles. 

Look at the *site* directory for example. Make your own contents by imitating
the example. 

#### Format of string-map files

A string-map file contains set of _name:value_ pairs. There can be _single-line_
and _multiple-line_ name-value pairs, depending on whether _value_ 
fits into single line or into multiple lines. 

The example _single-line_ _name:value_ pair: 

    my-string-name:my string contents
    
Everything from the start of the line till the first ":" is considered to 
be the name of the string, except leading and trailing spaces. The rest of 
the line, after ":" is considered to be the value. 

The example _multiple-line_ _name:value_ pair, with embedded explanations: 

    my-string-name:
    Here comes the contents in multiple lines
    Terminated by a special end-of-string line or 
    the end of file.
    Special end-of-string line is the one which contains only 
    "===EOS===" string. 
    ===EOS===
    my-next-string-name:
    This multiline string ends at end of file. 
    note that the line after name of the string and ":"
    has to be empty. This is the indication to parser
    that the string is multiline. 
    

#### Purpose and format of *site.config* file

*site.config* file contains a string-map describing global, site-wide 
parameters: 

* **pages**, contains the comma separated list of pages in the site. 
  The order in which pages appear in the list is important, becasue this 
  will be the order in which pages will appear in menus. First page in the
  list will be also default or home page. 
* **languages**, contais the semicolumn-separated list of supported languages. 
  pico-wf will expect that all pages given in the list are available in all 
  supported languages. The order in which languages appear in this list is 
  important because this will be the order in which lanugages will appear in 
  language selecting menu. First language in the list is also the default 
  language. 
  
  Each language within the list of languages is specified by short id and 
  single word full language name, separated by comma. Short id is used in URL's, 
  while full language name appears in language selector menus. 
* **global-header** contains the HTML text that will be included as first
  string for all pages in the site. 
* **global-footer** contains the HTML text that will be included as last
  string for all pages in the site. 

Example of *site.config* file: 

    pages: p1, p2, p3 ...
    languages: en,English; fi,Suomi
    global-header: 
    <h3>here comes any kind of HTML text you want as header of the page</h3>
    ===EOS===
    global-footer: 
    <p>(c) 2014 isokissa.org all rights reserved</p>
    ===EOS===
    
In **pages** and **languages** parameters, there can be any number of 
spaces between separators and words. 

Note that **global-header** and **global-footer** are the same for all 
languages.

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
    ===EOS===
    next-long-str: 
    first line
    second line
    ===EOS===

Every *.page* file must contain the *PAGE-ID* macro whose value must be
the identifief or the page, the same as in file name. 

#### Purpose and format of *.text* files

The files containing the text in different languages would 
have following filename format: 

    <page-id>.<language>.text

The text file must contain the metadata in the following strings with fixed names: 

* **PAGE_ID** the identifier of the page, the same as in file name
* **SHORT_NAME** short name of the page, which will appear in the menu
* **TITLE** title of the page, it will be used as title in HTML page
and also as tooltip for menu options. 

The contents of the page in particular language is stored in the string with 
name *CONTENTS*.

Here is example of a *.text* file: 
    
    PAGE_ID: <page-id>
    SHORT_NAME: Homepage
    TITLE: Homepage, a very first page
    CONTENTS:
    Here comes very nice text in English, with some ${str1}links to the 
    unknown${str2} that you have to click, in order to try. 
    
#### Articles [TODO]

There can be also multiple articles for one page, and they have to be in 
separate files. 

    <page-id>.<article-id>.<language>.article

    Example: home.en.text

    TITLE: Homepage
    
    here is the contentes of the home page ${str1}and press here for more${str2}



Development Environment
-----------------------

I have used XAMPP bundle to get PHP5.5, Apache httpd and MySQL.
Type "/opt/lampp/lampp start" to start, and browse to URL http://localhost

*lampp* is very convenient, it will install everything in /opt/lampp, and will
not polute any other directory with files. Therefore, find php
cli directly from lampp directory: "/opt/lampp/bin/php"

For convenience, include /opt/lampp/bin/ into PATH (the same is also 
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
