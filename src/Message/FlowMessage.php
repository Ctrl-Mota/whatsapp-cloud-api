<?php

namespace Netflie\WhatsAppCloudApi\Message;

use Netflie\WhatsAppCloudApi\Message\CtaUrl\Header;
use Netflie\WhatsAppCloudApi\Message\Flow\Action;

/**
 * Represents a flow message in the WhatsApp Cloud API.
 *
 * This class extends the base Message class and implements the FlowMessage interface.
 * It provides functionality to send flow messages to WhatsApp users.

 * @package Netflie\WhatsAppCloudApi\Message
 * 
 * 
 * 
 * 
 * Cloud API Sample Request (with all parameters)
 * 
 * curl -X  POST \
 *  'https://graph.facebook.com/v18.0/FROM_PHONE_NUMBER/messages' \
 *  -H 'Authorization: Bearer ACCESS_TOKEN' \
 *  -H 'Content-Type: application/json' \
 *  -d '{
 *   "recipient_type": "individual",
 *   "messaging_product": "whatsapp",
 *   "to": "whatsapp-id",
 *   "type": "interactive",
 *   "interactive": {
 *     "type": "flow",
 *     "header": {
 *       "type": "text",
 *       "text": "Flow message header"
 *     },
 *     "body": {
 *       "text": "Flow message body"
 *     },
 *     "footer": {
 *       "text": "Flow message footer"
 *     },
 *     "action": {
 *       "name": "flow",
 *       "parameters": {
 *         "flow_message_version": "3",
 *         "flow_token": "AQAAAAACS5FpgQ_cAAAAAD0QI3s.",
 * 
 *         "flow_name": "appointment_booking_v1",
 *         //or
 *         "flow_id": "123456",
 * 
 *         "flow_cta": "Book!",
 *         "flow_action": "navigate",
 *         "flow_action_payload": {
 *           "screen": "<SCREEN_NAME>",
 *           "data": { 
 *             "product_name": "name",
 *             "product_description": "description",
 *             "product_price": 100
 *           }
 *         }
 *       }
 *     }
 *   }
 * }'
 * */
final class FlowMessage extends Message
{
    /**
    * {@inheritdoc}
    */
    protected string $type = 'flow';

    /**
     * @var Action A ação do flow
     */
    private Action $action;

    /**
     * @var Header|null O cabeçalho da mensagem
     */
    private ?Header $header = null;

    /**
     * @var string|null O corpo da mensagem
     */
    private ?string $body = null;

    /**
     * @var string|null O rodapé da mensagem
     */
    private ?string $footer = null;

    /**
    * Construtor para a classe FlowMessage
    *
    * @param string $to O número para enviar a mensagem
    * @param Action $action A ação do flow
    * @param Header|null $header O cabeçalho opcional da mensagem
    * @param string|null $body O corpo opcional da mensagem
    * @param string|null $footer O rodapé opcional da mensagem
    * @param string|null $reply_to O ID da mensagem para responder
    */
    public function __construct(
        string $to,
        Action $action,
        ?Header $header = null,
        ?string $body = null,
        ?string $footer = null,
        ?string $reply_to = null
    ) {
        $this->action = $action;
        $this->header = $header;
        $this->body = $body;
        $this->footer = $footer;

        parent::__construct($to, $reply_to);
    }

    /**
     * Retorna o cabeçalho da mensagem
     *
     * @return array|null
     */
    public function header(): ?array
    {
        return is_null($this->header) ? null : $this->header->getBody();
    }

    /**
     * Retorna o corpo da mensagem
     *
     * @return string|null
     */
    public function body(): ?string
    {
        return $this->body;
    }

    /**
     * Retorna o rodapé da mensagem
     *
     * @return string|null
     */
    public function footer(): ?string
    {
        return $this->footer;
    }

    /**
     * Retorna o tipo da mensagem
     *
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Retorna os detalhes da ação do flow
     *
     * @return array
     */
    public function action(): array
    {
        return $this->action->toArray();
    }
}
