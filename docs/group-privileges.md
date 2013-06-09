## Group Privileges

----
Manages a group's repository permissions.

### Prepare
```php
$privileges = new Bitbucket\API\User();
$privileges->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of privileged groups
```php
$groups = $privileges->groups($account_name);
```

### Get a list of privileged groups for a repository
```php
$groups = $privileges->repository($account_name, $repo_slug);
```

### Gets the privileges of a group on a repository.
```php
$group = $privileges->group($account_name, $repo_slug, $group_owner, $group_slug);
```

### Get a list of the repositories on which a particular privilege group appears.
```php
$repos = $privileges->repositories($account_name, $group_owner, $group_slug);
```

### Grant group privileges on a repository.
```php
$privileges->grant($account_name, $repo_slug, $group_owner, $group_slug, 'read');
```

### Delete group privileges from a repository
```php
$privileges->delete($account_name, $repo_slug, $group_owner, $group_slug);
```

----

#### Related:
  * [Authentication](authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/group-privileges+Endpoint#group-privilegesEndpoint-Overview)
