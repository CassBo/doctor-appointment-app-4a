<x-admin-layout title="Gestión de Citas Médicas" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Citas Médicas'],
]">

    <x-slot name="action">
        <a href="{{ route('admin.citas.create') }}"
            class="flex items-center px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Nueva Cita
        </a>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        @livewire('admin.cita-table')
    </div>

    {{-- Modal o Pestaña para la historia médica del paciente --}}
    <div class="mt-6">
        <button class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
            Ver / Editar Historia Médica
        </button>
    </div>

    {{-- Modal o Pestaña para consultas anteriores --}}
    <div class="mt-6">
        <button class="px-4 py-2 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">
            Consultas Anteriores
        </button>
    </div>

</x-admin-layout>
