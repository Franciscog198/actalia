<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Información de Póliza - Registrado</title>
    
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    
    <style>
  :root {
    --background: #ffffff;
    --foreground: #0b2540;
    --border: #00000014;
    --input: #f6faff;
    --primary: #0a5fb4;
    --primary-foreground: #ffffff;
    --secondary: #e9f8d9;
    --secondary-foreground: #1b4f00;
    --muted: #f3f5f7;
    --muted-foreground: #7a8692;
    --success: #ccf3a1;
    --success-foreground: #174e00;
    --accent: #a7e22f;
    --accent-foreground: #062500;
    --destructive: #ff4d4f;
    --destructive-foreground: #ffffff;
    --warning: #ffd580;
    --warning-foreground: #4a2b00;
    --card: #ffffff;
    --card-foreground: #0b2540;
    --sidebar: #f6fbff;
    --sidebar-foreground: #083056;
    --sidebar-primary: #0a5fb4;
    --sidebar-primary-foreground: #ffffff;
    --radius-sm: 4px;
    --radius-md: 6px;
    --radius-lg: 8px;
    --radius-xl: 12px;
    --font-family-body: Inter, sans-serif;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    background-color: var(--background);
    color: var(--foreground);
    -webkit-font-smoothing: antialiased;
    font-family: var(--font-family-body);
}

.app-wrapper {
    width: 100%;
    max-width: 375px;
    min-height: 100vh;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    background-color: var(--background);
}

.main-content {
    flex: 1;
    padding: 24px 20px 32px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.page-header {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.step-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted-foreground);
}

.page-title {
    font-size: 22px;
    font-weight: 600;
    color: var(--foreground);
}

.progress-track {
    margin-top: 12px;
    height: 4px;
    background-color: var(--muted);
    border-radius: 2px;
    overflow: hidden;
}

.progress-fill {
    width: 25%;
    height: 100%;
    background-color: var(--accent);
}

.editorial-block {
    background-color: var(--card);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    padding: 20px 16px 16px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.block-title {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--sidebar-foreground);
    padding-bottom: 8px;
    border-bottom: 1px solid var(--muted);
}

.section-subtitle {
    font-size: 14px;
    font-weight: 500;
    color: var(--muted-foreground);
}

.grid-choices {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 8px;
}

.choice-card {
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    background-color: var(--input);
    padding: 14px 14px 14px 12px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.choice-card.is-primary {
    background-color: var(--sidebar-primary);
    border-color: var(--sidebar-primary);
    color: var(--sidebar-primary-foreground);
    box-shadow: 0 0 0 1px var(--accent);
}

.choice-card.is-primary .choice-label {
    color: var(--sidebar-primary-foreground);
}

.choice-card-icon,
.choice-card-icon-neutral {
    width: 40px;
    height: 40px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.choice-card-icon {
    background-color: rgba(255, 255, 255, 0.9);
}

.choice-card-icon-neutral {
    background-color: var(--card);
}

.choice-label {
    font-size: 14px;
    font-weight: 500;
    color: var(--foreground);
    white-space: nowrap;
}

.choice-pill-accent {
    margin-left: auto;
    padding: 4px 8px;
    border-radius: var(--radius-xl);
    background-color: var(--accent);
    color: var(--accent-foreground);
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    white-space: nowrap;
}

.property-type-row {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 4px;
}

.property-type-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--foreground);
}

.property-type-chips {
    display: flex;
    gap: 8px;
}

.chip {
    flex: 1;
    min-width: 0;
    border-radius: 999px;
    border: 1px solid var(--border);
    background-color: var(--card);
    padding: 8px 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.chip.is-selected {
    border-color: var(--primary);
    background-color: var(--input);
    box-shadow: 0 0 0 1px var(--accent);
}

.chip-icon-wrapper {
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chip-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--foreground);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.form-grid {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.form-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-field.is-aligned {
    height: 100%;
}

.form-field.is-aligned .form-label {
    flex: 1;
    display: flex;
    align-items: flex-end;
}

.form-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--muted-foreground);
}

.input-mock,
.input-real {
    width: 100%;
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    background-color: var(--input);
    padding: 11px 12px;
    font-size: 14px;
    color: var(--foreground);
    outline: none;
}

