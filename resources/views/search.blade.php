@extends('layouts.app')
@section('content')
@php
    // $mydata = $response->allRoute
// $zda = "sdasda-------------------------------";
//     var_dump($response);
// var_dump($zda);
// var_dump($response->countriesRoute->Name);
@endphp
{{-- {{$response['countriesRoute']['Name']}} --}}
{{-- {{$response->countriesRoute->Name}} --}}
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
        <th scope="col">Үйлдэл</th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @foreach ($response as $element)
        <tr class="clickable-row" data-href='url://127.0.0.1:8000/'>
            <td class="px-6 py-4 whitespace-nowrap">{{$loop->index+1}}</td>
            <td>
                {{$element->Name}}<br>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
    {{-- {{$response->allRoute}} --}}
@endsection