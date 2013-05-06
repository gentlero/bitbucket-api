<?php

require_once __DIR__.'/../../vendor/autoload.php';

$links = new Bitbucket\API\Repositories\Links;

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
$links->setCredentials( new Bitbucket\API\Authentication\Basic($bb_user, $bb_pass) );

# get list of links
print_r($links->all($accountname, $repo_slug));

# get a link
#print_r($links->get($accountname, $repo_slug, 3));

# create a new link
#print_r($links->create($accountname, $repo_slug, 'custom', 'https://example.com', 'link-key'));

# update a link
#print_r($links->update($accountname, $repo_slug, 3, 'https://example.com', 'link-key'));

# delete a link
#print_r($links->delete($accountname, $repo_slug, 3));