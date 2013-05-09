## User repositories

----
Get the details of the repositories associated with an individual or team account.

### Get a list of repositories visible to an account:
```php
$user->repositories()->get();
```

### Get a list of repositories the account is following:
```php
$user->repositories()->overview();
```

### Get the list of repositories on the dashboard:
```php
$user->repositories()->dashboard();
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [User](../user.md)  
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/user+Endpoint#userEndpoint-GETalistofrepositoriesanaccountfollows)
