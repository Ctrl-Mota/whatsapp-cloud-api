<?php

namespace Netflie\WhatsAppCloudApi\Request;

use Netflie\WhatsAppCloudApi\Request;

/**
 * Classe que representa uma requisição para enviar indicador de digitação no WhatsApp.
 * 
 * Esta classe estende a classe Request e é usada para enviar um indicador de que
 * o bot está "digitando" para o usuário, melhorando a experiência do usuário.
 * 
 * @package Netflie\WhatsAppCloudApi\Request
 */
final class TypingIndicatorRequest extends MessageReadRequest
{
   public string $type = 'text';
 
     /**
     * Returns the raw body of the request.
     *
     * @return array
     */
    public function body(): array
    {
        return [
            'messaging_product' => 'whatsapp',
            'status' => 'read',
            'message_id' => $this->message_id,
            'typing_indicator' => [
                'type' => $this->type
            ]
        ];
    }
   

} 