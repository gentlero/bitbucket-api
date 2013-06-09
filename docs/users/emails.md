## Users emails

----
An account can have one or more email addresses associated with it. Use this end point to list, change, or create an email address.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get a list of user's email addresses:
```php
$users->emails()->all($account_name);
```

### Gets an individual email address associated with an account:
```php
$users->emails()->get($account_name, 'dummy@example.com');
```

### Add a new email address to an account:
When you add an address, Bitbucket sends an activation email to the new address. After the user clicks the activation link
in the email, the address active is set to true and the address is available for use. If you call this method again, Bitbucket
will send a new confirmation email.

```php
$users->emails()->create($account_name, 'dummy@example.com');
```

### Set an email address as primary:
```php
$users->emails()->update($account_name, 'dummy@example.com', true);
```

### Delete an email address:
```php
$users->emails()->delete($account_name, 'dummy@example.com');
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/emails+Resource)
