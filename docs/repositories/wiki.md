## Wiki

----
Provides functionality for getting information from pages in a Bitbucket wiki, creating new pages, and updating them.

### Prepare:
```php
$wiki = new Bitbucket\API\Repositories\Wiki();
$wiki->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get the raw content of a Wiki page:
```php
$wiki->get($accountname, $repo_slug, 'Home');
```

### Create a new page:
```php
$wiki->create($accountname, $repo_slug, 'Glossary', 'Page content !', '/Glossary');
```

### Update a page:
```php
$wiki->update($accountname, $repo_slug, 'Glossary', 'Dummy page content !');
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/wiki+Resources)
