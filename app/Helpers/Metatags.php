<?php

function getMetaTags()
{
    $scheme = $_SERVER['REQUEST_SCHEME'];
    $dominio = $_SERVER['SERVER_NAME'];
    $uri = $_SERVER['REQUEST_URI'];
    $url = "{$scheme}://{$dominio}{$uri}";

    return [
        'site_name' => 'VAT Tecnologia da Informação',
        'url' => $url,
        'description' => 'A VAT é uma empresa de Tecnologia da Informação, especializada em elaborar e executar projetos de educação em massa e comunicação corporativa, desde 2000 no mercado, com resultados expressivos premiados nacional e internacionalmente.',
        'keywords' => 'VAT, Grupo VAT, VAT S/A, VAT Tecnologia da Informação, Tecnologia, IPTV, IP.TV, My, MyScreen, MyClass, Studio Pack, Syncast, IP.TV Syncast, Whitelabel, White label, Ava'
    ];
}