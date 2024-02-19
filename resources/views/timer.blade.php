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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="stopwatch">
                        <h1>Stopwatch</h1>
                        <div class="display">00:00:00</div>
                        <button class="start" onclick="startTimer()">Start</button>
                        <button class="stop" onclick="stopTimer()">Stop</button>
                        <button class="reset" onclick="resetTimer()">Reset</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @section('js-script')
        
        <script type="text/javascript">
            var startTime, elapsedTime=0, timerInterval;

            function startTimer() {
                startTime = Date.now()-elapsedTime;
                timerInterval = setInterval(function() {
                    var currentTime = Date.now();
                    elapsedTime = currentTime - startTime;
                    updateDisplay(elapsedTime);
                }, 10);
            }

            function stopTimer() {
                clearInterval(timerInterval);
            }

            function resetTimer() {
                clearInterval(timerInterval);
                elapsedTime = 0;
                updateDisplay(elapsedTime);
            }

            function updateDisplay(time) {
                var milliseconds = Math.floor((time % 1000) / 10);
                var seconds = Math.floor((time / 1000) % 60);
                var minutes = Math.floor((time / 1000 / 60) % 60);
                var hours = Math.floor((time / 1000 / 60 / 60) % 24);

                var displayTime = hours.toString().padStart(2, '0') + ':' +
                    minutes.toString().padStart(2, '0') + ':' +
                    seconds.toString().padStart(2, '0') + '.' +
                    milliseconds.toString().padStart(2, '0');

                document.querySelector('.display').textContent = displayTime;
            }

            // document.querySelector('.start').addEventListener('click', startTimer);
            // document.querySelector('.stop').addEventListener('click', stopTimer);
            // document.querySelector('.reset').addEventListener('click', resetTimer);
        </script>
    @endsection
</x-app-layout>
