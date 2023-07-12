<?php

namespace Noures\NovaCep\Fields;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\SupportsDependentFields;

class Cep extends Field
{
    use SupportsDependentFields;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'cep-field';

    /**
     * The attribute map to set address fields.
     *
     * @var array<string, mixed>
     */
    public $meta = [
        'options' => [
            'endereco' => 'logradouro',
            'complemento' => 'complemento',
            'bairro' => 'bairro',
            'cidade' => 'localidade',
            'estado' => 'uf'
        ]
    ];
}
