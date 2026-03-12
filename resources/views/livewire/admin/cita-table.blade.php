<div>
    <div class="flex justify-between mb-4">
        <input wire:model.lazy="search" type="text" class="w-1/2 border-gray-300 rounded-md shadow-sm" placeholder="Buscar citas...">
    </div>

    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('id')">
                    ID
                    @if ($sortField === 'id')
                        <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('patient_id')">
                    Paciente
                    @if ($sortField === 'patient_id')
                        <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('doctor_id')">
                    Doctor
                    @if ($sortField === 'doctor_id')
                        <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('date')">
                    Fecha
                    @if ($sortField === 'date')
                        <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $cita->id }}</td>
                    <td class="px-6 py-4">{{ $cita->patient->full_name }}</td>
                    <td class="px-6 py-4">{{ $cita->doctor->full_name }}</td>
                    <td class="px-6 py-4">{{ $cita->date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="#" class="px-2 py-1 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            Consulta
                        </a>
                        <a href="#" class="px-2 py-1 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                            Receta
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $citas->links() }}
    </div>
</div>
