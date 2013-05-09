## Repository

----
Allows you to create a new repository or edit a specific one.

### Prepare:
```php
$repo = new Bitbucket\API\Repositories\Repository();
$repo->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Create a new repository:
```php
$repo->create($repo_slug, array(
    'description'   => 'My super secret project.',
    'language'      => 'php',
    'is_private'    => true
));
```

### Update an existing repository:
```php
$repo->update($account_name, $repo_slug, array(
    'description'   => 'My super secret project !!!',
    'language'      => 'php',
    'is_private'    => true
));
```

### Delete a repository:
```php
$repo->delete($account_name, $repo_slug);
```

### Fork a repository:
```php
$repo->fork($account_name, $repo_slug, $fork_slug, array(
    'is_private' => true
));
```

### Get a list of branches associated with a repository:
```php
$repo->branches($account_name, $repo_slug);
```

### Get the repository's main branch:
```php
$repo->branch($account_name, $repo_slug);
```

### Get the repository manifest:
```php
$repo->manifest($account_name, $repo_slug, 'develop');
```

### Get a list of tags:
```php
$repo->tags($account_name, $repo_slug);
```

### Get the raw content of a file or directory:
```php
$repo->raw($account_name, $repo_slug, '1bc8345', 'app/models/core.php')
```

### Get the history of a file in a changeset
```php
$repo->filehistory($account_name, $repo_slug, '1bc8345', 'app/models/core.php')
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/repository+Resource#repositoryResource-Overview)
