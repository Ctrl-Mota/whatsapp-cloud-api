<?php

namespace Netflie\WhatsAppCloudApi\Message\Flow;

/**
 * Representa a seção 'action' de uma mensagem de flow no WhatsApp Cloud API.
 *
 * Esta classe encapsula os parâmetros da ação do flow, como version, token, nome, id,
 * texto de call-to-action, tipo de ação e payload da ação.
 *
 * @package Netflie\WhatsAppCloudApi\Message\Flow
 */
class Action
{
    /**
     * @var string Nome da ação, sempre será 'flow'
     */
    private string $name = 'flow';

    /**
     * @var string Versão da mensagem de flow, padrão é '3'
     */
    private string $flowMessageVersion;


    /**
     * @var string|null Nome do flow
     */
    private ?string $flowName;

    /**
     * @var string|null ID do flow
     */
    private ?string $flowId;

    /**
     * @var string Texto do botão de call-to-action
     */
    private string $flowCta;

    /**
     * @var string|null Tipo da ação (ex: 'navigate')
     */
    private ?string $flowAction;

    /**
     * @var array|null Payload da ação contendo dados
     */
    private ?array $flowActionPayload;

    /**
     * Constructor da classe Action
     *
     * @param string $flowToken Token do flow
     * @param string $flowMessageVersion Versão da mensagem de flow (padrão: '3')
     * @param string|null $flowName Nome do flow
     * @param string|null $flowId ID do flow (alternativa ao flowName)
     * @param string|null $flowCta Texto do botão de call-to-action
     * @param string|null $flowAction Tipo de ação
     * @param array|null $flowActionPayload Payload da ação
     */
    public function __construct(
        ?string $flowId = null,
        string $flowCta,
        ?string $flowName = null,

        ?string $flowAction = null,
        ?array $flowActionPayload = null,
        string $flowMessageVersion = '3',
    ) {
        $this->flowMessageVersion = $flowMessageVersion;
        $this->flowName = $flowName;
        $this->flowId = $flowId;
        $this->flowCta = $flowCta;
        $this->flowAction = $flowAction;
        $this->flowActionPayload = $flowActionPayload;
    }

    /**
     * Retorna o nome da ação
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gera o array de parâmetros para a requisição
     *
     * @return array
     */
    public function getParameters(): array
    {
        $parameters = [
            'flow_message_version' => $this->flowMessageVersion,
            'flow_cta' => $this->flowCta,
        ];
        
        if (is_null($this->flowName) && is_null($this->flowId)) {
            throw new \Exception('FLOWNAME OR FLOWID IS REQUIRED');
        }
        
        if (!is_null($this->flowName)) {
            $parameters['flow_name'] = $this->flowName;
            $parameters['flow_token'] = $this->flowName;

        }
        
        if (!is_null($this->flowId)) {
            $parameters['flow_id'] = $this->flowId;
            $parameters['flow_token'] = $this->flowId;
        }


        if (!is_null($this->flowAction)) {
            $parameters['flow_action'] = $this->flowAction;
        }

        if (!is_null($this->flowActionPayload)) {
            $parameters['flow_action_payload'] = $this->flowActionPayload;
        }

        return $parameters;
    }

    /**
     * Retorna a estrutura completa da ação para a requisição
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parameters' => $this->getParameters(),
        ];
    }
}
