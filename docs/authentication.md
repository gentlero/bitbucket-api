## Authentication

----
Although you can access any public data without authentication, you need to authenticate before you can access certain features like (_but not limited to_) accessing data from a private repository, or give access to a repository.
Bitbucket provides Basic and OAuth authentication.

### Basic authentication
To use basic authentication, you need to attach `BasicAuthListener` to http client with your username and password.

```php
$user = new Bitbucket\API\User();
$user->getClient()->addListener(
    new Bitbucket\API\Http\Listener\BasicAuthListener($bb_user, $bb_pass)
);

// now you can access protected endpoints as $bb_user
$response = $user->get();
```

----

### OAuth authorization
This library comes with a `OAuthListener` which will sign all requests for you. All you need to do is to attach the listener to http client with oauth credentials before making a request.

```php
// OAuth 1-legged example
// You can create a new consumer at: https://bitbucket.org/account/user/<username or team>/api
$oauth_params = array(
    'oauth_consumer_key'      => 'aaa',
    'oauth_consumer_secret'   => 'bbb'
);

$user = new Bitbucket\API\User;
$user->getClient()->addListener(
    new Bitbucket\API\Http\Listener\OAuthListener($oauth_params)
);

// now you can access protected endpoints as consumer owner
$response = $user->get();
```

----

#### Related:
  * [Authentication @ BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/Use+the+Bitbucket+REST+APIs#UsetheBitbucketRESTAPIs-Authentication)
  * [OAuth on Bitbucket @ BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/OAuth+on+Bitbucket)
