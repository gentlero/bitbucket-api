## Links

----
Links connect your commit messages and code comments directly to your JIRA issue tracker or Bamboo build server.

### Prepare:
```php
$links = new Bitbucket\API\Repositories\Links();
$links->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get list of links:
```php
$links->all($account_name, $repo_slug);
```

### Get a single link:
```php
$links->get($account_name, $repo_slug, 3);
```

### Create a new link:
```php
$links->create($account_name, $repo_slug, 'custom', 'https://example.com', 'link-key');
```

### Update a link:
```php
$links->update($account_name, $repo_slug, 3, 'https://example.com', 'link-key');
```

### Delete a link:
```php
$links->delete($account_name, $repo_slug, 3);
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [Repositories](../repositories.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/links+Resources#linksResources-Overview)
