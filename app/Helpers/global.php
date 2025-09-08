<?php

use Illuminate\Support\Facades\Request;

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

if (!function_exists('active_filter')) {
    /**
     * Verifica se um filtro está ativo
     */
    function active_filter($field, $value)
    {
        return Request::get($field) == $value ? 'selected' : '';
    }
}