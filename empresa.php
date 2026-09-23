<?php
// empresa.php
// Todos os dados da serraria num lugar só. Quando o cliente mandar as
// informações reais, é só trocar aqui — o site inteiro usa estes valores.
//
// Campos marcados com "A CONFIRMAR" ainda são provisórios.

function empresa(): array
{
    return [
        'nome' => 'Brazil South Lumber',

        // caminho da logo (ex.: 'img/logo.svg'). Deixe '' para mostrar o nome em texto.
        'logo' => '', // A CONFIRMAR

        // telefone como aparece no site e no formato do link (só números, com +55)
        'telefone'      => '(54) 0000-0000',  // A CONFIRMAR
        'telefone_link' => '+555400000000',   // A CONFIRMAR

        // número do WhatsApp só com dígitos, com 55 + DDD. Deixe '' se não tiver.
        'whatsapp' => '', // A CONFIRMAR

        'email' => 'contato@brazilsouthlumber.com.br', // A CONFIRMAR

        'endereco' => 'RS-020, Km 98 - 3025 - Industrial', // A CONFIRMAR
        'cidade'   => 'São Francisco de Paula - RS, 95400-000', // A CONFIRMAR

        'horario' => 'Segunda a sexta, 7h30 às 17h30', // A CONFIRMAR

        // redes sociais: deixe '' as que não existirem
        'instagram' => '', // A CONFIRMAR (link completo)
        'facebook'  => '', // A CONFIRMAR (link completo)
    ];
}
