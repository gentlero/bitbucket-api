<?php

require_once __DIR__.'/../vendor/autoload.php';

$invitation = new Bitbucket\API\Invitations;

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
$invitation->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );

// send invitation
print_r($invitation->send('account', 'repository', 'user@example.com', 'read'));