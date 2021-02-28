<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight uppercase ">
            {!! __('Absensi') !!}
        </h2>
    </x-slot>
    
    <div class="py-12 h-auto">
        <div class="bg-white py-4 px-4 max-w-7xl mx-auto mb-8 sm:px-6 lg:px-8 rounded-md">
            <form action="{{ route('absensis.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="flex flex-col justify-between h-auto mb-8 gap-8 mx-4 md:gap-8 overflow-y-hidden">
                    <div class="h-24">
                        <p id="date" class="text-center text-xl font-bold mb-2"></p>
                        <p id="time" class="text-center text-3xl font-bold"></p>
                        <input type="hidden" name="location" id="location">
                        <input type="hidden" name="long" id="long">
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="h-auto">
                        <label for="maps" class="block uppercase tracking-wide text-xs font-bold mb-2"> Maps</label>
                        <div id="map" class="rounded-2xl h-48"></div>
                    </div>
                    <div class="max-h-64 hidden rounded-xl" id="section_image" style=" width: 100%;text-align: center;overflow: hidden;">
                        <img id="output" style="position: relative;left: 50%;transform: translate(-50%,0)" />
                    </div>
                    
                    <div class="h-auto" id="section_image" style=" width: 100%;text-align: center;overflow: hidden;">
                        <label for="work" class="block uppercase tracking-wide text-xs font-bold mb-2"> Kehadiran</label>
                        <select class="rounded w-full block" name="type" onchange="typePresensi(this)">
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="ijin">Ijin</option>
                            <option value="sppd">SPPD</option>
                        </select>
                    </div>
                    
                    <div class=" h-auto gap-4 hidden" id="start_end_date"> 
                        <div class="flex-grow w-1/2">
                            <label for="work" class="block uppercase tracking-wide text-xs font-bold mb-2"> Start Date</label>
                            <input type="date" name="" id="" class="rounded w-full block">
                        </div>
                        <div class="flex-grow w-1/2">
                            <label for="status" class="block uppercase tracking-wide text-xs font-bold mb-2"> End Date</label>
                            <input type="date" name="" id="" class="rounded w-full block">

                        </div>
                    </div>
                    <div class="flex h-auto gap-4">
                        <div class="flex-grow w-1/2">
                            <label for="work" class="block uppercase tracking-wide text-xs font-bold mb-2"> Work</label>
                            <select class="rounded w-full block" name="work" >
                                <option value="wfh">WFH</option>
                                <option value="wfo">WFO</option>
                                <option value="satelit">Satelit</option>
                            </select>
                        </div>
                        <div class="flex-grow w-1/2">
                            <label for="status" class="block uppercase tracking-wide text-xs font-bold mb-2"> Status</label>
                            <select id="status" name="status" class="rounded w-full" onchange="onChangeStatus(this)">
                                <option value="sehat">Sehat</option>
                                <option value="kurang sehat">Kurang Sehat</option>
                                <option value="sakit">Sakit</option>
                            </select>
                        </div>
                    </div>
                    <div class="h-auto hidden" id="card_check">
                        <label for="detail" class="block uppercase tracking-wide text-xs font-bold mb-2"> Alasan Telat</label>
                        <textarea class="w-full rounded h-full" name="detail_check" id="detail_check"></textarea>
                    </div>
                    
                    <div class="h-auto hidden" id="card_status">
                        <label for="detail" class="block uppercase tracking-wide text-xs font-bold mb-2"> Alasan</label>
                        <textarea class="w-full h-full" name="detail_status" id="detail_status"></textarea>
                    </div>

                    <div class="bg-white w-full fixed bottom-0 h-20 border-t-2 border-gray-100 shadow-2xl rounded-t-3xl px-10 py-4 self-center">
                        <div class="flex justify-center gap-4">
                            <button type="submit" class="h-12 w-1/2 inline-block rounded bg-gray-200 text-gray-400 font-bold uppercase" id="submit">Check In</button>
                            <div class="w-1/2">
                                <label for="image" tabindex="0" id="labelImage" class="h-12 block rounded border-2 border-black bg-black text-white font-sans font-black uppercase text-center py-3 cursor-pointer "> Take a Selfie</label>
                                <input type="file" name="photo" accept="image/*" capture="camera" id="image" class="hidden" onchange="loadFile(event)" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
  
    @push('scripts')
    
    <script>
        window.hereApiKey = "{{ env('HERE_API_KEY')}}";
        let inputTime = document.getElementById('time');
        let inputDate = document.getElementById('date');
        let sectionImage = document.getElementById('section_image');
        let btnSubmit = document.getElementById('submit');
        let detailStatus = document.getElementById('card_status');
        let detailCheck = document.getElementById('card_check');
        let btnImage = document.getElementById('labelImage');
        let inputCheck = document.getElementById('detail_check');
        let inputStatus = document.getElementById('detail_status');
        let startEndDate = document.getElementById('start_end_date');
        
        let loadFile = function(event) {
            sectionImage.classList.remove('hidden');
            btnSubmit.classList.remove('bg-gray-200', "text-gray-400");
            btnSubmit.classList.add("bg-black");
            btnSubmit.classList.remove('disabled:opacity-50');
            btnSubmit.disabled = false;
            btnSubmit.classList.add("text-white");
            btnImage.classList.remove('bg-black', 'text-white');
            btnImage.classList.add("text-black");
            let output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        
        btnSubmit.classList.add('disabled:opacity-50');
        btnSubmit.disabled = true;
        let months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        let days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
        let dateTime = new Date();
        let month = dateTime.getMonth();
        let day = dateTime.getDay();
        let date = dateTime.getDate();
        let year = dateTime.getFullYear();
        inputDate.innerHTML = `${days[day]}, ${date} ${months[month]} ${year}`;
        
        const timeLate = () => {
            let time = dateTime.getHours();
            let minute = dateTime.getMinutes();

            if((dateTime.getHours() >= 8 && minute > 15) || time > 8){
                console.log('late');
                detailCheck.classList.remove('hidden');
                inputCheck.required = true;
            }
            console.log(dateTime.getHours(), dateTime.getMinutes())
        }

        const typePresensi = (el) => {
            let value = el.value;

            if(value !== 'hadir') {
                startEndDate.classList.remove('hidden');
                startEndDate.classList.add('flex');
            }
        }
     
        
        const onChangeStatus = (el) => {
            let value = el.value;
            if(value !== 'sehat') {
                detailStatus.classList.remove('hidden');
                inputStatus.required = true;
            } else {
                detailStatus.classList.add('hidden');
                inputStatus.required = false;
                
            }
        }
        
        setInterval(() => {
            realTime();
        }, 1000);
        function realTime()
        {
            let time = new Date().toLocaleTimeString('id-ID');
            let timeFormat = time.replace('.', ':');
            inputTime.innerHTML = timeFormat;
        }
        
        timeLate();
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
    @endpush
    
</x-app-layout>

