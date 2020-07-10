
# Funções úteis para validações de CNPJ

[![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)](https://github.com/ellerbrock/open-source-badges/)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

Coletânea com funções úteis para trabalhar com validações de CNPJ.

# Exemplos de uso

```php
<?php
require_once('cnpjValidation.php');

$isValidCnpj = isValidCnpj(string $cnpj); //Cdigo de barra composto de 44 caracteres.

if ($isValidCnpj) {
    //CNPJ valido
}

//Cria os digitos de validação CNPJ
$cnpjDigits = createCnpjDigits('12345678910');
```

# Licença de uso
Esta biblioteca segue os termos de uso da [The MIT License (MIT)](https://opensource.org/licenses/mit-license.php)
