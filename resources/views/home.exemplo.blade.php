@extends('layout')
@section('titulo','Titulo da Pagina')
@section('conteudo')
    <H1>Home do projeto</H1>


{{--  Isso é um comentário apenas para blade --}}

{{  isset($nome) ? "Existe nome" : "Não existe nome" }}
<Br>
{{ $endereco ?? 'Quando a variaável não existe mostra o valor padrão' }}
<br>
@if ($nome == 'ELITE SISTEMAS')
    Empresa Elite    
@else
    Não é a Elite Sistemas
@endif
<br>
@switch($nome)
    @case('ELITE SISTEMAS')
        Estamos na elite
        @break
    @case('COGNITUS')
        Estamos na Cognitus
        @break

    @default
        Não sabemos qual a empresa

@endswitch
<br>
@isset($nome)
    Nome existe
    
@endisset
<br>
@empty($nome)
  Varável nome vazia
    
@endempty
<br>
@auth()
    Autenticado
@endauth
<br>
@guest
    Não autenticado
@endguest

@for ($i=0; $i < 0; $i++)
 valor de i: {{ $i }} <Br>
    
@endfor

@php
    $i =0;
@endphp

@while ($i <= 10)
 valor de i: {{ $i }} <Br>
    @php $i++; @endphp
@endwhile
@php
    $frutas = ['Banana', 'Maça', 'Pera']
@endphp

@foreach ($frutas as $fruta )
    Qual a fruta: {{ $fruta }} <Br>
@endforeach

@php
    $carros = []
@endphp

@forelse ( $carros as $carro )
    Qual o carro: {{ $carro }}
@empty
    Array de carros vazio <Br>
@endforelse
    

@include('includes.mensagem', ['titulo' => 'TItulo da mensagem do includes'])

@component('compoments.sidebar')
   @slot('paragrafo')
        TExto para o Slot
   @endslot     
@endcomponent

@endsection

@push('outroestilo')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
@endpush

@push('outrojsestilo')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@endpush