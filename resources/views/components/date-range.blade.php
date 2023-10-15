@props(['disabled' => false, 'startDate' => null, 'endDate' => null])

@php
    $company = App\Helpers\GlobalFunctions::getAuthenticatedUserCompany();
    $setting = App\Models\Setting::where('user_id', $company->user_id)->first();
@endphp

@if ($setting->theme == 'dark')
    <link rel="stylesheet" href="{{ asset('assets/css/date-range-dark.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('assets/css/date-range-light.css') }}">
@endif


<div id="reportrange" {!! $attributes->merge([
    'class' =>
        'flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:focus:border-gray-500 dark:focus:ring-gray-600 dark:focus:ring-opacity-50' .
        ($disabled ? ' disabled' : ''),
]) !!}>
    <i class="fa fa-calendar"></i>&nbsp;
    <span>{{ $startDate && $endDate ? "$startDate - $endDate" : 'Select date range' }}</span>
    <i class="fa fa-caret-down"></i>
</div>

<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        var search = getParam('date_filter');
        if (search) {
            var dateRanges = search.split(' - ');
            start = moment(new Date(dateRanges[0].trim() + ' 00:00:00'));
            end = moment(new Date(dateRanges[1].trim() + ' 11:59:59'));
        }

        function getParam(param) {
            return new URLSearchParams(window.location.search).get(param);
        }

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
                    .endOf('year')
                ],
                'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
            },
        }, cb).on('apply.daterangepicker', function(event, picker) {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');
            window.livewire.emit('dateRangeUpdated', startDate, endDate); // notify Livewire
        });
    });
</script>
