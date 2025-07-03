<?php

namespace R52dev\ISO20022\Message;

/**
 * General interface for ISO-20022 messages
 */
interface MessageInterface
{
    /**
     * Returns a XML representation of the message
     *
     * @return string The XML source
     */
    public function asXml();

    /**
     * Returns a XML representation of the message
     *
     * @return string The XML source
     */
    public function asDNBXml();
}
