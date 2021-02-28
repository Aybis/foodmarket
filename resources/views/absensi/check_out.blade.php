<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight uppercase ">
            {!! __('Absensi') !!}
        </h2>
    </x-slot>
    
    <div class="py-4 md:py-12 h-full">
        <div class="bg-white py-4 px-4 max-w-7xl mx-auto mb-8 sm:px-6 lg:px-8 rounded-md">
            <form action="{{ route('absensis.update', $data->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('put')
                <div class="flex flex-col justify-between h-auto mb-8 gap-8 mx-4 md:gap-8 overflow-y-hidden">
                    <div class="" hidden>
                        <input type="hidden" name="location" id="location">
                        <input type="hidden" name="long" id="long">
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="h-64 sm:h-auto">
                        <div id="map" class="rounded-2xl h-64"></div>
                    </div>
                    <div class="max-h-72 h-auto bg-black rounded-xl" id="section_image" style=" width: 100%;text-align: center;overflow: hidden;">
                        <img 
                            id="output" 
                            style="
                                position: relative;
                                left: 50%;
                                transform: translate(-50%,0)"/>
                    </div>

                    <div class="bg-white w-full fixed bottom-0 h-20 border-t-2 border-gray-200 shadow-2xl rounded-t-3xl px-10 py-4 self-center">
                        <div class="flex justify-center gap-4">
                            <button type="submit" class="h-12 w-1/2 inline-block rounded-lg border-2 border-black bg-white text-black font-bold uppercase" id="submit">Check Out</button>
                            <div class="w-1/2">
                                <label for="image" tabindex="0" id="labelImage" class="h-12 block rounded-lg border-2 border-black bg-black text-white font-sans font-black uppercase text-center py-3 cursor-pointer "> Take a Selfie</label>
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
        let btnImage = document.getElementById('labelImage');
        
        
        let loadFile = function(event) {
            sectionImage.classList.remove('hidden');
            // btnSubmit.classList.remove('bg-gray-200', "text-gray-400");
            // btnSubmit.classList.remove('disabled:opacity-50');
            btnSubmit.classList.remove('bg-white');
            btnSubmit.classList.add("bg-black");
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
        
        // btnSubmit.classList.add('disabled:opacity-50');
        btnSubmit.disabled = true;
        
       
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
    @endpush
    
</x-app-layout>

