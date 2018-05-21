## Simple Product API for Belanja

### Requirements

* Git
* Composer
* PHP 7 or latest with SQLite PDO

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

### Configuration

### Running

To run this API using this command

```bash
cd public
php -S localhost:3000
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