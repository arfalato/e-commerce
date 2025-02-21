# e-commerce (PHP 8.x, Symfony 7.2.3, MariaDB 10.6.9)


## Installation
- donwload the project in a folder
- run Docker then command ```docker compose up --force-recreate```
- run ``` php bin/console doctrine:schema:update --dump-sql --force ``` in the project root of Docker php container
- run ```php bin/console doctrine:fixtures:load --env=dev``` in the project root of Docker php container in order to create a 
bunch of random products
- go to http://localhost/heartbeat in your browser: you should see a message "I am alive."

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

Request body: (make sure that products Ids are correct, see ```products``` table)
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
## ElasticSearch
- Implemented a simple example of ElasticSearch
- To check if works, go to http://localhost:9200/ in your browser: you should see a message like this:
```
{
  "name" : "d30977fea141",
  "cluster_name" : "docker-cluster",
  "cluster_uuid" : "bNoyv8WyT3WqLcWB9KIcng",
  "version" : {
    "number" : "8.5.1",
    "build_flavor" : "default",
    "build_type" : "docker",
    "build_hash" : "c1310c45fc534583afe2c1c03046491efba2bba2",
    "build_date" : "2022-11-09T21:02:20.169855900Z",
    "build_snapshot" : false,
    "lucene_version" : "9.4.1",
    "minimum_wire_compatibility_version" : "7.17.0",
    "minimum_index_compatibility_version" : "7.0.0"
  },
  "tagline" : "You Know, for Search"
}
```
- after created some orders run ```php bin/console fos:elastica:populate``` in the project root of Docker php container
You should see a message like this:
```
Resetting orders
 4/4 [============================] 100%
Populating orders
Refreshing orders
```
- Go to http://localhost:9200/orders/_search?pretty to check if the orders are indexed in ElasticSearch
you should see something like 
```
{
  "took" : 10,
  "timed_out" : false,
  "_shards" : {
    "total" : 1,
    "successful" : 1,
    "skipped" : 0,
    "failed" : 0
  },
  "hits" : {
    "total" : {
      "value" : 3,
      "relation" : "eq"
    },
    "max_score" : 1.0,
    "hits" : [
      {
        "_index" : "orders",
        "_id" : "1",
        "_score" : 1.0,
        "_source" : {
          "id" : 1,
          "name" : "first order",
          "description" : "first order description"
        }
      },
      {
        "_index" : "orders",
        "_id" : "2",
        "_score" : 1.0,
        "_source" : {
          "id" : 2,
          "name" : "ACME",
          "description" : "ACME description"
        }
      },
      {
        "_index" : "orders",
        "_id" : "3",
        "_score" : 1.0,
        "_source" : {
          "id" : 3,
          "name" : "My order",
          "description" : "My description"
        }
      }
    ]
  }
}
```
Elastic endpoint:
```
GET /orders/orders-elastic
```
Response
```
{
    "total": 3,
    "page": 1,
    "limit": 10,
    "pages": 1,
    "orders": [
        {
            "id": 1,
            "name": "first order",
            "description": "first order description"
        },
        {
            "id": 2,
            "name": "ACME",
            "description": "ACME description"
        },
        {
            "id": 3,
            "name": "My order",
            "description": "My description"
        }
    ]
}
```
Some simple search examples:
```
GET /orders-elastic?q=ACME
```
Response
```
{
    "total": 1,
    "page": 1,
    "limit": 10,
    "pages": 1,
    "orders": [
        {
            "id": 2,
            "name": "ACME",
            "description": "ACME description"
        }
    ]
}
```
```
GET /orders-elastic?limit=1
```
Response
```
{
    "total": 3,
    "page": 1,
    "limit": "1",
    "pages": 3,
    "orders": [
        {
            "id": 1,
            "name": "first order",
            "description": "first order description"
        }
    ]
}
```
