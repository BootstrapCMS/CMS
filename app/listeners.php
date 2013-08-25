<?php

/*
|--------------------------------------------------------------------------
| Application Event Listeners
|--------------------------------------------------------------------------
|
| Here is where you can register all of the listeners for an application.
| In this case I have loaded my subscribers here.
|
*/

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber;
Event::subscribe($subscriber);


$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\CommentSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\EventSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\GroupSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\PageSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\PostSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber;
Event::subscribe($subscriber);
