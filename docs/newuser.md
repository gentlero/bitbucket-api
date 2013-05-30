## NewUser

----
Create an individual account on the Bitbucket service.
**NOTE:** The service throttles this call at 2 request per 30 minutes.

### Prepare
```php
$newuser = new Bitbucket\API\NewUser();
```

### Create new account
```php
$newuser->create('john', 'john.doe@example.com', 'John Doe', 'secret-password');
```

----

#### Related:
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/newuser+Endpoint)
