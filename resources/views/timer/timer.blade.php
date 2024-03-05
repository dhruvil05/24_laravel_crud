<x-app-layout>

    @section('css-styles')
        <style>
            .stopwatch {
                text-align: center;
                margin-top: 50px;
            }

            .display {
                font-size: 36px;
                font-weight: bold;
                margin-bottom: 20px;
            }

            button {
                margin: 5px;
                padding: 10px 20px;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                background-color: #4CAF50;
                color: white;
                cursor: pointer;
            }

            button:hover {
                background-color: #45a049;
            }

            button:active {
                background-color: #3e8e41;
            }
        </style>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timer') }}
        </h2>
    </x-slot>
    @php
        $time = explode(':', $checkInTime);

    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="testEvent"></div>
                    <div id="stopwatch" class="d-inline border border-dark rounded-2 p-2 m-2">{{ $checkInTime }}</div>
                    <div id="stopedtime" class="d-inline border border-dark rounded-2 p-2 m-2">00:00:00</div>

                    <div class="my-2">
                        <button id="startBtn">Start</button>
                        <button id="stopBtn">Stop</button>
                        <button id="resetBtn">Reset</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @section('js-script')

    <script type="module">
        Echo.channel('AttendanceChannel').listen('AttendancesEvent', (data) => {
            console.log(data);
            document.getElementById("stopwatch").innerHTML = data.data;
        });
    </script>
        <script type="text/javascript">
            $(document).ready(function() {
                var time = @json($time);

                // clocking(time);

                // function clocking(time) {

                //     seconds = time[2];
                //     minutes = time[1];
                //     hours = time[0];

                //     setInterval(() => {
                //         seconds++
                //         if (seconds == 60) {
                //             minutes++;
                //             seconds = 0;
                //         }

                //         if (minutes == 60) {
                //             hours++;
                //             minutes = 0;
                //             seconds = 0;
                //         }

                //         if (hours == 24) {
                //             hours = 0;
                //             minutes = 0;
                //             seconds = 0
                //         }

                //         var displayTime = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
                //         document.getElementById("stopwatch").innerHTML = displayTime;
                //     }, 1000);

                //     function pad(number) {
                //         return (number > 0 && number < 10 ? "0" : "") + number;
                //     }
                // }

                $('#startBtn').click(function() {
                    var currentTime = new Date().toLocaleTimeString();
                    var fullDate = new Date();
                    var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) :
                        '0' + (fullDate.getMonth() + 1);

                    var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var headers = {
                        'X-CSRF-TOKEN': csrfToken
                    };

                    $.ajax({
                        type: "POST",
                        url: "{{ route('timer.clocking') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            time: currentTime,
                            date: currentDate,
                            status:1,
                        },
                        dataType: "json",
                        success: function(response) {
                            // let time = response.time.split(":");
                            // clocking(time)
                            // console.log(response.time);
                            // console.log('Time sent to server:', currentTime);

                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending time:', error);
                        }
                    });



                });

                $('#stopBtn').click(function() {
                    var currentTime = new Date().toLocaleTimeString();
                    var fullDate = new Date();
                    var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) :
                        '0' + (fullDate.getMonth() + 1);

                    var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var headers = {
                        'X-CSRF-TOKEN': csrfToken
                    };

                    $.ajax({
                        type: "POST",
                        url: "{{ route('timer.clocking') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            time: currentTime,
                            date: currentDate,
                            status:2,
                        },
                        dataType: "json",
                        success: function(response) {
                            // let time = response.time.split(":");
                            // clocking(time)
                            // console.log(response.time);
                            // console.log('Time sent to server:', currentTime);

                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending time:', error);
                        }
                    });



                });

                $('#resetBtn').click(function() {
                    var currentTime = new Date().toLocaleTimeString();
                    var fullDate = new Date();
                    var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) :
                        '0' + (fullDate.getMonth() + 1);

                    var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var headers = {
                        'X-CSRF-TOKEN': csrfToken
                    };

                    $.ajax({
                        type: "POST",
                        url: "{{ route('timer.clocking') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            time: currentTime,
                            date: currentDate,
                            status:3,
                        },
                        dataType: "json",
                        success: function(response) {
                            // let time = response.time.split(":");
                            // clocking(time)
                            // console.log(response.time);
                            // console.log('Time sent to server:', currentTime);

                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending time:', error);
                        }
                    });



                });
            });
        </script>
        {{-- <script>
            $(document).ready(function() {
                var startTime; // to keep track of the start time
                var stopwatchInterval; // to keep track of the interval
                var elapsedPausedTime = 0; // to keep track of the elapsed time while stopped
                var stopTime; // Variable to store stop time
                var startwatchInterval;
                var pausedTime = 0; // Variable to store the total paused time

                function startStopwatch() {
                    if (!stopwatchInterval) {
                        startTime = new Date().getTime() -
                            elapsedPausedTime; // get the starting time by subtracting the elapsed paused time from the current time
                        stopwatchInterval = setInterval(updateStopwatch, 1000); // update every second

                        clearInterval(startwatchInterval);
                        pausedTime = new Date().getTime() - (stopTime);

                        startwatchInterval = null;
                    }
                }

                function stopStopwatch() {

                    if (!startwatchInterval) {
                            stopTime = new Date().getTime();
                        startwatchInterval = setInterval(updateStopped, 1000);

                        clearInterval(stopwatchInterval); // stop the interval
                        elapsedPausedTime = new Date().getTime() - startTime; // calculate elapsed paused time
                        stopwatchInterval = null; // reset the interval variable
                    }
                }

                function resetStopwatch() {
                    clearInterval(stopwatchInterval);
                    clearInterval(startwatchInterval);

                    elapsedPausedTime = 0;
                    pausedTime = 0
                    document.getElementById("stopwatch").innerHTML = "00:00:00"; // reset the display
                    document.getElementById("stopedtime").innerHTML = "00:00:00";

                }

                function updateStopwatch() {
                    var currentTime = new Date().getTime(); // get current time in milliseconds
                    var elapsedTime = currentTime - startTime; // calculate elapsed time in milliseconds
                    var seconds = Math.floor(elapsedTime / 1000) % 60; // calculate seconds
                    var minutes = Math.floor(elapsedTime / 1000 / 60) % 60; // calculate minutes
                    var hours = Math.floor(elapsedTime / 1000 / 60 / 60); // calculate hours
                    var displayTime = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds); // format display time
                    document.getElementById("stopwatch").innerHTML = displayTime; // update the display
                }

                function updateStopped() {
                    var currentTime = new Date().getTime();
                    var elapsedTime = currentTime - stopTime; // calculate elapsed time in milliseconds
                    var seconds = Math.floor(elapsedTime / 1000) % 60; // calculate seconds
                    var minutes = Math.floor(elapsedTime / 1000 / 60) % 60; // calculate minutes
                    var hours = Math.floor(elapsedTime / 1000 / 60 / 60); // calculate hours
                    var displaystopedTime = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds); // format display time
                    document.getElementById("stopedtime").innerHTML = displaystopedTime;
                }

                function pad(number) {
                    return (number < 10 ? "0" : "") + number;
                }

                $('#startBtn').click(function() {
                    startStopwatch();
                });

                $('#stopBtn').click(function() {
                    stopStopwatch();
                });

                $('#resetBtn').click(function() {
                    resetStopwatch();
                });
            });
        </script> --}}
    @endsection
</x-app-layout>
