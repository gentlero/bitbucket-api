## Services

----
Provides functionality for adding, removing, and configuring brokers on your repositories.

### Prepare:
```php
$services = new Bitbucket\API\Repositories\Services();
$services->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of services on a repository:
```php
$services->all($account_name, $repo_slug);
```

### Get a single service attached to your repository:
```php
$services->get($account_name, $repo_slug, 2);
```

### Create a new service:
```php
$services->create($account_name, $repo_slug, 'POST', array(
    'URL' => 'http://example.com/bb-hook'
));
```

### Update a service:
```php
$services->update($account_name, $repo_slug, 1, array(
    'URL' => 'https://example.com/bb-hook'
));
```

### Delete a service:
```php
$services->delete($account_name, $repo_slug, 1);
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/services+Resource)
