<?php
include 'Ex08.php';
use aptech\{Boston, NewYork};
use function aptech\{fool, foo2};
$d = new Boston();
$d->say();
$n = new NewYork();
$n ->say();
foo1();
foo2();
?>
