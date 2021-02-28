<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
          
            <div class="mb-10 m-4">
                <a href="{{ route('absensis.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                + Create Absensi</a>
            </div>
            <div class="bg-white overflow-x-auto  shadow-xl sm:rounded-lg">
                <table class="table-auto w-full text-center">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2" rowspan="2">No</th>
                            <th class="border px-4 py-2" rowspan="2">Nama</th>
                            <th class="border px-4 py-2" rowspan="2">Type</th>
                            <th class="border px-4 py-2" rowspan="2">Work</th>
                            <th class="border px-4 py-2" rowspan="2">Date</th>
                            <th class="border px-4 py-2" colspan="6">Check</th>
                        </tr>
                        <tr>
                            <th class="border px-4 py-2">In</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Location</th>
                            <th class="border px-4 py-2">Out</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($absensi as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $no++ }}</td>
                                <td class="border px-4 py-2">{{ $item->user->name }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($item->type) }}</td>
                                <td class="border px-4 py-2">{{ strtoupper($item->work) }}</td>
                                <td class="border px-4 py-2 text-center ">{{ date('D, d-M-Y', strtotime($item->created_at)) }}</td>
                                <td class="border px-4 py-2">{{ date('H:i:s', strtotime($item->created_at)) }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($item->detail->status) }}</td>
                                <td class="border px-4 py-2">{{ $item->detail->location }}</td>
                                @if ($item->status === 'in')
                                    <td class="border px-4 py-2">-</td>
                                    <td class="border px-4 py-2">-</td>
                                    <td class="border px-4 py-2">-</td>
                                @else
                                    <td class="border px-4 py-2">{{ date('H:i:s', strtotime($item->updated_at)) }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($item->detail->status) }}</td>
                                    <td class="border px-4 py-2">{{ $item->detail->location }}</td>
                                @endif
                              
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="border text-center p-5">
                                    Data Tidak Ditemukan
                                </td>
                            </tr>
                        @endforelse
                      
                    </tbody>
                </table>
            </div>
            
            <div class="text-center mt-5">
                {{ $absensi->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
