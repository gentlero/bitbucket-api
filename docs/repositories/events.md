## Events

----
Track events that occur on public repositories.
*NOTE:* Traking events from private repositories are not supported for the moment by the API.

### Prepare:
```php
$events = new Bitbucket\API\Repositories\Events();
```

### Get all events with `report_issue` type:
```php
$events->all($account_name, $repo_slug, array(
    'type'  => 'report_issue'
));
```

----

#### Related:
  * [BB Wiki](https://confluence.atlassian.com/display/BITBUCKET/events+Resources#eventsResources-GETalistofevents)
