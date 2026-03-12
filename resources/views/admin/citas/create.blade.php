<x-admin-layout title="Crear Cita Médica" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Citas Médicas', 'url' => route('admin.citas.index')],
    ['name' => 'Nueva Cita'],
]">

    <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <form action="{{ route('admin.citas.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="patient_id" class="block text-sm font-medium text-gray-700">Paciente</label>
                    <select name="patient_id" id="patient_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="doctor_id" class="block text-sm font-medium text-gray-700">Médico</label>
                    <select name="doctor_id" id="doctor_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="specialty_id" class="block text-sm font-medium text-gray-700">Especialidad</label>
                    <select name="specialty_id" id="specialty_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Fecha de la Cita</label>
                    <input type="date" name="date" id="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="time" class="block text-sm font-medium text-gray-700">Hora de la Cita</label>
                    <input type="time" name="time" id="time" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.citas.index') }}" class="px-4 py-2 mr-2 font-bold text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>
