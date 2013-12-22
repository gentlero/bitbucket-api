## Authentication

----
Although you can access any public data without authentication, you need to authenticate before you can access certain features like (_but not limited to_) accessing data from a private repository, or give access to a repository.
Bitbucket provides Basic and OAuth authentication.

### Basic authentication
To use basic authentication, you need to instantiate `Basic` class from `Bitbucket\API\Authentication` namespace and pass it to `setCredentials()` method, before making first request.
 
```php
$auth = new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass);

$user = new Bitbucket\API\User();
$user->setCredentials($auth);

// some code

$invitation = new Bitbucket\API\Invitations();
$invitation->setCredentials($auth);
```

If you need to change credentials, two methods are available for this:
```php
$auth->setUsername('username');
$auth->setPassword('password');
```

----

### OAuth authorization
To use OAuth, you will need to instantiate `OAuth` class from `Bitbucket\API\Authentication` namespace and pass it to `setCredentials()` method, before making first request.
`OAuth` accepts a string or array as constructor. Those parameters are actually OAuth parameters, that have been previously signed.

**NOTE:** `OAuth` class will _NOT_ sign the request. It will just build the authorization header from previously signed OAuth parameters.

```php
// use 3rd party OAuth library to sign the request and pass already signed parameters to `OAuth` class.

$auth = new Bitbucket\API\Authentication\OAuth(array(
    'oauth_version'             => '1.0',
    'oauth_nonce'               => 'aaaaaaaaaaaaaaa',
    'oauth_timestamp'           => '1370771799',
    'oauth_consumer_key'        => 'xxxxxxxxxxxxxxx',
    'oauth_signature_method'    => 'HMAC-SHA1',
    'oauth_signature'           => 'yyyyyyyyyyyyyyy'
));

$user = new Bitbucket\API\User();
$user->setCredentials($auth);
```

You can also send the parameters as string, instead of array:
```php
// use 3rd party OAuth library to sign the request and pass already signed parameters to `OAuth` class.

$auth = new Bitbucket\API\Authentication\OAuth('oauth_version="1.0",oauth_nonce="aaaaaaaaaaaaaaa",oauth_timestamp="1370771799",oauth_consumer_key="xxxxxxxxxxxxxxx",oauth_signature_method="HMAC-SHA1",oauth_signature="yyyyyyyyyyyyyyy"');

// rest of the code
```

**NOTES:**

* `OAuth` class will prepend `Authorization: OAuth` to those parameters and will add the result to current request header.
* When choosing an OAuth library, take into consideration the fact that [Bitbucket](https://bitbucket.org) uses OAuth 1.0a ( _3-Legged and 2-Legged_ )

----

#### Related:
  * [Authentication @ BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/Use+the+Bitbucket+REST+APIs#UsetheBitbucketRESTAPIs-Authentication)
  * [OAuth on Bitbucket @ BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/OAuth+on+Bitbucket)
