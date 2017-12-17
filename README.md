## The Artisan command to queue for beanstalk

The component provides an artisan command for Beanstalk. With which you can run worker for all queues that have the format subject.queue. 

### Install
```composer require friday14/artisan-beanstalk ~1.0```

Add the ServiceProvider to the providers array in config/app.php

```php
Friday14\Beanstalk\ServiceProvider::class
```

### Usage Instructions

For example, if there are 3 queues with names
``
subject.queue1, subject.queue2, subject.queue3
``
We can run all artisan with the artisan command: 
```php
php artisan queue:beanstalk --queue=subject.*
```
