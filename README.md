# Upload Multiplo de Imagens - Codeigniter
Codeigniter :::::: Upload de várias imagens simultaneamente.

## Upload + Cadastro no banco de dados
Faz upload e registra todas as imagens no banco de dados.

### Arquivos
- views         ----> index.php
- controller    ----> Upload.php
- model			----> Arquivo_model.php

### Configurações

#### autoload.php
- $autoload['libraries'] = array('session', 'database');
- $autoload['helper'] = array('url');

#### config.php
- $config['base_url'] = 'http://127.0.0.1/up/';
- $config['encryption_key'] = 'DFDCCF1AB3FAC6F7597EF6596672D';

- $config['sess_driver'] = 'database';
- $config['sess_cookie_name'] = 'ci_sessions';
- $config['sess_expiration'] = 7200;
- $config['sess_save_path'] = 'ci_sessions';
- $config['sess_match_ip'] = FALSE;
- $config['sess_time_to_update'] = 300;
- $config['sess_regenerate_destroy'] = FALSE;

#### routes.php
- $route['default_controller'] = 'upload';