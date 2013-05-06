<?php

require_once __DIR__.'/../../vendor/autoload.php';

$changesets = new Bitbucket\API\Repositories\Changesets;

// Your Bitbucket credentials
$bb_user = 'username';
$bb_pass = 'password';

/**
 * $accountname The team or individual account owning the repository.
 * repo_slub    The repository identifier.
 */
$accountname    = 'company';
$repo_slug      = 'sandbox';


// login
$changesets->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );

// gets a list of change sets associated with a repository.
#print_r($changesets->all($accountname, $repo_slug, 'aea95f1', 20));

# Get an individual changeset
#print_r($changesets->get($accountname, $repo_slug, 'aea95f1'));

# Get statistics associated with an individual changeset
#print_r($changesets->diffstat($accountname, $repo_slug, '4ba1a4a'));

# Get a list of comments on a changeset
#print_r($changesets->comments()->all($accountname, $repo_slug, 'a9f15cfdfb68436f324dd980eefdbb9d0dc3887c'));

# Delete a comment on a changeset
#print_r($changesets->comments()->delete($accountname, $repo_slug, 'a9f15cfdfb68436f324dd980eefdbb9d0dc3887c', 195700));

# post a new comment on a changeset
#print_r($changesets->comments()->create($accountname, $repo_slug, 'a9f15cfdfb68436f324dd980eefdbb9d0dc3887c', 'dummy comment 2'));

# update a comment
#print_r($changesets->comments()->update($accountname, $repo_slug, 'a9f15cfdfb68436f324dd980eefdbb9d0dc3887c', 195753, 'edited comment'));