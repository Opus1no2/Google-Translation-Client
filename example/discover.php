<?php
/**
 *
 * Discover example
 */
require_once '../src/Client.php';

try {
    $client = new Goolge_Translate('YOUR API KEY');
    $client->setText('This is a test')
        ->detect();
} catch (Exception $e) {
    echo $e->getMessage();
}