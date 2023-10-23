@extends('BackOffice.home')
@section('content')
<div class="content-wrapper">
    @auth
    <div class="container-xxl flex-grow-1 container-p-y">
        <span class="text-muted fw-light">
            <div class="d-flex">
                <a href="{{url('admin/Rentings')}}">
                    <h4 class="fw-bold py-3 mb-4">Rentings </h4>
                </a>
                <h4 class="fw-bold py-3 mb-4"> / Edit Renting</h4>
            </div>
        </span>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <section class="ftco-section contact-section">
                    <div class="container">
                        <div class="row d-flex contact-info justify-content-center">
                            <div class="col-md-8">
                                <h2 class="text-lg font-medium text-gray-900">
                                    Edit Rent
                                </h2>
                                <form method="post" action="{{ route('editRent',['Renting_id'=>$Rent->id]) }}" class="bg-light p-5 contact-form">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <x-input-label for="PUD" value="PUD" />
                                        <x-text-input id="PUD" name="PUD" type="date" class="form-control" 
                                            :value="$Rent->PUD" autofocus autocomplete="PUD" /> @if($errors->has('PUD'))
                                            <div class="text-danger">{{ $errors->first('PUD') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="PUT" value="PUT" />
                                        <x-text-input id="PUT" name="PUT" type="time"
                                            :value="$Rent->PUT" class="form-control"  autofocus
                                            autocomplete="PUT" />
                                            @if($errors->has('PUT'))
                                            <div class="text-danger">{{ $errors->first('PUT') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="NbreHours" value="NbreHours" />
                                        <x-text-input id="NbreHours" name="NbreHours" type="number" class="form-control"
                                            :value="$Rent->NbreHours"  autofocus autocomplete="NbreHours" />
                                            @if($errors->has('NbreHours'))
                                            <div class="text-danger">{{ $errors->first('NbreHours') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="NbreDays" value="NbreDays" />
                                        <x-text-input id="NbreDays" name="NbreDays" type="number" class="form-control"
                                            :value="$Rent->NbreDays"  autofocus autocomplete="NbreDays" />
                                            @if($errors->has('NbreDays'))
                                            <div class="text-danger">{{ $errors->first('NbreDays') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Confirmation" value="Confirmation" />
                                        <select id="Confirmation" name="Confirmation" :value="$Rent->Confirmation" class="form-select"
                                             autofocus>
                                            <option value="payed">Paid</option>
                                            <option value="Not_Paid">Not Paid</option>
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="STATUS" value="STATUS" />
                                        <select id="STATUS" name="STATUS" :value="$Rent->STATUS" class="form-select"
                                             autofocus>
                                            <option value="Approved">Approved</option>
                                            <option value="Canceled">Canceled</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <x-primary-button class="btn btn-primary py-3 px-5 mt-3" type="submit">Save
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @endauth
        </div>
        @endsection