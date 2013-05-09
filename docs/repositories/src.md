## Services

----
Allows you to browse directories and view files. 
*NOTE:* This is a read-only resource.

### Prepare:
```php
$src = new Bitbucket\API\Repositories\Src();

# Authentication is required if the repository is private.
$src->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of the src in a repository.:
```php
$src->get($account_name, $repo_slug, '1e10ffe', 'app/models/');
```

### Get raw content of an individual file:
```php
$src->raw($account_name, $repo_slug, '1e10ffe', 'app/models/core.php');
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/src+Resources)
