<style>
    /* Add this CSS in your CSS file, and make sure to import it in your project */
    @media (max-width: 767.98px) {
        .iq-navbar-header .iq-header-img {
            height: 310px !important;
        }

        .container-fluid.content-inner.mt-n5 {
            margin-top: unset !important;
        }
    }

    .iq-banner:not(.hide)+.content-inner {
        margin-top: -3rem !important;
        padding-top: 0;
        padding-bottom: 0;
    }
</style>

{{-- Display the following code only if the route is "dashboard" --}}
{{-- @if (Route::is('dashboard'))
    <div class="relative bg-gray-200 overflow-hidden mb-5 dark:bg-gray-700">
        <img src="{{ asset('images/dashboard/top-header.png') }}"
            class="w-full h-48 object-cover transition-all duration-400 transform-origin-left overflow-hidden rounded-b-lg">

        <div class="absolute inset-0 flex items-center justify-between px-4 py-2">
            <div>
                <h1 id="greeting" class="text-4xl text-white"></h1>
                <p class="text-base text-white italic">{{ $quote = \App\Helpers\InspiringQuotesHelper::quote() }}</p>
            </div>
            <div id="second" class="text-white text-md font-bold animate-pulse text-right">
                {{ now()->format('h:i A') }}
            </div>
        </div>
    </div>
@endif --}}
@if (Route::is('dashboard'))
    <div x-data="timeData()" x-init="init()"
        class="relative bg-gray-200 overflow-hidden mb-5 dark:bg-gray-900">
        <img src="{{ asset('images/dashboard/top-header.png') }}"
            class="w-full h-48 object-cover transition-all duration-400 transform-origin-left overflow-hidden rounded-b-lg">

        <div class="absolute inset-0 flex items-center justify-between px-4 py-2">
            <div>
                <h1 x-text="greeting" class="text-4xl text-white"></h1>
                <p class="text-base text-white italic mt-2">{{ $quote = \App\Helpers\InspiringQuotesHelper::quote() }}</p>
            </div>
            <div x-text="formattedTime" class="text-white text-md font-bold animate-pulse text-right capitalize"></div>
        </div>
    </div>

    <script>
        function timeData() {
            return {
                formattedTime: '',
                greeting: '',
                lang: "{{ app()->getLocale() }}",
                user: @json(auth()->user()),

                init() {
                    this.updateTime();
                    setInterval(() => this.updateTime(), 1000);
                },

                updateTime() {
                    let timezone = "Africa/Djibouti";
                    let currentTime = new Date().toLocaleString("en-US", {
                        timeZone: timezone
                    });
                    let dateObject = new Date(currentTime);

                    let day = dateObject.toLocaleString(this.lang, {
                        weekday: 'long'
                    });
                    let month = dateObject.toLocaleString(this.lang, {
                        month: 'long'
                    });
                    let year = dateObject.getFullYear();
                    let date = dateObject.getDate();
                    let hours = dateObject.getHours();
                    let minutes = dateObject.getMinutes();
                    let seconds = dateObject.getSeconds();

                    let amPm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12;
                    hours = String(hours).padStart(2, "0");
                    minutes = String(minutes).padStart(2, "0");
                    seconds = String(seconds).padStart(2, "0");

                    this.formattedTime = `${day} ${date} ${month} ${year} ${hours}:${minutes}:${seconds} ${amPm}`;

                    let currentTimeUTC = new Date().getUTCHours();
                    if (currentTimeUTC < 12) {
                        this.greeting = this.lang === 'en' ? 'Good morning' : this.lang === 'fr' ? 'Bonjour' : 'صباح الخير';
                    } else if (currentTimeUTC < 17) {
                        this.greeting = this.lang === 'en' ? 'Good afternoon' : this.lang === 'fr' ? 'Bon après-midi' :
                            'مساء الخير';
                    } else {
                        this.greeting = this.lang === 'en' ? 'Good evening' : this.lang === 'fr' ? 'Bonsoir' : 'مساء الخير';
                    }

                    if (this.user !== null) {
                        this.greeting += ", " + this.user.name;
                    }
                }
            };
        }
    </script>
@endif
