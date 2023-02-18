<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\FlexApi\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

class InsightsSessionContext extends InstanceContext {
    /**
     * Initialize the InsightsSessionContext
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(Version $version) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [];

        $this->uri = '/Insights/Session';
    }

    /**
     * Create the InsightsSessionInstance
     *
     * @param array|Options $options Optional Arguments
     * @return InsightsSessionInstance Created InsightsSessionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []): InsightsSessionInstance {
        $options = new Values($options);

        $headers = Values::of(['Token' => $options['token'], ]);

        $payload = $this->version->create('POST', $this->uri, [], [], $headers);

        return new InsightsSessionInstance($this->version, $payload);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.FlexApi.V1.InsightsSessionContext ' . \implode(' ', $context) . ']';
    }
}