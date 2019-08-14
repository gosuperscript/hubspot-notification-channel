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
}
