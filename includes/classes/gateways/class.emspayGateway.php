<?php
require_once 'class.baseGingerGateway.php';
// Override me
class emspayGateway extends baseGingerGateway
{
    /**
     * @return string
     * Specially for emspay_webhook.php
     */
    public function getWebhookStatusUpdateDescription()
    {
        return "Status Changed by EMS Online webhook call";
    }
    // Overridden methods can be posted here

}