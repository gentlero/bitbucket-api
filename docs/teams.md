## Teams

----
Get Team related information.

### Prepare:
```php
$team = new Bitbucket\API\Teams();
$team->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );
```

### Get the team profile: (API 2.0)
```php
$team->profile($team_name);
```

### Get the team members: (API 2.0)
```php
$team->members($team_name);
```

### Get the team followers: (API 2.0)
```php
$team->followers($team_name);
```

### Get a list of accounts the team is following: (API 2.0)
```php
$team->following($team_name);
```

### Get the team's repositories: (API 2.0)
```php
$team->repositories($team_name);
```


----

#### Related:
  * [Authentication](authentication.md)
  * [BB Wiki](https://confluence.atlassian.com/x/XwZAGQ)
