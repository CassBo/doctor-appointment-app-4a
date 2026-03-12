<x-admin-layout title="Gestionar Horarios del Doctor" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Doctores', 'url' => route('admin.doctors.index')],
    ['name' => $doctor->name, 'url' => route('admin.doctors.edit', $doctor)],
    ['name' => 'Horarios']
]">

    <div class="p-6 mb-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800">Horarios de {{ $doctor->name }}</h2>
    </div>

    <form action="{{ route('admin.doctors.schedules.store', $doctor) }}" method="POST">
        @csrf
        <x-card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $schedules = $doctor->doctor->schedules->keyBy('day_of_week');
                @endphp
                @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $day)
                    @php
                        $schedule = $schedules->get($day);
                    @endphp
                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ $day }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input type="time" name="schedules[{{ $day }}][start_time]" label="Hora de inicio" value="{{ $schedule->start_time ?? '' }}" />
                            </div>
                            <div>
                                <x-input type="time" name="schedules[{{ $day }}][end_time]" label="Hora de fin" value="{{ $schedule->end_time ?? '' }}" />
                            </div>
                        </div>
                        <div class="mt-2">
                            <x-checkbox name="schedules[{{ $day }}][status]" label="Activo" :checked="($schedule->status ?? '') === 'active'" />
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-end">
                <x-button type="submit" label="Guardar Horarios" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md font-semibold text-xs uppercase" />
            </div>
        </x-card>
    </form>

</x-admin-layout>
