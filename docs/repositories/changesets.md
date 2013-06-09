## Changesets

----
Manage changesets resources on a repository. Unauthenticated calls for these resources only return values for public repositories.

### Prepare:
```php
$changesets = new Bitbucket\API\Repositories\Changesets();
$changesets->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of changesets associated with a repository:
```php
$changesets->all($account_name, $repo_slug, 'aea95f1', 20);
```

### Get an individual changeset:
```php
$changesets->get($account_name, $repo_slug, 'aea95f1');
```

### Get statistics associated with an individual changeset:
```php
$changesets->diffstat($account_name, $repo_slug, '4ba1a4a');
```

### Get the diff associated with a changeset:
```php
$changesets->diff($account_name, $repo_slug, '4ba1a4a');
```

### Get the likes on an individual changeset
NOTE: Because of a ( [bug](https://bitbucket.org/gentlero/bitbucket-api/issue/1/changesets-likes-endpoint-returns-404) ) in the API, implementation for this method is missing for the moment.


----

#### Related:
  * [Authentication](../authentication.md)
  * [Changeset comments](changesets/comments.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/changesets+Resource#changesetsResource-Overview)
