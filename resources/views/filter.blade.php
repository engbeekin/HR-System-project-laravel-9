<div class="container">


    <form action="">
        {{-- <div class="select-container">
            <select id="salary_range">
                <option>{{ \App\Constants\GlobalConstants::ALL }}</option>
                @foreach (\App\Models\Country::SALARY_RANGE as $range)
                    <option>{{ $range }}</option>
                @endforeach
            </select>
        </div> --}}
        {{-- <div class="select-container">
            <select id="sort_by">
                <option>{{ \App\Constants\GlobalConstants::ALL }}</option>
                @foreach (\App\Constants\GlobalConstants::LIST_TYPE as $type)
                    <option>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div> --}}


        <div class="select-container">
            <select id="country">
                <option>All</option>
                @foreach (\App\Models\Country::all() as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
