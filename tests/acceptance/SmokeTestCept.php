<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('See site main page is work?');
$I->amOnPage('/');
$I->see('Our CRM');