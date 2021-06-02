# XML catalog to JSON converter

This small PHP application is build for practice purposes. It uses a custom build tiny framework for 
building PHP CLI applications. It can convert a messy XML catalog file to an easy to use JSON file.
It will organize and rebuild the products and pricings to a clean JSON array.


## Functionalities

* Normalizing as much data from the messy PIM structure as possible.
* Linking the products and prices from the catalog XML together.
* Providing a JSON file that can easily be worken with.
* Products are sorted by the XML order tag from low to high.


### Composer

Install the required packages.

```
composer install
composer check-platform-reqs
```


### Webserver

By default, we provide a PHP webserver.
However, you are free to use the tools you want to use. (Docker, Vagrant, Wamp, Xamp, Mamp, Homestead, Valet, ...)

```
composer run serve
```

This command will make the products file available through HTTP on
 `http://127.0.0.1:8000/products.json`.


### Usage

Conversion is done by command line. There are two commands included. 

* `help` - Get a list of the available commands
* `catalog source=... target=...` Convert the catalog XML file to a JSON file

```
php convert catalog source=... target=...
```
Example
```
php convert catalog test source=fixtures\catalog.xml target=public\products.json
```
