## Pull requests

----
Manage the comments on pull requests. Other users can reply to them. This allows for the construction of a thread of comments. 

### Prepare:
```php
$pull = new Bitbucket\API\Repositories\PullRequests();
$pull->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get all pull requests:
```php
$pull->all($account_name, $repo_slug);
```

### Get all merged pull requests:
```php
$pull->all($account_name, $repo_slug, array('state' => 'merged'));
```

### Create a new pull request:
```php
$pull->create('gentle', 'secret-repo', array(
    'title'         => 'Test PR',
    'description'   => 'Fixed readme',
    'source'        => array(
        'branch'    => array(
            'name'  => 'quickfix-1'
        ),
        'repository' => array(
            'full_name' => 'vimishor/secret-repo'
        )
    ),
    'destination'   => array(
        'branch'    => array(
            'name'  => 'master'
        )
    )
));
```

### Update a pull request:
```php
$pull->update('gentle', 'secret-repo', 1, array(
    'title'         => 'Test PR (updated)',
    'destination'   => array(
        'branch'    => array(
            'name'  => 'master'
        )
    ),
));
```

### Get a specific pull request:
```php
$pull->get($account_name, $repo_slug, 1);
```

### Get the commits for a pull request:
```php
$pull->commits($account_name, $repo_slug, 1);
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [PullRequests comments](pullrequests/comments.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/pullrequests+Resource#pullrequestsResource-Overview)
