## Simple Product API for Belanja

### Requirements

* Git
* Composer
* PHP 7 or latest with SQLite PDO
* Docker (Optional for Build Image)

### Installation

* Clone this repository using `git`

```bash
git clone git@github.com:andhikayuana/belanja-api.git
```

* Install dependencies using `composer`

```bash
cd belanja-api
composer install
```

### Running

To run this API using this command

```bash
cd belanja-api
php -S localhost:3000 -t public
```

### Build Image

You can build the docker image by using below command 

```
cd belanja-api
docker build -t api.belanja .
```

Now, you can access using Postman `http://localhost:3000` and see 

```json
{
    "code": 200,
    "msg": "Success",
    "data": {
        "name": "Belanja API Demo",
        "version": "1.0.0"
    }
}
```

### How to use

* `BASE_URL=http://localhost:3000`
* `GET` `/products` _get all products_

response example

```json
{
    "code": 200,
    "msg": "Success",
    "data": [
        {
            "id": 1,
            "name": "Sandal Mahal",
            "price": 5000000,
            "image": "https://anu.com/images/sandal-mahal.jpg"
        },
        {
            "id": 2,
            "name": "Baju Mahal",
            "price": 8000000,
            "image": "https://anu.com/images/baju-mahal.jpg"
        }
    ]
}
``` 

* `GET` `/products/{id}` _get product by id_

response example

```json
{
    "code": 200,
    "msg": "Success",
    "data": {
        "id": 1,
        "name": "Sandal Mahal",
        "price": 5000000,
        "image": "https://anu.com/sandal-mahal.jpg"
    }
}
```

* `POST` `/products` _insert product data_

request example

```json
{
	"name": "Sepatu Mahal Banget",
	"price": 6000000,
	"image": "http://anu.com/images/weird-shoes-3-1.jpg"
}
```

response example

```json
{
    "code": 200,
    "msg": "Success",
    "data": {
        "name": "Sepatu Mahal Banget",
        "price": 6000000,
        "image": "http://anu.com/images/weird-shoes-3-1.jpg",
        "id": 4
    }
}
```

* `PUT` `/products/{id}` _update product data_

request example

```json
{
	"name": "Sepatu Mahal wkwk",
	"price": 2500000,
	"image": "https://anu.com/weird-and-funny-shoes02.jpg"
}
```

response example

```json
{
    "code": 200,
    "msg": "Success",
    "data": {
        "id": 4,
        "name": "Sepatu Mahal wkwk",
        "price": 2500000,
        "image": "https://anu.com/weird-and-funny-shoes02.jpg"
    }
}
```

* `DELETE` `/products/{id}` _delete product data_

response example

```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

### Show QR Code for scanning the product

* `GET` `/products/qr-code` _show qr code to get product data_