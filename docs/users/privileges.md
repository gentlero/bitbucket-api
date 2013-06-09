## Users privileges

----
Use this resource to manage privilege settings for a team account. Team accounts can grant groups account privileges
as well as repository access.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of privilege groups on a team account:
```php
$users->privileges()->team($account_name);
```

### Gets the privilege associated with the specified group:
```php
$users->privileges()->group($account_name, 'john', 'testers');
```

### Updates an existing group's privileges for a team account:
```php
$users->privileges()->update($account_name, 'john', 'testers', 'collaborator');
```

### Add a privilege to a group:
```php
$users->privileges()->create($account_name, 'john', 'testers', 'admin');
```

### Deletes a privilege.
```php
$users->privileges()->delete($account_name, 'john', 'testers');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/privileges+Resource)
