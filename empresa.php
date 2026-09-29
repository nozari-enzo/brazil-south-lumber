<?php
// empresa.php
// Todos os dados da serraria num lugar só. O site inteiro usa estes valores.
//
// Campos marcados com "A CONFIRMAR" ainda são provisórios.

function empresa(): array
{
    return [
        'nome' => 'Brazil South Lumber',

        // símbolo da logo, mostrado ao lado do nome. Deixe '' para mostrar só o nome.
        'logo' => 'img/logo-simbolo.png',

        // telefone como aparece no site e no formato do link (só números, com +55)
        'telefone'      => '(53) 99971-9560',
        'telefone_link' => '+5553999719560',

        // número do WhatsApp só com dígitos, com 55 + DDD. Deixe '' se não tiver.
        'whatsapp' => '5553999719560', // A CONFIRMAR: mesmo número do telefone?

        'email' => 'administracao@brazilsouth.com.br',

        'endereco' => 'RS-020, Km 98, nº 6025 - Zona Industrial',
        'cidade'   => 'São Francisco de Paula - RS, 95400-000',

        'horario' => 'Segunda a sexta, 7h às 11h40 e 13h30 às 17h38', // A CONFIRMAR: dias da semana

        // redes sociais: deixe '' as que não existirem
        'instagram' => '',
        'facebook'  => '',
    ];
}
