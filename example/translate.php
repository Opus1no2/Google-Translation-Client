<?php
/**
 *
 * Translation example
 */
require_once '../src/Client.php';

try {
    $client = new Goolge_Translate('YOUR API KEY');
    $client->setSource('en')
        ->setTarget('gl')
        ->setText('If wishes were fishes, we\'d all cast nets')
        ->translate();
} catch (Exception $e) {
    echo $e->getMessage();
}
