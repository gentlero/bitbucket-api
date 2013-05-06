<?php

require_once __DIR__.'/../../vendor/autoload.php';

$issue = new Bitbucket\API\Repositories\Issues;

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
$issue->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );

# Fetch a list of issues
print_r($issue->all($accountname, $repo_slug));

# Fetch a list of issues with different format
#print_r($issue->setFormat('xml')->all($accountname, $repo_nam));

# Fetch a single issue
#print_r($issue->get($accountname, $repo_slug, 3));

// Fetch 5 issues that contains word `bug` in title
/*
print_r($issue->all($accountname, $repo_slug, array(
    'limit' => 5,
    'start' => 0,
    'search' => 'bug'
)));
*/

# add a new issue
/*print_r($issue->create($accountname, $repo_slug, array(
    'title'     => 'dummy title',
    'content'   => 'dummy content',
    'kind'      => 'proposal',
    'priority'  => 'blocker'
)));*/

# update an existing issue
/*
print_r(
    $issue->update($accountname, $repo_slug, 5, array(
        'title' => 'dummy title (edited)'
    ))
);
*/

# delete issue
#print_r( $issue->delete($accountname, $repo_slug, 5) );

# fetch issue comments
#print_r($issue->comments()->all($accountname, $repo_slug, 4));

# fetch a single issue comment
#print_r($issue->comments()->get($accountname, $repo_slug, 4, 2967835));

# add a new comment to specified issue
/*
print_r(
    $issue->comments()->create($accountname, $repo_slug, 4, 'dummy comment.')
);*/

# update existing issue comment
/*print_r(
    $issue->comments()->update($accountname, $repo_slug, 4, 3454384, "dummy comment [edited]")
);*/


# fetch all components from specified tracker
#print_r($issue->components()->all($accountname, $repo_slug));

# fetch single component
#print_r($issue->components()->get($accountname, $repo_slug, 100332));

# add a new component
#print_r($issue->components()->create($accountname, $repo_slug, 'DummyComponent'));

# update an existing component
#print_r($issue->components()->update($accountname, $repo_slug, 100336, 'DummyComponent'));

# delete an existing component
#print_r($issue->components()->delete($accountname, $repo_slug, 100336));


# fetch all versions
#print_r($issue->versions()->all($accountname, $repo_slug));

# fetch a single version
#print_r($issue->versions()->get($accountname, $repo_slug, 53917));

# add a new version
#print_r($issue->versions()->create($accountname, $repo_slug, '3.0'));

# update an existing version
#print_r($issue->versions()->update($accountname, $repo_slug, 53920, '3.0.1'));

# delete an existing version
#print_r($issue->versions()->delete($accountname, $repo_slug, 53920));


# fetch all milestones
#print_r($issue->milestones()->all($accountname, $repo_slug));

# fetch a single milestone
#print_r($issue->milestones()->get($accountname, $repo_slug, 56735));

# add a new milestone
#print_r($issue->milestones()->create($accountname, $repo_slug, 'dummy'));

# update an existing milestone
#print_r($issue->milestones()->update($accountname, $repo_slug, 56736, 'not dummy'));

# delete an existing milestone
#print_r($issue->milestones()->delete($accountname, $repo_slug, 56736));