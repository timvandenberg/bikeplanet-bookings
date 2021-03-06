@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full m-auto md:max-w-4xl sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="flex justify-between flex-wrap sm:no-wrap bg-gray-200 py-5 px-6 sm:py-6 sm:rounded-t-md">
                <h1 class="w-full sm:w-2/3 text-2xl sm:text-4xl font-semibold mb-2 text-gray-700">
                    Travelers information
                </h1>
                <div class="w-full sm:w-1/3 flex justify-end items-start">
                    <div class="flex flex-col justify-end">
                        <h3 class="text-sm sm:text-md font-semibold mb-2 pt-2 text-gray-700">
                            page 3 of 4
                        </h3>
                    </div>
                </div>
            </header>

            <form class="" method="POST" action="{{ route('booking.part4') }}">
                @csrf

                <div class="full p-6">
                    <div class="w-full">
                        <div class="flex mb-6">
                            <h3 class="text-xl sm:text-2xl font-semibold mb-2 text-gray-700 pr-2">I want to book for</h3>
                            <select class="form-input transform text-xl sm:text-2xl font-semibold text-gray-700" name="input_total_person_count" id="select_total_persons">
                                <option value="1">1</option>
                                <option selected value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                            <h3 class="text-xl sm:text-2xl font-semibold mb-2 text-gray-700 pl-2">people</h3>
                        </div>
                    </div>

                    <div class="w-full flex">
                        <div class="w-full space-y-6 sm:space-y-8">
                            <div class="w-full">
                                @for($nr = 1; $nr < 9; $nr++)
                                @include('booking.forms.person-fields')
                                @endfor
                            </div>

                            <script>
                                var prefilledFirstMame1 = '{{$first_name_1}}'
                                var prefilledLastMame1 = '{{$last_name_1}}'
                                var prefilledBirthDate1 = '{{$birth_date_1}}'
                                var prefilledEmail1 = '{{$email_1}}'
                                var prefilledPhone1 = '{{$phone_1}}'
                                var prefilledStreet1 = '{{$street_1}}'
                                var prefilledPostalCode1 = '{{$postal_code_1}}'
                                var prefilledTown1 = '{{$town_1}}'
                                var prefilledCountry1 = '{{$country_1}}'
                            </script>

                            <div class="flex flex-wrap">
                                <button type="submit"
                                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 sm:py-4">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>
@endsection
