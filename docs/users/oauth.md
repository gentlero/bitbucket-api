## Users oauth

----
Use the oauth resource to create and maintain your own OAuth consumers.

### Prepare:
```php
$users = new Bitbucket\API\Users();
$users->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get all OAuth consumers:
```php
$users->oauth()->all($account_name);
```

### Create new consumer
```php
$users->oauth()->create($account_name, 'test', 'just for testing', 'http://test.example.com/oauth/bitbucket');
```

### Update existing consumer
```php
$users->oauth()->create($account_name, 'test', 22, 'just for testing', 'http://test.example.com/oauth/bitbucket');
```

### Delete existing consumer
```php
$users->oauth()->delete($account_name, 22);
```

----

#### Related:
  * [Authentication](authentication.md)
  * [Users](../users.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/oauth+Resource#oauthResource-Overview)
