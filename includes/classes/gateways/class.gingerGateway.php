<?php
require_once 'class.baseGingerGateway.php';
// Override me
class gingerGateway extends baseGingerGateway
{
    /**
     * @return string
     * Specially for ginger_webhook.php
     */
    public static function getWebhookStatusUpdateDescription(): string
    {
        return "Status Changed by EMS Online webhook call";
    }
    // Overridden methods can be posted here

}