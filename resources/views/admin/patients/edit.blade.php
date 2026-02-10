<x-admin-layout title="Editar Información Médica" :breadcrumb="[
    ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['name' => 'Pacientes', 'url' => route('admin.patients.index')],
    ['name' => 'Editar'],
]">

    {{-- Inicializamos Alpine para el manejo de Tabs --}}
    <div x-data="{ activeTab: 'personal' }" class="min-h-screen bg-gray-50 p-6">

        {{-- Envolvemos todo en el form para que el botón de arriba funcione --}}
        <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl font-bold border border-blue-100 uppercase">
                        {{ substr($patient->user->name, 0, 2) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $patient->user->name }}</h2>
                        <p class="text-sm text-gray-500">Gestión de expediente clínico</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.patients.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium bg-white transition">
                        Volver
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium flex items-center gap-2 shadow-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Guardar cambios
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

                <div class="flex border-b border-gray-200 overflow-x-auto">
                    <button type="button" @click="activeTab = 'personal'"
                            :class="activeTab === 'personal' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                            class="px-6 py-4 border-b-2 font-medium flex items-center gap-2 whitespace-nowrap transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Datos personales
                    </button>

                    <button type="button" @click="activeTab = 'antecedentes'"
                            :class="activeTab === 'antecedentes' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                            class="px-6 py-4 border-b-2 font-medium flex items-center gap-2 whitespace-nowrap transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Antecedentes Médicos
                    </button>

                    <button type="button" @click="activeTab = 'general'"
                            :class="activeTab === 'general' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                            class="px-6 py-4 border-b-2 font-medium flex items-center gap-2 whitespace-nowrap transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Información general
                    </button>

                    <button type="button" @click="activeTab = 'emergencia'"
                            :class="activeTab === 'emergencia' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                            class="px-6 py-4 border-b-2 font-medium flex items-center gap-2 whitespace-nowrap transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        Contacto de emergencia
                    </button>
                </div>

                <div class="p-8">

                    <div x-show="activeTab === 'personal'" class="space-y-6">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 flex items-start justify-between rounded-r">
                            <div class="flex gap-3">
                                <div class="text-blue-500 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" /></svg>
                                </div>
                                <div>
                                    <h3 class="text-blue-900 font-bold text-sm">Edición de cuenta de usuario</h3>
                                    <p class="text-blue-700 text-sm mt-1">
                                        El Email y Nombre deben gestionarse desde la cuenta de usuario.
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('admin.users.edit', $patient->user) }}" class="self-center flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
                                Editar Usuario
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email asociado</label>
                                <input type="text" disabled value="{{ $patient->user->email }}" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm text-gray-500 cursor-not-allowed">
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <input type="text" name="address" id="address" value="{{ old('address', $patient->address) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('address') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div x-show="activeTab === 'antecedentes'" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="blood_type_id" class="block text-sm font-medium text-gray-700">Tipo de Sangre</label>
                            <select name="blood_type_id" id="blood_type_id" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                @foreach($bloodTypes as $bloodType)
                                    <option value="{{ $bloodType->id }}" {{ old('blood_type_id', $patient->blood_type_id) == $bloodType->id ? 'selected' : '' }}>{{ $bloodType->name }}</option>
                                @endforeach
                            </select>
                            @error('blood_type_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="allergies" class="block text-sm font-medium text-gray-700">Alergias</label>
                            <textarea name="allergies" id="allergies" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('allergies', $patient->allergies) }}</textarea>
                            @error('allergies') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="chronic_conditions" class="block text-sm font-medium text-gray-700">Condiciones Crónicas</label>
                            <textarea name="chronic_conditions" id="chronic_conditions" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('chronic_conditions', $patient->chronic_conditions) }}</textarea>
                            @error('chronic_conditions') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="family_history" class="block text-sm font-medium text-gray-700">Historial Familiar</label>
                            <textarea name="family_history" id="family_history" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('family_history', $patient->family_history) }}</textarea>
                            @error('family_history') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="surgical_history" class="block text-sm font-medium text-gray-700">Antecedentes Quirúrgicos</label>
                            <textarea name="surgical_history" id="surgical_history" rows="3" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('surgical_history', $patient->surgical_history ?? '') }}</textarea>
                            @error('surgical_history') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div x-show="activeTab === 'general'" style="display: none;" class="space-y-6">
                        <div>
                            <label for="observations" class="block text-sm font-medium text-gray-700">Observaciones Generales</label>
                            <textarea name="observations" id="observations" rows="6" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('observations', $patient->observations) }}</textarea>
                            @error('observations') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div x-show="activeTab === 'emergencia'" style="display: none;" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700">Nombre Contacto</label>
                                <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('emergency_contact_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div x-data="{
                                phone: '{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}',
                                format() {
                                    let val = this.phone.replace(/\D/g, '').substring(0, 10);
                                    this.phone = val.length > 0 ? val.match(/.{1,2}/g).join('-') : '';
                                }
                            }" x-init="format()">
                                <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" x-model="phone" @input="format()" maxlength="14" placeholder="00-00-00-00-00"
                                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('emergency_contact_phone') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2" x-data="{
                                relation: @json(old('emergency_contact_relationship', $patient->emergency_contact_relationship)),
                                other: '',
                                options: ['Padre', 'Madre', 'Esposo/a', 'Hijo/a', 'Hermano/a', 'Tío/a', 'Abuelo/a', 'Amigo/a'],
                                init() {
                                    if (this.relation && !this.options.includes(this.relation)) {
                                        this.other = this.relation;
                                        this.relation = 'Otro';
                                    }
                                }
                            }">
                                <label for="emergency_contact_relationship" class="block text-sm font-medium text-gray-700">Parentesco</label>
                                <select x-model="relation" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Seleccione...</option>
                                    <template x-for="option in options" :key="option">
                                        <option :value="option" x-text="option"></option>
                                    </template>
                                    <option value="Otro">Otro</option>
                                </select>
                                <div x-show="relation === 'Otro'" class="mt-2">
                                    <input type="text" x-model="other" maxlength="250" placeholder="Especifique parentesco..." class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <input type="hidden" name="emergency_contact_relationship" :value="relation === 'Otro' ? other : relation">
                                @error('emergency_contact_relationship') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                </div> </div> </form>
    </div>

</x-admin-layout>
