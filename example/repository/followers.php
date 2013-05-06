<?php

require_once __DIR__.'/../../vendor/autoload.php';

$followers = new Bitbucket\API\Repositories\Followers;

// Your Bitbucket credentials
$bb_user = 'username';
$bb_pass = 'password';

/**
 * $accountname The team or individual account owning the repository.
 * repo_slub    The repository identifier.
 */
$accountname    = 'company';
$repo_slug      = 'sandbox';


// login (optional)
$followers->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );

# get all events with `report_issue` type
print_r($followers->all($accountname, $repo_slug));