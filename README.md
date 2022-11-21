# laravel-brazilian-validators: Validações brasileiras para Laravel.

:brazil: Biblioteca para adiciona validações brasileiras no Laravel, como PIX, CPF, CNPJ, Placa de Carro, CEP entre outros.

[![Latest Version on Packagist](https://img.shields.io/badge/packagist-1.0.0-blue)](https://packagist.org/packages/paulofelipem/laravel-brazilian-validators)
[![Total Downloads](https://img.shields.io/packagist/dt/PauloFelipeM/laravel-brazilian-validators)](https://packagist.org/packages/paulofelipem/laravel-brazilian-validators)

## Requeriments

- PHP 8.1+
- Laravel 9.0+

## Instalação

Você pode instalar o pacote via composer:

```bash
composer require PauloFelipeM/laravel-brazilian-validators
```

O provedor de serviços será registrado automaticamente. Ou você pode adicionar manualmente o provedor de serviços em seu
arquivo config/app.php:

```bash
'providers' => [
  // ...
  PauloFelipeM\BrazilianValidator\BrazilianValidatorServiceProvider::class,
];
```

Agora, para utilizar a validação, basta utilizar os metódos padrões `Laravel`.

Validações disponíveis:

| REGRA           |                                                                                                                                             Descrição |
|:----------------|------------------------------------------------------------------------------------------------------------------------------------------------------:|
| pix:email       |                                                                                               Valida se o campo está no formato de chave PIX de email |
| pix:cpf_cnpj    |                                                                                         Valida se o campo está no formato de chave PIX de CPF ou CPNJ |
| pix:celular     |                                                                                             Valida se o campo está no formato de chave PIX de celular |
| pix:aleatoria   |                                                                                              Valida se o campo está no formato de chave PIX aleatória |
| phone           |                                                                              Valida se o campo está no formato `84999990000`** ou **`(84) 99999-0000` |
| phone_ddd       |                                                                          Valida se o campo está no formato `+55 (84) 99999-0000` ou `+5584999990000`. |
| cnpj            | Valida se o campo é um CNPJ válido. É possível gerar um CNPJ válido para seus testes utilizando o site [geradorcnpj.com](http://www.geradorcnpj.com/) |
| cpf             |      Valida se o campo é um CPF válido. É possível gerar um CPF válido para seus testes utilizando o site [geradordecpf.org](http://geradordecpf.org) |
| cpf_cnpj        |                                                                                                                    Valida se o campo é um CPF ou CNPJ |
| cnh             |                                   Valida se o campo é um CNH válido. Use o site [geradornv.com.br](https://geradornv.com.br/gerador-cnh/) para testar |
| cns             |                                   Valida se o campo é um CNS válido. Use o site [geradornv.com.br](https://geradornv.com.br/gerador-cns/) para testar |
| pis             |                                                                                                                             Valida se o PIS é válido. |
| uf              |                                                                                              Valida se o campo contém uma sigla de Estado válido (UF) |
| titulo_eleitor  |        Valida se o campo é um título de eleitor é válido. Use o site [geradornv.com.br](https://geradornv.com.br/gerador-titulo-eleitor/) para testar |
| renavam         |                         Valida se o campo é um renavam é válido. Use o site [geradornv.com.br](https://geradornv.com.br/gerador-renavam/) para testar |
| nis             |                                                                                                                   Valida se o campo é um NIS é válido |
| placa_veiculo   |                                                                        Valida se o campo é uma placa de veículo válida (incluindo o padrão MERCOSUL). |
| cnpj_format     |                                                                         Valida se o campo tem uma máscara de CNPJ correta (**`99.999.999/9999-99`**). |
| cpf_format      |                                                                              Valida se o campo tem uma máscara de CPF correta (**`999.999.999-99`**). |
| cep_format      |                                                                   Valida se o campo tem uma máscara de correta (**`99999-999`** ou **`99.999-999`**). |
| pis_format      |                                                                                                               Valida se o campo tem o formato de PIS. |
| cpf_cnpj_format |                                                                                                    Valida se o campo contém um formato de CPF ou CNPJ |

## Testando as validações

Com isso, é possível fazer um teste simples

```php
$validatedData = $request->validate([
    'campo.pix' => 'required|pix:email',
    'campo.pix' => 'required|pix:cpf_cnpj',
    'campo.pix' => 'required|pix:celular',
    'campo.pix' => 'required|pix:aleatoria',
    'campo.phone' => 'required|phone',
    'campo.phone' => 'required|phone_ddd',
    'campo.cnpj' => 'required|cnpj',
    'campo.cpf' => 'required|cpf',
    'campo.cpf_cnpj' => 'required|cpf_cnpj',
    'campo.cnh' => 'required|cnh',
    'campo.cns' => 'required|cns',
    'campo.pis' => 'required|pis',
    'campo.uf' => 'required|uf',
    'campo.titulo_eleitor' => 'required|titulo_eleitor',
    'campo.renavam' => 'required|renavam',
    'campo.nis' => 'required|nis',
    'campo.placa_veiculo' => 'required|placa_veiculo',
    'campo.cnpj' => 'required|cnpj_format',
    'campo.cpf' => 'required|cpf_format',
    'campo.cep' => 'required|cep_format',
    'campo.pis' => 'required|pis_format',
    'campo.cpf_cnpj' => 'required|cpf_cnpj_format',
]);
```

### Customizando as mensagens

Todas as validações citadas acima já contam mensagens padrões de validação, porém, é possível alterar isto usando o
terceiro parâmetro de `Validator::make`. Este parâmetro deve ser um array onde os índices sejam os nomes das validações
e os valores devem ser as respectivas mensagens.

Por exemplo:

```php
Validator::make($valor, $rules, ['celular_com_ddd' => 'O campo :attribute não é um celular'])
```

Ou através do método `messages` do seu Request criado pelo comando `php artisan make:request`.

```php
public function messages() {

    return [
        'campo.phone' => 'Celular não é válido!'
    ];
}
```

### Changelog

Veja [CHANGELOG](CHANGELOG.md) para mais informações.

### Bugs

Se você identificar alguma falha, por favor abra uma issue no Github.

## Créditos

- [Paulo Felipe Martins](https://github.com/PauloFelipeM)

## Licença

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
