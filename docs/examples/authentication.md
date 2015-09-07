---
layout: default
permalink: /examples/authentication.html
title: Authentication
---

# Authentication

Although you can access any public data without authentication, you need to authenticate before you can access certain features like
(_but not limited to_) accessing data from a private repository, or give access to a repository.
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

### OAuth1 authorization
This library comes with a `OAuthListener` which will sign all requests for you. All you need to do is to attach the listener to
http client with oauth credentials before making a request.

#### OAuth1 1-legged
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

#### OAuth1 3-legged

You can use any 3rd party library to complete this [flow][3] and set OAuth credentials when you instantiate `OAuthListener`.

In the following example [PHP League's OAuth 1.0 Client][4] is used.

  ```php
  session_start();

  // @see: https://bitbucket.org/account/user/<username>/api
  $oauth_params = array(
      'identifier'    => 'aaa',
      'secret'        => 'bbb',
      'callback_uri'  => 'http://example.com/oauth1_3legged.php'
  );

  $server = new League\OAuth1\Client\Server\Bitbucket($oauth_params);

  if (array_key_exists('profile', $_GET)) {
      if (false === array_key_exists('bb_credentials', $_SESSION)) {
          header('Location: ' . $oauth_params['callback_uri']);
          exit;
      }

      $oauth_params = array_merge(unserialize($_SESSION['bb_credentials']), array(
          'oauth_consumer_key'        => $oauth_params['identifier'],
          'oauth_consumer_secret'     => $oauth_params['secret'],
          'oauth_callback'            => $oauth_params['callback_uri'],
      ));


      $bitbucket = new \Bitbucket\API\Api();
      $bitbucket->getClient()->addListener(
          new \Bitbucket\API\Http\Listener\OAuthListener($oauth_params)
      );

      /** @var \Bitbucket\API\User $user */
      $user = $bitbucket->api('User');

      $profile = json_decode($user->get()->getContent(), true);
      echo sprintf('<a href="?logout">Logout %s</a>', $profile['user']['username']);

      // show all user repositories
      echo '<h3>My repositories:</h3><ul>';
      array_walk($profile['repositories'], function($repository) {
          $repositoryUrl = str_replace('/1.0/repositories/', '', $repository['resource_uri']);
          echo sprintf(
              '<li><a href="http://bitbucket.org/%s">%s</a></li>', $repositoryUrl, $repository['name']
          );
      });
      echo '</ul>';
      exit;
  } elseif (array_key_exists('login', $_GET)) {
      // Retrieve temporary credentials
      $temporaryCredentials = $server->getTemporaryCredentials();

      // Store credentials in the session, we'll need them later
      $_SESSION['temporary_credentials'] = serialize($temporaryCredentials);
      session_write_close();

      // Second part of OAuth 1.0 authentication is to redirect the
      // resource owner to the login screen on the server.
      $server->authorize($temporaryCredentials);
      exit;
  } elseif (array_key_exists('oauth_token', $_GET) && array_key_exists('oauth_verifier', $_GET)) {
      // Retrieve the temporary credentials we saved before
      $temporaryCredentials = unserialize($_SESSION['temporary_credentials']);

      // We will now retrieve token credentials from the server
      $tokenCredentials = $server->getTokenCredentials(
          $temporaryCredentials, $_GET['oauth_token'], $_GET['oauth_verifier']
      );

      $oauth_params = array(
          'oauth_token'               => $tokenCredentials->getIdentifier(),
          'oauth_token_secret'        => $tokenCredentials->getSecret()
      );

      unset($_SESSION['temporary_credentials'], $_SESSION['token_credentials']);
      $_SESSION['bb_credentials'] = serialize($oauth_params);
      session_write_close();

      // redirect the user to the profile page, in order to fetch his/her information.
      header('Location: '.$oauth_params['callback_uri'].'?profile');
      exit;
  } elseif (array_key_exists('logout', $_GET)) {
      unset($_SESSION['bb_credentials']);
      session_write_close();
  }

  echo '<a href="?login">Login with BitBucket!</a>';
  ```

### OAuth2 authorization

You can use `OAuth2Listener` in order to make authorized requests using version 2 of OAuth protocol.

#### OAuth2 client credentials (_2-legged flow_)

  ```php
  // @see: https://bitbucket.org/account/user/<username or team>/api
  $oauth_params = array(
      'client_id'         => 'aaa',
      'client_secret'     => 'bbb'
  );

  $bitbucket = new \Bitbucket\API\Api();
  $bitbucket->getClient()->addListener(
      new \Bitbucket\API\Http\Listener\OAuth2Listener($oauth_params)
  );

  $repositories = $bitbucket->api('Repositories');
  $response     = $repositories->all('my_account'); // should include private repositories
  ```

#### OAuth2 Authorization code (_3-legged flow_)

You can use any 3rd party library to complete this [flow][3] and set `access_token` option when you instantiate `OAuth2Listener`.

In the following example [PHP League's OAuth 2.0 Client][1] is used with [Bitbucket Provider][2].

  ```php
  session_start();

  $provider = new Stevenmaguire\OAuth2\Client\Provider\Bitbucket([
      'clientId'          => $_ENV['bitbucket_consumer_key'],
      'clientSecret'      => $_ENV['bitbucket_consumer_secret'],
      'redirectUri'       => 'http://example.com/bitbucket_login.php'
  ]);
  if (!isset($_GET['code'])) {

      // If we don't have an authorization code then get one
      $authUrl = $provider->getAuthorizationUrl();
      $_SESSION['oauth2state'] = $provider->getState();
      header('Location: '.$authUrl);
      exit;

  // Check given state against previously stored one to mitigate CSRF attack
  } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

      unset($_SESSION['oauth2state']);
      exit('Invalid state');

  } else {

      // Try to get an access token (using the authorization code grant)
      $token = $provider->getAccessToken('authorization_code', [
          'code' => $_GET['code']
      ]);

      $bitbucket = new Bitbucket\API\Repositories();
      $bitbucket->getClient()->addListener(
          new \Bitbucket\API\Http\Listener\OAuth2Listener(
              array('access_token'  => $token->getToken())
          )
      );

      echo $bitbucket->all('my_account')->getContent(); // should include private repositories
  }
  ```

----

#### Related:
  * [Authentication @ BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/Use+the+Bitbucket+REST+APIs#UsetheBitbucketRESTAPIs-Authentication)
  * [OAuth on Bitbucket @ BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/OAuth+on+Bitbucket)

[1]: http://oauth2-client.thephpleague.com/
[2]: https://github.com/stevenmaguire/oauth2-bitbucket
[3]: http://oauthbible.com/#oauth-2-three-legged
[4]: https://github.com/thephpleague/oauth1-client
