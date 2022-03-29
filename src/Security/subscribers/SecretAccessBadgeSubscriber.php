<?php

namespace App\Security\subscribers;

class SecretAccessBadgeSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function onCheckPassportEvent(CheckPassportEvent $event)
    {
        // On recupere le passeport
        /** @var Passport $passport */
        $passport = $event->getPassport();

        // Comme on est abonné à tous les événements on controle que le passeport contient ces badges
        if ($passport->hasBadge(SecretAccessBadge::class) === false) {
            return;
        }
        // Voir plus haut
        if ($passport->hasBadge(UserBadge::class) === false) {
            return;
        }

        /** @var UserBadge $badgeUser */
        $badgeUser = $passport->getBadge(UserBadge::class);
        $secretAccessBadge = $passport->getBadge(SecretAccessBadge::class);

        // Ici on a les instances donc on va checker
        /** @var SecretAccessBadge $badgeToken */
        $secretAccessBadge->check($badgeUser->getUser());

    }

    public static function getSubscribedEvents()
    {
        return [
            CheckPassportEvent::class => 'onCheckPassportEvent',
        ];
    }
}