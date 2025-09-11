<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('show_alert')) {
    function show_alert($message, $type = 'success')
    {
        session()->flash($type, $message);
    }
}

if (!function_exists('alert_success')) {
    function alert_success($message)
    {
        return show_alert($message, 'success');
    }
}

if (!function_exists('alert_error')) {
    function alert_error($message)
    {
        return show_alert($message, 'error');
    }
}

if (!function_exists('alert_warning')) {
    function alert_warning($message)
    {
        return show_alert($message, 'warning');
    }
}

if (!function_exists('alert_info')) {
    function alert_info($message)
    {
        return show_alert($message, 'info');
    }
}

if (!function_exists('sort_link')) {
    /**
     * Gera link de ordenação com seta
     */
    function sort_link($field, $title = null)
    {
        $title = $title ?? ucfirst($field);
        $sort = Request::get('sort');
        $direction = Request::get('direction');
        $newDirection = ($sort === $field && $direction === 'asc') ? 'desc' : 'asc';

        $url = Request::fullUrlWithQuery([
            'sort' => $field,
            'direction' => $newDirection
        ]);

        $icon = '';
        if ($sort === $field) {
            $icon = $direction === 'asc' ? '↑' : '↓';
        }

        return '<a href="' . $url . '" class="sortable-link text-decoration-none">' . $title . ' ' . $icon . '</a>';
    }
}

if (!function_exists('format_phone')) {
    /**
     * Formata telefone brasileiro
     */
    function format_phone($phone)
    {
        if (empty($phone)) return 'N/A';
        
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if (strlen($phone) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
        }
        
        if (strlen($phone) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $phone);
        }
        
        return $phone;
    }
}

if (!function_exists('format_document')) {
    /**
     * Formata CPF/CNPJ
     */
    function format_document($document)
    {
        if (empty($document)) return 'N/A';
        
        $document = preg_replace('/[^0-9]/', '', $document);
        
        if (strlen($document) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $document);
        }
        
        if (strlen($document) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $document);
        }
        
        return $document;
    }
}

if (!function_exists('validateCPF')) {
    /**
        * Valida CPF
    */
    function validateCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        
        return true;
    }
}

if (!function_exists('validateCNPJ')) {
    /**
        * Valida CNPJ
    */
    function validateCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        
        if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        for ($t = 12; $t < 14; $t++) {
            for ($d = 0, $m = ($t - 7), $i = 0; $i < $t; $i++) {
                $d += $cnpj[$i] * $m;
                $m = ($m == 2) ? 9 : $m - 1;
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cnpj[$i] != $d) {
                return false;
            }
        }

        return true;
    }
}