.input-real:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(10, 95, 180, 0.15);
}

.input-mock {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.input-text {
    flex: 1;
    min-width: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.input-placeholder {
    color: var(--muted-foreground);
}

.two-col-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.bottom-bar {
    border-top: 1px solid var(--border);
    background-color: var(--card);
    padding: 16px 20px 28px;
}

.btn-primary {
    width: 100%;
    border-radius: var(--radius-lg);
    background-color: var(--primary);
    color: var(--primary-foreground);
    padding: 14px 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    box-shadow: 0 0 0 1px var(--accent);
    transition: 0.2s ease;
}

.btn-primary:hover {
    opacity: 0.95;
}

.btn-icon-wrapper {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
}
    </style>
</head>
<body>
    <div class="app-wrapper">
        <main class="main-content">
            <header class="page-header">
                <div class="step-label">Paso 1 de 4</div>
                <h1 class="page-title">Ficha general del contrato</h1>
                <div class="progress-track">
                    <div class="progress-fill-25"></div>
                </div>
            </header>

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Error:</strong>
                    <ul style="margin: 8px 0 0 20px; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('wizard.store', 1) }}" id="contractForm">
                @csrf

                <section class="editorial-block">
                    <div class="block-title">Quién registra</div>
                    <div class="section-subtitle">
                        Seleccioná el tipo de registrante del contrato
                    </div>
                    <div class="grid-choices">
                        <div class="choice-card is-primary" onclick="selectRegistrant('propietario', event)">
                            <div class="choice-card-icon">
                                <iconify-icon icon="lucide:user" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                            </div>
                            <div class="choice-label">Propietario</div>
                            <div class="choice-pill-accent">Seleccionado</div>
                        </div>
                        <div class="choice-card" onclick="selectRegistrant('inmobiliaria', event)">
                            <div class="choice-card-icon-neutral">
                                <iconify-icon icon="lucide:building-2" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                            </div>
                            <div class="choice-label">Inmobiliaria</div>
                        </div>
                    </div>
                    <input type="hidden" name="registrant_type" id="registrant_type" value="propietario">
                </section>

                <section class="editorial-block">
                    <div class="block-title">Inmueble y contrato</div>

                    <div class="property-type-row">
                        <div class="property-type-label">Tipo de alquiler</div>
                        <div class="property-type-chips">
                            <label class="chip" id="chip-vivienda">
                                <input type="radio" name="contract_type" value="vivienda" {{ old('contract_type', 'vivienda') == 'vivienda' ? 'checked' : '' }} required>
                                <iconify-icon icon="lucide:home" style="font-size: 18px; color: var(--primary)"></iconify-icon>
                                <div class="chip-label">Vivienda</div>
                            </label>
                            <label class="chip" id="chip-cochera">
                                <input type="radio" name="contract_type" value="cochera" {{ old('contract_type') == 'cochera' ? 'checked' : '' }}>
                                <iconify-icon icon="lucide:parking-square" style="font-size: 18px; color: var(--primary)"></iconify-icon>
                                <div class="chip-label">Cochera</div>
                            </label>
                            <label class="chip" id="chip-comercial">
                                <input type="radio" name="contract_type" value="comercial" {{ old('contract_type') == 'comercial' ? 'checked' : '' }}>
                                <iconify-icon icon="lucide:store" style="font-size: 18px; color: var(--primary)"></iconify-icon>
                                <div class="chip-label">Local</div>
                            </label>
                        </div>
                        @error('contract_type')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-grid">
                        <div class="form-field">
                            <div class="form-label">Dirección del inmueble</div>
                            <input type="text" name="address" value="{{ old('address') }}" placeholder="Calle, número, barrio" class="input-real" required>
                            @error('address')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-field">
                            <div class="form-label">Unidad (opcional)</div>
                            <input type="text" name="unit" value="{{ old('unit') }}" placeholder="PB, primer piso UF 8, etc." class="input-real">
                            @error('unit')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <div class="form-label">Ciudad</div>
                            <input type="text" name="city" value="{{ old('city') }}" placeholder=" " class="input-real" required>
                            @error('city')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <div class="form-label">Provincia</div>
                            <input type="text" name="province" value="{{ old('province') }}" placeholder=" " class="input-real" required>
                            @error('province')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        

                        <div class="form-field">
                            <div class="form-label">Nombre de la propiedad (opcional)</div>
                            <input type="text" name="property_name" value="{{ old('property_name') }}" placeholder="Depto 2 ambientes" class="input-real">
                            @error('property_name')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="property-type-row">
                            <div class="property-type-label">Garantía</div>
                            <div class="property-type-chips">
                                <label class="chip" id="chip-propietaria">
                                    <input type="radio" name="guarantee_type" value="propietaria" {{ old('guarantee_type', 'propietaria') == 'propietaria' ? 'checked' : '' }}>
                                    <div class="chip-label">Propietaria</div>
                                </label>
                                <label class="chip" id="chip-poliza">
                                    <input type="radio" name="guarantee_type" value="poliza" {{ old('guarantee_type') == 'poliza' ? 'checked' : '' }}>
                                    <div class="chip-label">Póliza</div>
                                </label>
                                <label class="chip" id="chip-sin-garantia">
                                    <input type="radio" name="guarantee_type" value="sin_garantia" {{ old('guarantee_type') == 'sin_garantia' ? 'checked' : '' }}>
                                    <div class="chip-label">Sin garantía</div>
                                </label>
                            </div>
                        </div>

                        <div class="two-col-row">
                            <div class="form-field">
                                <div class="form-label">Fecha inicio del contrato</div>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="input-real" required>
                                @error('start_date')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-field">
                                <div class="form-label">Fecha fin del contrato</div>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="input-real" required>
                                @error('end_date')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Alquiler mensual (opcional)</div>
                            <input type="number" name="monthly_rent" value="{{ old('monthly_rent') }}" step="0.01" placeholder="150000" class="input-real">
                            @error('monthly_rent')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </section>
        </main>

        <footer class="bottom-bar">
            <button type="submit" class="btn-primary">
                <span>Continuar</span>
                <div class="btn-icon-wrapper">
                    <iconify-icon icon="lucide:arrow-right" style="font-size: 18px; color: white;"></iconify-icon>
                </div>
            </button>
        </footer>
            </form>
    </div>

    <script>
        // Selección de registrante
        function selectRegistrant(type, event) {
            const cards = document.querySelectorAll('.choice-card');
            cards.forEach(card => {
                card.classList.remove('is-primary');
                const pill = card.querySelector('.choice-pill-accent');
                if (pill) pill.remove();
            });
            
            const selectedCard = event.currentTarget;
            selectedCard.classList.add('is-primary');
            const pill = document.createElement('div');
            pill.className = 'choice-pill-accent';
            pill.textContent = 'Seleccionado';
            selectedCard.appendChild(pill);
            
            document.getElementById('registrant_type').value = type;

            // Actualizar UI
            document.querySelectorAll('.choice-card').forEach(card => {
                card.classList.remove('is-primary');
            });
            event.currentTarget.classList.add('is-primary');
            
            // Guardar valor
            document.getElementById('registrant_type').value = type;
                }

        // Chips de tipo de contrato
        document.querySelectorAll('input[name="contract_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.property-type-chips .chip').forEach(chip => {
                    chip.classList.remove('is-selected');
                });
                if (this.checked) {
                    this.closest('.chip').classList.add('is-selected');
                }
            });
            if (radio.checked) {
                radio.closest('.chip').classList.add('is-selected');
            }
        });

        // Chips de garantía
        document.querySelectorAll('input[name="guarantee_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('input[name="guarantee_type"]').forEach(r => {
                    r.closest('.chip').classList.remove('is-selected');
                });
                if (this.checked) {
                    this.closest('.chip').classList.add('is-selected');
                }
            });
            if (radio.checked) {
                radio.closest('.chip').classList.add('is-selected');
            }
        });

        // Auto-calcular fecha fin (2 años después)
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = new Date(this.value);
            const endDate = new Date(startDate);
            endDate.setFullYear(endDate.getFullYear() + 2);
            
            document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
            document.getElementById('end_date').min = this.value;
        });
    </script>
</body>
</html>
</x-guest-layout>