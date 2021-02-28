<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight uppercase ">
            {!! __('Absensi') !!}
        </h2>
    </x-slot>
    
    <div class="py-12 h-auto font-mono">
        <div class="container mx-auto bg-red sm:w-2/6 md:w-2/5">
            <form action="{{ route('absensis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col justify-between gap-4 mx-4 overflow-y-hidden mb-12">
                    <div class="h-auto p-2 bg-black rounded-lg">
                        <div id="map" class="h-64 w-full"></div>
                        <input type="hidden" name="location" id="location">
                        <input type="hidden" name="long" id="long">
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="h-auto shadow-lg">
                        <img id="output" class="object-cover h-64 w-full rounded-lg hidden" alt="img"/>
                    </div>
                    <div class="h-auto">
                        <select name="" id="" class="border-2 border-black rounded-md w-full" onchange="onChangeStatus(this)">
                            <option value="hadir" selected>Hadir</option>
                            <option value="ijin">Ijin</option>
                            <option value="sakit">Sakit</option>
                            <option value="sppd">SPPD</option>
                        </select>
                    </div>
                    <div class="h-auto gap-4 flex flex-col">
                        <select name="work" id="work" class="border-2 border-black rounded-md w-full">
                            <option value="wfh">WFH</option>
                            <option value="wfo">WFO</option>
                            <option value="satelit">Satelit</option>
                        </select>
                        <input type="number" name="count_days" id="count_days" class="border-2 border-black w-full rounded-md hidden" placeholder="10 Hari">
                        <textarea name="detail_check" id="detail_check" class=" border-2 border-black w-full rounded-md resize-none hidden" placeholder="Terlambat ?"></textarea>
                        <textarea name="detail_status" id="detail_status" class=" border-2 border-black w-full rounded-md resize-none hidden" placeholder="SPPD ?"></textarea>
                    </div>
                    
                </div>

                <div class="fixed flex flex-row items-center justify-between bottom-0 w-full sm:w-2/6 md:w-2/5 rounded-t-2xl bg-white shadow-lg border-t-2 border-gray-200 h-20 px-8 gap-4 z-20">
                    <button class="w-1/2  h-14 rounded-lg border-2 border-black text-lg font-bold font-mono" id="submit" type="submit">Check In</button>
                    <div class="flex w-1/2 h-14 bg-black items-center justify-center rounded-lg text-center">
                        <label for="image" tabindex="0"  id="labelImage" class="text-white text-lg font-bold font-mono cursor-pointer p-4"> Take a Selfie</label>
                        <input type="file" name="photo" accept="image/*" capture="camera" id="image" class="hidden" onchange="loadFile(this, event)" required />
                    </div>
                </div>
            </form>
        </div>
    </div>
    
  
    @push('scripts')
    
    <script>
        window.hereApiKey = "{{ env('HERE_API_KEY')}}";
        let btnSubmit = document.getElementById('submit');
        let btnImage = document.getElementById('labelImage');
        let inputCheck = document.getElementById('detail_check');
        let inputStatus = document.getElementById('detail_status');
        let inputDays = document.getElementById('count_days');
        let output = document.getElementById('output');
        let inputWork = document.getElementById('work');
        let dateTime = new Date();

        
        btnSubmit.classList.add('disabled:opacity-50');
        btnSubmit.disabled = true;


        const loadFile = (el, event) => {
            if(!el.value){
                btnSubmit.disabled = true;
                btnSubmit.classList.add('disable:opacity-100');
                output.classList.add('hidden');

            }else{
                btnSubmit.disabled = false;
                output.classList.remove('hidden');

                // display image after choose file 
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
            
        };
           
        const onChangeStatus = (el) => {
            let value = el.value;

            if(value === 'ijin') {
                inputWork.classList.add('hidden');
                inputDays.classList.remove('hidden');
                inputDays.required = true;

                inputStatus.classList.remove('hidden');
                inputStatus.placeholder = "Ijin ? ";
                inputStatus.required = true;

            } else if ( value === 'sakit' ) {
                inputWork.classList.add('hidden');
                inputDays.classList.remove('hidden');
                inputDays.required = true;

                inputStatus.classList.remove('hidden');
                inputStatus.placeholder = "Sakit ? ";
                inputStatus.required = true;

            } else if ( value === 'sppd') {
                inputWork.classList.add('hidden');
                inputDays.classList.remove('hidden');
                inputDays.required = true;

                inputStatus.classList.remove('hidden');
                inputStatus.placeholder = "SPPD ? ";
                inputStatus.required = true;

            } else {
                inputWork.classList.remove('hidden');
                inputDays.classList.add('hidden');
                inputStatus.classList.add('hidden');
            }
            
        }

        const timeLate = () => {
            let time = dateTime.getHours();
            let minute = dateTime.getMinutes();

            if((dateTime.getHours() >= 8 && minute > 15) || time > 8){
                inputCheck.classList.remove('hidden');
                inputCheck.required = true;
            }
        }

        timeLate();

        
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
    @endpush
    
</x-app-layout>

