<?php

namespace DigitalRisks\Notifications\Messages;

class HubspotMessage
{
    /**
     * The template id from hubspot.
     *
     * @var string
     */
    public $templateId;

    /**
     * The contact properties from hubspot.
     *
     * @var array
     */
    public $contactProperties = [];

    /**
     * The custom properties for hubspot.
     *
     * @var array
     */
    public $customProperties = [];

    /**
     * The message properties for Hubspot.
     *
     * @var array
     */
    public $messageProperties = [];

    /**
     * Set the template id of the hubspot message.
     *
     * @param  string  $templateId
     * @return $this
     */
    public function templateId($templateId)
    {
        $this->templateId = $templateId;

        return $this;
    }

    /**
     * Set the contact properties of the hubspot message.
     *
     * @param array $contactProperties
     * @return $this
     */
    public function contactProperties($contactProperties)
    {
        $this->contactProperties = $contactProperties;

        return $this;
    }

    /**
     * Set the custom properties of the hubspot message.
     *
     * @param array $customProperties
     * @return $this
     */
    public function customProperties($customProperties)
    {
        $this->customProperties = $customProperties;

        return $this;
    }

    /**
     * Set the message properties of the hubspot message.
     *
     * @param array $messageProperties
     * @return $this
     */
    public function messageProperties($messageProperties)
    {
        $this->messageProperties = $messageProperties;

        return $this;
    }
}
