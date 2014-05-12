## Repository

----
Allows you to create a new repository or edit a specific one.

### Prepare:
```php
$repo = new Bitbucket\API\Repositories\Repository();
$repo->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get information associated with an individual repository: (API 2.0)
```php
$repo->get($account_name, $repo_slug);
```

### Create a new repository: (API 1.0)
**NOTE:** API 1.0 endpoint for repository creation has been deprecated, so please use the new API 2.0 endpoint described bellow.

```php
$repo->create($repo_slug, array(
    'description'   => 'My super secret project.',
    'language'      => 'php',
    'is_private'    => true
));
```

### Create a new repository: (API 2.0)
```php
$repo->create($account_name, $repo_slug, array(
    'scm'               => 'git',
    'description'       => 'My super secret project.',
    'language'          => 'php',
    'is_private'        => true,
    'forking_policy'    => 'no_public_forks',
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

### Delete a repository: (API 2.0)
```php
$repo->delete($account_name, $repo_slug);
```

### Get the list of accounts watching a repository: (API 2.0)
```php
$repo->watchers($account_name, $repo_slug);
```

### Get the list of repository forks: (API 2.0)
```php
$repo->forks($account_name, $repo_slug);
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
