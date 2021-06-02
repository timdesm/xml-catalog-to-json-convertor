FORMAT: 1A
HOST: https://127.0.0.1:8000

# Products API

## Load all products [GET /products.json]

Load all products

+ Request (application/json)

+ Response 200 (application/json)
    + Attributes (ProductList)

# Data Structures

## ProductList (object)

+ products (array[Product], fixed-type)

## Product (object)

+ id (string, required)
+ categories (array[string], required)
+ names (OptionalLocalized, required)
+ prices (array[Price], required, fixed-type)
+ image (string, required, nullable)

## OptionalLocalized (object)
+ en_US (string, optional, nullable)
+ en_UK (string, optional, nullable)

## Price (object)

+ id (string, required)
+ amount (number, required)
+ currency (string, required)
