## Groups

----
Provides functionality for querying information about groups, creating new ones, updating memberships, and deleting them.

### Prepare:
```php
$groups = new Bitbucket\API\Groups();
$groups->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of groups:
```php
$groups->get($account_name);
```

### Get a list of matching groups:
```php
$groups->get($account_name, array(
    'group' => 'repo_name/administrators'
));
```

### Create a new group:
```php
$groups->create($account_name, 'testers');
```

### Update a group:
```php
$groups->update($account_name, 'testers', array(
    'accountname'   => 'gentlero',
    'name'          => 'Dummy group'
));
```

### Delete a group:
```php
$groups->delete($account_name, 'testers');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Group members](groups/members.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/groups+Endpoint)
