## Group members

----
Manage group members.

### Prepare:
```php
$group = new Bitbucket\API\Groups();
$group->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get the group members:
```php
$group->members()->all($account_name, $repo_slug);
```

### Add new member into a group:
```php
$group->members()->add($account_name, 'developers', 'steve');
```

### Delete a member from group:
```php
$group->members()->delete($account_name, 'developers', 'miriam');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Groups](../groups.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/groups+Endpoint)
