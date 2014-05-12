## Pull requests

----
Manage the comments on pull requests. Other users can reply to them. This allows for the construction of a thread of comments. 

### Prepare:
```php
$pull = new Bitbucket\API\Repositories\PullRequests();
$pull->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get all pull requests: (API 2.0)
```php
$pull->all($account_name, $repo_slug);
```

### Get all merged pull requests: (API 2.0)
```php
$pull->all($account_name, $repo_slug, array('state' => 'merged'));
```

### Get all merged and declined pull requests: (API 2.0)
```php
$pull->all($account_name, $repo_slug, array('state' => array('merged', 'declined')));
```

### Create a new pull request: (API 2.0)
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

### Update a pull request: (API 2.0)
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

### Get a specific pull request: (API 2.0)
```php
$pull->get($account_name, $repo_slug, 1);
```

### Get the commits for a pull request: (API 2.0)
```php
$pull->commits($account_name, $repo_slug, 1);
```

### Approve a pull request: (API 2.0)
```php
$pull->approve($account_name, $repo_slug, 1);
```

### Delete a a pull request approval: (API 2.0)
```php
$pull->delete($account_name, $repo_slug, 1);
```

### Get the diff for a pull request: (API 2.0)
```php
$pull->diff($account_name, $repo_slug, 1);
```

### Get the log of a pull request activity: (API 2.0)
If pull request ID is omitted, the entire repository's pull request activity is returned.

```php
$pull->activity($account_name, $repo_slug, 1);
```

### Accept and merge a pull request: (API 2.0)
```php
$pull->accept($account_name, $repo_slug, 1, array(
    'message' => 'This message will be used for merge commit.'
));
```

### Decline a pull request: (API 2.0)
```php
$pull->accept($account_name, $repo_slug, 1, array(
    'message' => 'Please update the docs to reflect new changes.'
));
```

----

#### Related:
  * [Authentication](../authentication.md)
  * [PullRequests comments](pullrequests/comments.md)
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/pullrequests+Resource#pullrequestsResource-Overview)
