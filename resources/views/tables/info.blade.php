@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1>{{ $table }}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('columns.store', $table) }}">

                    @foreach($columns as $column)
                        @if('id' != $column->COLUMN_NAME)

                            <div class="form-group dotted">
                                <label
                                    for="{{ $column->COLUMN_NAME }}"><strong>{{ $column->COLUMN_NAME }}</strong> @if('NO' == $column->IS_NULLABLE)
                                        <span>***</span>@endif [<span
                                        style="font-size: 12px;"> Type: {{ $column->COLUMN_TYPE }}</span> ]</label>

                                @isset($column->values['value'])
                                    <input class="form-control form-control-sm mt-3" type="text"
                                           name="{{ $column->COLUMN_NAME }}[value]"
                                           autocomplete="off"
                                           value="{{ $column->values['value'] ?? '' }}"
                                    >
                                @endisset
                                <textarea class="form-control form-control-sm mt-3" type="text"
                                          readonly>{{ $column->value ?? ''}}</textarea>
                                <small id="cammandHelp" class="form-text text-muted">parameters JSON format</small>
                            </div>

                        @endif
                    @endforeach

                    <div class="form-group dotted text-right">
                        <button class="btn btn-sm btn-outline-success">{{ __('Update') }}</button>
                    </div>
                </form>

                {{--                @foreach($values as $key => $value)--}}
                {{--                    <div> {{ $key }} : {{ $value }}</div>--}}
                {{--                @endforeach--}}

            </div>
            {{--    <div class="overflow-auto font-weight-light"--}}
            {{--         style="font-family: 'Nunito', sans-serif; font-size: 10px">{{  json_encode($column) }}</div>--}}
            <div class="col-md-8 font-weight-light position-relative"
                 style="font-family: 'Nunito', sans-serif; font-size: 12px">
                <div class="position-fixed overflow-auto" style="max-height: 780px;">
                    <h3>Formatters</h3>
                    <p>randomDigit // 7<br/>
                        randomDigitNot(5) // 0, 1, 2, 3, 4, 6, 7, 8, or 9<br/>
                        randomDigitNotNull // 5<br/>
                        randomNumber($nbDigits = NULL, $strict = false) // 79907610<br/>
                        randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL) // 48.8932<br/>
                        numberBetween($min = 1000, $max = 9000) // 8567<br/>
                        randomLetter // 'b'<br/>
                        // returns randomly ordered subsequence of a provided array<br/>
                        randomElements($array = array ('a','b','c'), $count = 1) // array('c')<br/>
                        randomElement($array = array ('a','b','c')) // 'b'<br/>
                        shuffle('hello, world') // 'rlo,h eoldlw'<br/>
                        shuffle(array(1, 2, 3)) // array(2, 1, 3)<br/>
                        numerify('Hello ###') // 'Hello 609'<br/>
                        lexify('Hello ???') // 'Hello wgt'<br/>
                        bothify('Hello ##??') // 'Hello 42jz'<br/>
                        asciify('Hello ***') // 'Hello R6+'<br/>
                        regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'); // sm0@y8k96a.ej</p>
                    <h3>Lorem</h3>
                    <p>
                        word // 'aut'<br/>
                        words($nb = 3, $asText = false) // array('porro', 'sed', 'magni')<br/>
                        sentence($nbWords = 6, $variableNbWords = true) // 'Sit vitae voluptas sint non
                        voluptates.'<br/>
                        sentences($nb = 3, $asText = false) // array('Optio quos qui illo error.', 'Laborum vero a
                        officia
                        id corporis.', 'Saepe provident esse hic eligendi.')<br/>
                        paragraph($nbSentences = 3, $variableNbSentences = true) // 'Ut ab voluptas sed a nam. ...<br/>
                        paragraphs($nb = 3, $asText = false) // array('Quidem ut sunt et quidem est accusamus aut.
                        ...<br/>
                        text($maxNbChars = 200) // 'Fuga totam reiciendis qui architecto fugiat nemo. ...<br/>
                    </p>
                    <h3>Person</h3>
                    <p>
                        title($gender = null|'male'|'female') // 'Ms.'<br/>
                        titleMale // 'Mr.'<br/>
                        titleFemale // 'Ms.'<br/>
                        suffix // 'Jr.'<br/>
                        name($gender = null|'male'|'female') // 'Dr. Zane Stroman'<br/>
                        firstName($gender = null|'male'|'female') // 'Maynard'<br/>
                        firstNameMale // 'Maynard'<br/>
                        firstNameFemale // 'Rachel'<br/>
                        lastName // 'Zulauf'<br/>
                    </p>
                    <h3>Address</h3>
                    <p>
                        cityPrefix // 'Lake'<br/>
                        secondaryAddress // 'Suite 961'<br/>
                        state // 'NewMexico'<br/>
                        stateAbbr // 'OH'<br/>
                        citySuffix // 'borough'<br/>
                        streetSuffix // 'Keys'<br/>
                        buildingNumber // '484'<br/>
                        city // 'West Judge'<br/>
                        streetName // 'Keegan Trail'<br/>
                        streetAddress // '439 Karley Loaf Suite 897'<br/>
                        postcode // '17916'<br/>
                        address // '8888 Cummings Vista Apt. 101, Susanbury, NY 95473'<br/>
                        country // 'Falkland Islands (Malvinas)'<br/>
                        latitude($min = -90, $max = 90) // 77.147489<br/>
                        longitude($min = -180, $max = 180) // 86.211205<br/>
                    </p>
                    <h3>PhoneNumber</h3>
                    <p>
                        phoneNumber // '201-886-0269 x3767'<br/>
                        tollFreePhoneNumber // '(888) 937-7238'<br/>
                        e164PhoneNumber // '+27113456789'<br/>
                    </p>
                    <h3>Text</h3>
                    <p>
                        realText($maxNbChars = 200, $indexSize = 2)<br/>
                    </p>
                    <h3>DateTime</h3>
                    <p>
                        unixTime($max = 'now') // 58781813<br/>
                        dateTime($max = 'now', $timezone = null) // DateTime('2008-04-25 08:37:17', 'UTC')<br/>
                        dateTimeAD($max = 'now', $timezone = null) // DateTime('1800-04-29 20:38:49',
                        'Europe/Paris')<br/>
                        iso8601($max = 'now') // '1978-12-09T10:10:29+0000'<br/>
                        date($format = 'Y-m-d', $max = 'now') // '1979-06-09'<br/>
                        time($format = 'H:i:s', $max = 'now') // '20:49:42'<br/>
                        dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null) //
                        DateTime('2003-03-15 02:00:49', 'Africa/Lagos')<br/>
                        dateTimeInInterval($startDate = '-30 years', $interval = '+ 5 days', $timezone = null) //
                        DateTime('2003-03-15 02:00:49', 'Antartica/Vostok')<br/>
                        dateTimeThisCentury($max = 'now', $timezone = null) // DateTime('1915-05-30 19:28:21',
                        'UTC')<br/>
                        dateTimeThisDecade($max = 'now', $timezone = null) // DateTime('2007-05-29 22:30:48',
                        'Europe/Paris')<br/>
                        dateTimeThisYear($max = 'now', $timezone = null) // DateTime('2011-02-27 20:52:14',
                        'Africa/Lagos')<br/>
                        dateTimeThisMonth($max = 'now', $timezone = null) // DateTime('2011-10-23 13:46:23',
                        'Antarctica/Vostok')<br/>
                        amPm($max = 'now') // 'pm'<br/>
                        dayOfMonth($max = 'now') // '04'<br/>
                        dayOfWeek($max = 'now') // 'Friday'<br/>
                        month($max = 'now') // '06'<br/>
                        monthName($max = 'now') // 'January'<br/>
                        year($max = 'now') // '1993'<br/>
                        century // 'VI'<br/>
                        timezone // 'Europe/Paris'<br/>
                    </p>
                    <h3>Internet</h3>
                    <p>
                        email // 'tkshlerin@collins.com'<br/>
                        safeEmail // 'king.alford@example.org'<br/>
                        freeEmail // 'bradley72@gmail.com'<br/>
                        companyEmail // 'russel.durward@mcdermott.org'<br/>
                        freeEmailDomain // 'yahoo.com'<br/>
                        safeEmailDomain // 'example.org'<br/>
                        userName // 'wade55'<br/>
                        password // 'k&|X+a45*2['<br/>
                        domainName // 'wolffdeckow.net'<br/>
                        domainWord // 'feeney'<br/>
                    </p>
                    <h3>Uuid</h3>
                    <p>
                        uuid // '7e57d004-2b97-0e7a-b45f-5387367791cd'<br/>
                    </p>
                    <h3>Miscellaneous</h3>
                    <p>
                        boolean // false
                        boolean($chanceOfGettingTrue = 50) // true<br/>
                        md5 // 'de99a620c50f2990e87144735cd357e7'<br/>
                        sha1 // 'f08e7f04ca1a413807ebc47551a40a20a0b4de5c'<br/>
                        sha256 // '0061e4c60dac5c1d82db0135a42e00c89ae3a333e7c26485321f24348c7e98a5'<br/>
                        locale // en_UK<br/>
                        countryCode // UK<br/>
                        languageCode // en<br/>
                        currencyCode // EUR<br/>
                        emoji // 😁<br/>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
