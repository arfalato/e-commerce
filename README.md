# e-commerce (PHP 8.x, Symfony 7.2.3, MariaDB 10.6.9)


## Installation
- donwload the project in a folder
- run Docker then command ```docker compose up --force-recreate```
- run ``` php bin/console doctrine:schema:update --dump-sql --force ``` in the project root of Docker php container
- run ```php bin/console doctrine:fixtures:load --env=dev``` in the project root of Docker php container in order to create a 
bunch of random products
- go to http://localhost/heartbeat in your browser you should see a message "I am alive."

## phpMyAdmin:
- available at http://localhost:8081/ (username: root, password: root_psw)

## Tests:
- run ```php bin/phpunit``` in the project root of Docker php container
  output:
  ```
  PHPUnit 9.6.22 by Sebastian Bergmann and contributors.
  Testing 
  ......                                                              6 / 6 (100%)

  Time: 00:00.014, Memory: 8.00 MB

  OK (6 tests, 16 assertions)
  ```

## RestFul API endpoints provided:

### Create a new order:

 ```POST /orders ```

Request body: (make sure that products is are correct, see ```products``` table)
```
{
  "name": "first order",
  "description": "first order description",
  "products": [
    {
      "productId": 139,
      "quantity": 2
    },
    {
      "productId": 140,
      "quantity": 3
    }
  ]
}
```
Response body:
```
18
```
## Get one order:
 ```GET /orders/18 ```

Response body:
```
{
    "id": 18,
    "date": "2025-02-20 14:15:43",
    "name": "first order",
    "description": "first order description",
    "totalAmount": 4205,
    "products": [
        {
            "id": 139,
            "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
            "quantity": 2,
            "price": 694
        },
        {
            "id": 140,
            "name": "Product_0cc29afb64f118e920f4236be546c56d",
            "quantity": 3,
            "price": 939
        }
    ]
}
```
## Get all orders:
 ```GET /orders ```

Response body:
```
[
    {
        "id": 8,
        "date": "2025-02-20",
        "name": "ACME",
        "description": "ACME DES",
        "totalAmount": 10955,
        "products": [
            {
                "id": 135,
                "name": "Product_84fedd7e4bfb976135b19488424e6607",
                "quantity": 5,
                "price": 313
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 10,
                "price": 939
            }
        ]
    },
    {
        "id": 9,
        "date": "2025-02-20",
        "name": "Test order",
        "description": "order description",
        "totalAmount": 994,
        "products": [
            {
                "id": 131,
                "name": "Product_9ff83c92d41ab3390fa3f9d373e1d5ad",
                "quantity": 2,
                "price": 155
            },
            {
                "id": 132,
                "name": "Product_107a04ad4ee95be213de3720461ad228",
                "quantity": 3,
                "price": 228
            }
        ]
    },
    {
        "id": 10,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    },
    {
        "id": 11,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    },
    {
        "id": 12,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    },
    {
        "id": 13,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    },
    {
        "id": 14,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    },
    {
        "id": 15,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    },
    {
        "id": 16,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 3612,
        "products": [
            {
                "id": 133,
                "name": "Product_f31cb326ef86da9d1513bf5c11e65812",
                "quantity": 2,
                "price": 537
            },
            {
                "id": 141,
                "name": "Product_bb6e0ba16ffa0c6110b74d3f8a534fb4",
                "quantity": 3,
                "price": 846
            }
        ]
    },
    {
        "id": 17,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 3612,
        "products": [
            {
                "id": 133,
                "name": "Product_f31cb326ef86da9d1513bf5c11e65812",
                "quantity": 2,
                "price": 537
            },
            {
                "id": 141,
                "name": "Product_bb6e0ba16ffa0c6110b74d3f8a534fb4",
                "quantity": 3,
                "price": 846
            }
        ]
    },
    {
        "id": 18,
        "date": "2025-02-20",
        "name": "first order",
        "description": "first order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    }
]
```
## Update an order:
 ```PUT /orders/18 ```

Request body:
```
{
    "name": "PUT TEST",
    "description": "description by PUT",
    "products": [
        {
            "productId": 135,
            "quantity": 5
        },
        {
            "productId": 140,
            "quantity": 10
        }
    ]
}
```
Response Body
```
18
```

## Delete an order:
 ```DELETE /orders/18 ```


## Get orders by name:
 ```GET /orders?name=ACME ```

Response Body
```
[
    {
        "id": 8,
        "date": "2025-02-20",
        "name": "ACME",
        "description": "ACME DES",
        "totalAmount": 10955,
        "products": [
            {
                "id": 135,
                "name": "Product_84fedd7e4bfb976135b19488424e6607",
                "quantity": 5,
                "price": 313
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 10,
                "price": 939
            }
        ]
    }
]
```

## Get orders by description:
 ```GET /orders?description=ACME DES ```

Response Body
```
[
    {
        "id": 8,
        "date": "2025-02-20",
        "name": "ACME",
        "description": "ACME DES",
        "totalAmount": 10955,
        "products": [
            {
                "id": 135,
                "name": "Product_84fedd7e4bfb976135b19488424e6607",
                "quantity": 5,
                "price": 313
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 10,
                "price": 939
            }
        ]
    }
]
```

## Get orders by creation date:
 ```GET /orders?date=2025-02-20 ```

Response Body
```
[
    {
        "id": 8,
        "date": "2025-02-20",
        "name": "ACME",
        "description": "ACME DES",
        "totalAmount": 10955,
        "products": [
            {
                "id": 135,
                "name": "Product_84fedd7e4bfb976135b19488424e6607",
                "quantity": 5,
                "price": 313
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 10,
                "price": 939
            }
        ]
    },
    {
        "id": 9,
        "date": "2025-02-20",
        "name": "Test order",
        "description": "order description",
        "totalAmount": 994,
        "products": [
            {
                "id": 131,
                "name": "Product_9ff83c92d41ab3390fa3f9d373e1d5ad",
                "quantity": 2,
                "price": 155
            },
            {
                "id": 132,
                "name": "Product_107a04ad4ee95be213de3720461ad228",
                "quantity": 3,
                "price": 228
            }
        ]
    },
    {
        "id": 14,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    },
     {
        "id": 15,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 4205,
        "products": [
            {
                "id": 139,
                "name": "Product_07f1d9c25dac88cde68e33bd0730b216",
                "quantity": 2,
                "price": 694
            },
            {
                "id": 140,
                "name": "Product_0cc29afb64f118e920f4236be546c56d",
                "quantity": 3,
                "price": 939
            }
        ]
    },
    {
        "id": 16,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 3612,
        "products": [
            {
                "id": 133,
                "name": "Product_f31cb326ef86da9d1513bf5c11e65812",
                "quantity": 2,
                "price": 537
            },
            {
                "id": 141,
                "name": "Product_bb6e0ba16ffa0c6110b74d3f8a534fb4",
                "quantity": 3,
                "price": 846
            }
        ]
    },
   {
        "id": 17,
        "date": "2025-02-20",
        "name": "last order",
        "description": "last order description",
        "totalAmount": 3612,
        "products": [
            {
                "id": 133,
                "name": "Product_f31cb326ef86da9d1513bf5c11e65812",
                "quantity": 2,
                "price": 537
            },
            {
                "id": 141,
                "name": "Product_bb6e0ba16ffa0c6110b74d3f8a534fb4",
                "quantity": 3,
                "price": 846
            }
        ]
    }
]
```

