## Privileges

----
Manage the user privileges (permissions) of your repositories. It allows you to grant specific users access to read,
write and or administer your repositories.

### Prepare
```php
$privileges = new Bitbucket\API\Privileges();
$privileges->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of user privileges granted on a repository with `read` access.
```php
$privileges->repository($owner_name, $repo_slug, 'read');
```

### Get privileges for an individual.
```php
$privileges->account($owner_name, $repo_slug, $account_name);
```

### Get a list of all privileges across all an account's repositories with `write` access.
```php
$privileges->repositories($owner_name, 'write');
```

### Grants an account admin privilege on a repository.
```php
$privileges->grant($owner_name, $repo_slug, $account_name, 'admin');
```

### Delete account privileges from a repository.
```php
$privileges->detele($owner_name, $repo_slug, $account_name);
```

### Delete all privileges from a repository
```php
$privileges->detele($owner_name, $repo_slug);
```

### Delete all privileges from all repositories
```php
$privileges->detele($owner_name);
```

----

#### Related:
  * [Authentication](authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/privileges+Endpoint#privilegesEndpoint-Overview)
