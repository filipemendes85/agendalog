<?php

if (!function_exists('applicationMessage')) {

    /**
     * Retorna mensagens de alerta padronizadas para o sistema
     * 
     * Esta função centraliza todas as mensagens de feedback do sistema, permitindo
     * reutilização e consistência nas mensagens exibidas para o usuário.
     * 
     * @param string $Message Chave da mensagem pré-definida no array de mensagens
     * @param string $complement [opcional] Texto complementar para a mensagem principal
     * 
     * @return string Mensagem formatada pronta para exibição
     * 
     * */
    
    function applicationMessage(string $Message, string $complement = ''): string
    {
        $messages = [
            //mensagens de processamento
            'pesquisando'       => 'pesquisando...',
            'salvando'          => 'salvando...',
            'excluindo'         => 'excluindo...',
            'carregando'        => 'carregando...',
            'processando'       => 'processando...',
            'validando'         => 'validando dados...',
            'enviado_email'     => 'enviado e-mail...',
            'exportando'        => 'exportando dados...',
            'importando'        => 'importando dados...',
            'gerando_relatorio' => 'gerando relatório...',
            'conectando'        => 'conectando...',

            //mensagens de sucesso
            'cadastrar'             => 'cadastrado com sucesso.',
            'atualizar'             => 'atualizado com sucesso.',
            'excluir'               => 'excluído com sucesso.',
            'email_enviado'         => 'e-mail enviado com sucesso.',
            'senha_alterada'        => 'senha alterada com sucesso.',
            'status_alterado'       => 'status alterado com sucesso.',

            //mensagens de erro
            'erro'              => 'ocorreu um erro.',
            'erro_permissao'    => 'você não tem permissão para esta ação.',
            'erro_arquivo'      => 'erro ao processar o arquivo.',
            'erro_envio_email'  => 'erro ao enviar e-mail.',
            'erro_validacao'    => 'erro de validação nos dados.',
            'erro_importacao'   => 'erro durante a importação.',
            'erro_upload'       => 'erro no upload do arquivo.',

            //Mensagens de informação
            'nao_encontrado'        => 'registro não encontrado.',
            'sem_registros'         => 'nenhum registro encontrado.',
            'campo_obrigatorio'     => 'preencha todos os campos obrigatórios.',
            'selecionar_registro'   => 'selecione um registro para continuar.',

            // Mensagens de alerta/aviso
            'confirmar_exclusao'    => 'confirma a exclusão deste registro?',
            'confirmar_alteracao'   => 'confirma as alterações?',
            'confirmar_saida'       => 'tem certeza que deseja sair?',
            'dados_nao_salvos'      => 'as alterações não foram salvas.',
            'limite_excedido'       => 'limite máximo excedido.',
            'arquivo_grande'        => 'arquivo muito grande.',

            // Mensagens de relatório/exportação
            'relatorio_gerado'      => 'relatório gerado com sucesso.',
            'dados_exportados'      => 'dados exportados com sucesso.',
            'nenhum_dado_exportar'  => 'nenhum dado para exportar.',
            'importacao'            => 'importação realizada com sucesso.',
            'exportacao'            => 'exportação realizada com sucesso.',

            // Mensagens de autenticação
            'senha_redefinida'  => 'senha redefinida com sucesso.',
            'token_invalido'    => 'token inválido ou expirado.',
            'conta_confirmada'  => 'conta confirmada com sucesso.',
            'email_verificacao' => 'e-mail de verificação enviado.',
            'login'             => 'login realizado com sucesso.',
            'logout'            => 'logout realizado com sucesso.',

            // Mensagens de placeholders
            'placeholder_pesquisa'      => 'digite para pesquisar...',
            'placeholder_email'         => 'seu_email@email.com',
            'placeholder_celular'       => '(27) 99999-9999',
            'placeholder_telefone'      => '(27) 9999-9999',
            'placeholder_CEP'           => '00000-000',
            'placeholder_endereco'      => 'Rua, Avenida, etc.',
            'placeholder_numero'        => '123',
            'placeholder_complemento'   => 'Apto, Sala, etc.',
            'placeholder_bairro'        => 'Centro',
            'placeholder_cidade'        => 'Nome da cidade',

            // Mensagens de agenda/calendário
            'agendamento_confirmado'    => 'agendamento confirmado com sucesso.',
            'agendamento_cancelado'     => 'agendamento cancelado.'
        ];

        $msg = $messages[$Message] ?? 'Operação realizada com sucesso.';

        if (!empty($complement)) {
            $msg .= "<br>$complement";
        }

        return $msg;
    }
}